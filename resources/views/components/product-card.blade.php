<div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
    <div class="h-48 overflow-hidden">
        <img src="{{ $producto->imagen ? asset($producto->imagen) : 'https://via.placeholder.com/300x200' }}" alt="{{ $producto->nombre ?? 'Producto' }}" class="w-full h-full object-cover object-center">
    </div>
    
    <div class="p-4">
        <h3 class="text-[#0B0A07] font-bold text-lg mb-2">{{ $producto->nombre ?? 'Nombre del producto' }}</h3>
        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $producto->descripcion ?? 'Descripción del producto...' }}</p>
        
        <div class="flex justify-between items-center">
            <span class="text-[#690375] font-bold">${{ $producto->precio ?? '99.99' }}</span>
            <form action="{{ route('cart.add', $producto) }}" method="POST">
                @csrf
                <input type="hidden" name="cantidad" value="1">
                <button type="submit" class="bg-[#690375] text-white px-3 py-1 rounded hover:bg-opacity-90 transition-colors">
                    Añadir
                </button>
            </form>
        </div>
    </div>
</div>
