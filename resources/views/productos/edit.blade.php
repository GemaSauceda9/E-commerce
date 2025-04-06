<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - {{ config('store.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <x-header />
    
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Editar Producto</h1>
            <a href="{{ route('productos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Volver
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="sku" class="block text-sm font-medium text-gray-700 mb-1">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $producto->sku) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio</label>
                        <input type="number" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" step="0.01" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $producto->stock) }}" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        <select name="categoria_id" id="categoria_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label for="imagen" class="block text-sm font-medium text-gray-700 mb-1">Imagen</label>
                        @if($producto->imagen)
                            <div class="mb-2">
                                <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-20 w-20 object-cover rounded">
                            </div>
                        @endif
                        <input type="file" name="imagen" id="imagen" class="w-full text-gray-700 px-3 py-2 border rounded-md">
                        <p class="text-xs text-gray-500 mt-1">Deja este campo vacío si no quieres cambiar la imagen actual.</p>
                    </div>
                    
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center">
                            <input type="checkbox" name="destacado" id="destacado" value="1" {{ old('destacado', $producto->destacado) ? 'checked' : '' }} class="h-4 w-4 text-[#690375] focus:ring-[#690375] border-gray-300 rounded">
                            <label for="destacado" class="ml-2 block text-sm text-gray-700">Destacado</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="activo" id="activo" value="1" {{ old('activo', $producto->activo) ? 'checked' : '' }} class="h-4 w-4 text-[#690375] focus:ring-[#690375] border-gray-300 rounded">
                            <label for="activo" class="ml-2 block text-sm text-gray-700">Activo</label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-1">Descripción Corta</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>
                
                <div class="mt-6">
                    <label for="descripcion_larga" class="block text-sm font-medium text-gray-700 mb-1">Descripción Larga</label>
                    <textarea name="descripcion_larga" id="descripcion_larga" rows="6" class="w-full rounded-md border-gray-300 shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">{{ old('descripcion_larga', $producto->descripcion_larga) }}</textarea>
                </div>
                
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Etiquetas</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($etiquetas as $etiqueta)
                            <div class="flex items-center">
                                <input type="checkbox" name="etiquetas[]" id="etiqueta_{{ $etiqueta->id }}" value="{{ $etiqueta->id }}" 
                                    {{ in_array($etiqueta->id, old('etiquetas', $producto->etiquetas->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="h-4 w-4 text-[#690375] focus:ring-[#690375] border-gray-300 rounded">
                                <label for="etiqueta_{{ $etiqueta->id }}" class="ml-2 block text-sm text-gray-700">{{ $etiqueta->nombre }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="mt-8">
                    <button type="submit" class="bg-[#690375] hover:bg-[#4f0257] text-white font-bold py-2 px-4 rounded">
                        Actualizar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
