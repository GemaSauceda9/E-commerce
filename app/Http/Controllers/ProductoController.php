<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Etiqueta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'etiquetas'])->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::where('activo', true)->get();
        $etiquetas = Etiqueta::all();
        return view('productos.create', compact('categorias', 'etiquetas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|unique:productos',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nombre);

        $producto = Producto::create($data);

        if ($request->has('etiquetas')) {
            $producto->etiquetas()->sync($request->etiquetas);
        }

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function show(Producto $producto)
    {
        $producto->load(['categoria', 'etiquetas']);
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::where('activo', true)->get();
        $etiquetas = Etiqueta::all();
        return view('productos.edit', compact('producto', 'categorias', 'etiquetas'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|unique:productos,sku,' . $producto->id,
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nombre);

        $producto->update($data);

        if ($request->has('etiquetas')) {
            $producto->etiquetas()->sync($request->etiquetas);
        } else {
            $producto->etiquetas()->detach();
        }

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}
