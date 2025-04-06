<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EtiquetaController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::paginate(10);
        dd($etiquetas);
        // return view('etiquetas.index', compact('etiquetas'));
    }

    public function create()
    {
        return view('etiquetas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:etiquetas',
            'color' => 'nullable|max:50',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nombre);

        Etiqueta::create($data);

        return redirect()->route('etiquetas.index')
            ->with('success', 'Etiqueta creada exitosamente.');
    }

    public function show(Etiqueta $etiqueta)
    {
        return view('etiquetas.show', compact('etiqueta'));
    }

    public function edit(Etiqueta $etiqueta)
    {
        return view('etiquetas.edit', compact('etiqueta'));
    }

    public function update(Request $request, Etiqueta $etiqueta)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:etiquetas,nombre,' . $etiqueta->id,
            'color' => 'nullable|max:50',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nombre);

        $etiqueta->update($data);

        return redirect()->route('etiquetas.index')
            ->with('success', 'Etiqueta actualizada exitosamente.');
    }

    public function destroy(Etiqueta $etiqueta)
    {
        $etiqueta->delete();

        return redirect()->route('etiquetas.index')
            ->with('success', 'Etiqueta eliminada exitosamente.');
    }
}
