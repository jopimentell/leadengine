<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Auth::user()->properties()
                           ->withCount('leads')
                           ->paginate(10);

        return view('dashboard.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('dashboard.properties.create');
    }

    public function store(Request $request)
    {
        // Remova a linha $this->authorizeResource
        // Validação manual
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            // ... outros campos
        ]);

        // Verifica limite de imóveis do plano
        if (!Auth::user()->canAddMoreProperties()) {
            return back()->withErrors(['plan' => 'Você atingiu o limite de imóveis do seu plano.']);
        }

        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);

        $property = Property::create($validated);

        // Processar imagens
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('properties', 'public');
                PropertyImage::create([
                    'property_id' => $property->id,
                    'url' => '/storage/' . $path,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('dashboard.properties.index')->with('success', 'Imóvel criado!');
    }

    public function edit(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }
        return view('dashboard.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            // ... outros campos
        ]);

        $property->update($validated);
        return redirect()->route('dashboard.properties.index')->with('success', 'Imóvel atualizado!');
    }

    public function destroy(Property $property)
    {
        if ($property->user_id !== Auth::id()) {
            abort(403);
        }
        $property->delete();
        return redirect()->route('dashboard.properties.index')->with('success', 'Imóvel removido.');
    }
}