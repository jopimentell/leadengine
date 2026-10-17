<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Jobs\SendLeadWhatsAppNotification;
use App\Models\Lead;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    // Captura pública (formulário na página de detalhe)
    public function store(Request $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);

        $validated = $request->validate([
            'lead_name' => 'required|string|max:255',
            'lead_phone' => 'required|string|max:20',
            'lead_email' => 'nullable|email|max:255',
            'has_property_to_sell' => 'nullable|boolean',
            'sell_property_details' => 'nullable|string|max:1000',
        ]);

        $lead = Lead::create([
            'property_id' => $property->id,
            'corretor_id' => $property->user_id,
            'lead_name' => $validated['lead_name'],
            'lead_phone' => $validated['lead_phone'],
            'lead_email' => $validated['lead_email'] ?? null,
            'has_property_to_sell' => $validated['has_property_to_sell'] ?? false,
            'sell_property_details' => $validated['sell_property_details'] ?? null,
            'source' => 'site',
            'status' => 'new',
        ]);

        // Incrementa contador de leads no imóvel
        $property->increment('lead_count');

        // Dispara job para WhatsApp
        SendLeadWhatsAppNotification::dispatch($lead);

        return back()->with('success', 'Lead capturado! Em breve entraremos em contato.');
    }

    // Dashboard - Listagem de leads
    public function index()
    {
        $leads = Auth::user()->leads()
                      ->with('property')
                      ->latest()
                      ->paginate(15);

        return view('dashboard.leads.index', compact('leads'));
    }

    // Atualizar status do lead
    public function updateStatus(Request $request, Lead $lead)
    {
        // Verifica se o lead pertence ao corretor logado
        if ($lead->corretor_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => ['required', Rule::in(['new', 'contacted', 'converted'])],
        ]);

        $lead->update(['status' => $validated['status']]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Status atualizado!');
    }
}