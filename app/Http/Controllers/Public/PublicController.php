<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Landing page (página inicial do sistema)
     * Não requer $user, pois é uma página genérica.
     */
    public function landing()
    {
        return view('public.home');
    }

    /**
     * Página "Sobre" institucional (landing)
     */
    public function sobreInstitucional()
    {
        return view('public.sobre-institucional');
    }

    /**
     * Página "Contato" institucional (landing)
     */
    public function contatoInstitucional()
    {
        return view('public.contato-institucional');
    }

    /**
     * Página "Recursos" (landing)
     */
    public function recursos()
    {
        return view('public.recursos');
    }

    /**
     * Vitrine pública do corretor
     * Passa a variável $user para o layout e views.
     */
    public function corretor($slug, Request $request)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $query = Property::where('user_id', $user->id)->active()->with('images');

        // Ordenação (client-side preferencial, mas aceita via URL)
        $sort = $request->get('sort', 'recent');
        $query = match ($sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'area_desc'  => $query->orderBy('area_sqmt', 'desc'),
            default      => $query->latest(),
        };

        $imoveis = $query->paginate(9);
        $destaques = Property::where('user_id', $user->id)->active()->limit(3)->get();
        $cidades = Property::where('user_id', $user->id)->distinct()->pluck('city');

        return view('public.corretor', compact('user', 'imoveis', 'destaques', 'cidades'));
    }

    /**
     * Página de detalhe de um imóvel específico
     */
    public function imovelDetalhe($slug, $propertySlug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $imovel = Property::where('user_id', $user->id)
                          ->where('slug', $propertySlug)
                          ->with('images')
                          ->firstOrFail();

        // Incrementa contador de visualizações
        $imovel->increment('views_count');

        return view('public.imovel-detalhe', compact('user', 'imovel'));
    }

    /**
     * Página "Sobre o corretor"
     */
    public function sobre($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('public.sobre', compact('user'));
    }

    /**
     * Página de contato do corretor
     */
    public function contato($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('public.contato', compact('user'));
    }

    /**
     * Filtro AJAX para a vitrine do corretor
     * Retorna HTML do grid de imóveis + paginação via JSON.
     */
    public function filtrar(Request $request, $slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $query = Property::where('user_id', $user->id)->active();

        // Busca textual
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('street', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('neighborhood', 'LIKE', '%'.$request->search.'%')
                  ->orWhere('city', 'LIKE', '%'.$request->search.'%');
            });
        }

        // Filtro de preço mínimo
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        // Filtro de preço máximo
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Filtro de quartos
        if ($request->filled('bedrooms') && $request->bedrooms != 'any') {
            if ($request->bedrooms == '4+') {
                $query->where('bedrooms', '>=', 4);
            } else {
                $query->where('bedrooms', (int) $request->bedrooms);
            }
        }

        // Filtro de cidade
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        $imoveis = $query->with('images')->paginate(10);

        // Se for requisição AJAX, retorna JSON
        if ($request->ajax()) {
            $html = view('partials.property-card', compact('imoveis', 'user'))->render();
            $pagination = $imoveis->links()->toHtml();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
            ]);
        }

        // Fallback para requisição normal (redireciona de volta)
        return back();
    }

    /**
     * Captura de lead via formulário na página de detalhe
     * (requisição AJAX)
     */
    public function storeLead(Request $request, $slug, $propertyId)
    {
        $property = Property::findOrFail($propertyId);

        // Validação
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'has_property' => 'nullable|boolean',
            'property_details' => 'nullable|string|max:1000',
        ]);

        // Cria o lead
        $lead = Lead::create([
            'property_id' => $property->id,
            'corretor_id' => $property->user_id,
            'lead_name' => $validated['name'],
            'lead_phone' => $validated['phone'],
            'lead_email' => $validated['email'] ?? null,
            'has_property_to_sell' => $validated['has_property'] ?? false,
            'sell_property_details' => $validated['property_details'] ?? null,
            'source' => 'site',
            'status' => 'new',
        ]);

        // ===== LOG DE LEAD CAPTURADO =====
        Log::channel('leads')->info('Lead capturado', [
            'lead_id' => $lead->id,
            'property_id' => $property->id,
            'property_title' => $property->title,
            'corretor_id' => $property->user_id,
            'lead_name' => $lead->lead_name,
            'lead_phone' => $lead->lead_phone,
            'source' => 'site',
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        // Incrementa contador de leads do imóvel
        $property->increment('lead_count');

        // Dispara job para enviar notificação WhatsApp (opcional)
        // \App\Jobs\SendLeadWhatsAppNotification::dispatch($lead);

        return response()->json([
            'message' => 'Lead capturado com sucesso! Em breve entraremos em contato.',
            'lead' => $lead,
        ], 200);
    }
}