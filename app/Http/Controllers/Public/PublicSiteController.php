<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class PublicSiteController extends Controller
{
    public function home($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $properties = Property::where('user_id', $user->id)
                              ->active()
                              ->with('images')
                              ->paginate(10);

        // Cidades para filtro (baseado nos imóveis do corretor)
        $cities = Property::where('user_id', $user->id)
                           ->whereNotNull('city')
                           ->distinct()
                           ->pluck('city');

        return view('public.home', compact('user', 'properties', 'cities'));
    }

    public function propertyDetail($slug, $propertySlug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $property = Property::where('user_id', $user->id)
                            ->where('slug', $propertySlug)
                            ->with('images', 'user')
                            ->firstOrFail();

        // Incrementa contador de views
        $property->increment('views_count');

        return view('public.imovel-detalhe', compact('user', 'property'));
    }

    public function about($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('public.sobre', compact('user'));
    }

    public function contact($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('public.contato', compact('user'));
    }

    // Método para filtros AJAX (usado na Fase 5)
    public function filterProperties(Request $request, $slug)
{
    $user = User::where('slug', $slug)->firstOrFail();

    $query = Property::where('user_id', $user->id)->active();

    // Busca textual
    if ($request->filled('search')) {
        $query->search($request->search);
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

    // Paginação (10 por página)
    $perPage = 10;
    $properties = $query->with('images')->paginate($perPage);

    // Se for AJAX, devolve o HTML do grid + paginação
    if ($request->ajax()) {
        return response()->json([
            'html' => view('public.partials.property-grid', [
                'properties' => $properties,
                'user' => $user, // necessário para os links
            ])->render(),
            'pagination' => $properties->links()->toHtml(),
        ]);
    }

    // Fallback para requisição normal (ex: se desabilitar JS)
    return view('public.home', compact('user', 'properties'));
}
}