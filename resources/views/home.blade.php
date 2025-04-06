<x-layout>
    <x-slot:title>
        Inicio | Mi Tienda
    </x-slot>
    
    <!-- Banner principal -->
    <x-banner />
    
    <!-- Sección de productos recomendados -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-[#0B0A07] mb-8 text-center">Productos Recomendados</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($productosRecomendados as $producto)
                    <x-product-card :producto="$producto" />
                @endforeach
            </div>
            
            <div class="text-center mt-10">
                <a href="{{ route('productos.all') }}" class="bg-[#690375] text-white px-6 py-3 rounded-lg font-semibold hover:bg-opacity-90 transition duration-300 inline-block">
                    Ver todos los productos
                </a>
            </div>
        </div>
    </section>
    
    <!-- Sección de categorías destacadas -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-[#0B0A07] mb-8 text-center">Categorías Destacadas</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="#" class="block group">
                    <div class="relative h-60 rounded-lg overflow-hidden">
                        <img src="{{ asset('img/electronica_categoria.jpg') }}" alt="Categoría 1" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-[#0B0A07] bg-opacity-40 flex items-center justify-center">
                            <h3 class="text-white text-2xl font-bold">Electrónica</h3>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="block group">
                    <div class="relative h-60 rounded-lg overflow-hidden">
                        <img src="{{ asset('img/moda_categoria.jpg') }}" alt="Categoría 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-[#0B0A07] bg-opacity-40 flex items-center justify-center">
                            <h3 class="text-white text-2xl font-bold">Ropa</h3>
                        </div>
                    </div>
                </a>
                
                <a href="#" class="block group">
                    <div class="relative h-60 rounded-lg overflow-hidden">
                        <img src="{{ asset('img/hogar_categoria.jpg') }}" alt="Categoría 3" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-[#0B0A07] bg-opacity-40 flex items-center justify-center">
                            <h3 class="text-white text-2xl font-bold">Hogar</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</x-layout>
