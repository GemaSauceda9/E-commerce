<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $producto->nombre }} - {{ config('store.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <x-header />
    
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Detalles del Producto</h1>
            <div class="flex space-x-2">
                <a href="{{ route('productos.edit', $producto) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('productos.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/3 p-4">
                    @if($producto->imagen)
                        <img src="{{ asset( $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-auto rounded-lg shadow">
                    @else
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>
                
                <div class="md:w-2/3 p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $producto->nombre }}</h2>
                            <p class="text-gray-500">SKU: {{ $producto->sku }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-[#690375]">${{ number_format($producto->precio, 2) }}</p>
                            <p class="text-gray-600">
                                @if($producto->stock > 0)
                                    <span class="text-green-600">En stock ({{ $producto->stock }})</span>
                                @else
                                    <span class="text-red-600">Agotado</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Descripción Corta</h3>
                            <p class="text-gray-600 mt-1">{{ $producto->descripcion }}</p>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Descripción Detallada</h3>
                            <div class="text-gray-600 mt-1 prose max-w-none">
                                {!! nl2br(e($producto->descripcion_larga)) !!}
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mt-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Categoría</h3>
                                <p class="text-gray-600 mt-1">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">Estado</h3>
                                <p class="mt-1">
                                    @if($producto->activo)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    @endif
                                    
                                    @if($producto->destacado)
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Destacado
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        @if($producto->etiquetas->count() > 0)
                            <div class="mt-6">
                                <h3 class="text-lg font-semibold text-gray-700">Etiquetas</h3>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach($producto->etiquetas as $etiqueta)
                                        <span class="px-2 py-1 bg-gray-200 text-gray-700 rounded-full text-sm">
                                            {{ $etiqueta->nombre }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
