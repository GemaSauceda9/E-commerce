<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Etiqueta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'etiquetas'])->paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function indexAll(Request $request)
    {
        // Agregar log más detallado para depuración
        Log::info('Accediendo a indexAll de ProductoController', [
            'request' => $request->all(),
            'route' => $request->route()->getName()
        ]);
        
        $query = Producto::with(['categoria', 'etiquetas'])
            ->where('activo', true);

        // Aplicar filtro por categoría si existe
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        $productos = $query->orderBy('created_at', 'DESC')
            ->paginate(12);

        // Obtener todas las categorías activas para el filtro
        $categorias = Categoria::where('activo', true)->get();

        return view('productos.index.all', compact('productos', 'categorias'));
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
            'imagen_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nombre);

        // Si se está subiendo un archivo de imagen
        if ($request->hasFile('imagen_file') && $request->file('imagen_file')->isValid()) {
            $archivo = $request->file('imagen_file');

            // Obtener la extensión original
            $extension = $archivo->getClientOriginalExtension();

            // Generar nombre de la imagen con el campo nombre (sin espacios)
            $nombreImagen = str_replace(' ', '_', $request->nombre) . '.' . $extension;

            // Guardar en public/productos/
            $archivo->move(public_path('productos'), $nombreImagen);

            // Guardar la ruta en la BD
            $data['imagen'] = 'productos/' . $nombreImagen;
        } else {
            $data['imagen'] = null;
        }

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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->except(['imagen', '_token', '_method', 'etiquetas']);
        $data['slug'] = Str::slug($request->nombre);
        $data['destacado'] = $request->has('destacado') ? 1 : 0;
        $data['activo'] = $request->has('activo') ? 1 : 0;

        // Si se está subiendo un archivo de imagen
        if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen && File::exists(public_path($producto->imagen))) {
                File::delete(public_path($producto->imagen));
            }

            $archivo = $request->file('imagen');
            $extension = $archivo->getClientOriginalExtension();
            $nombreImagen = str_replace(' ', '_', $request->nombre) . '_' . time() . '.' . $extension;

            // Guardar nueva imagen
            $archivo->move(public_path('productos'), $nombreImagen);
            $data['imagen'] = 'productos/' . $nombreImagen;
        }

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

    public function catalogo()
    {
        $productos = Producto::where('activo', true)->paginate(12);
        return view('productos.catalogo', compact('productos'));
    }

    public function detalles(Producto $producto)
    {
        return view('productos.detalles', compact('producto'));
    }
}
