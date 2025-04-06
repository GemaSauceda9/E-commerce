<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Catálogo de Productos</h1>
        
        <!-- Filtro por categoría -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <form action="{{ route('productos.all') }}" method="GET" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                <div class="w-full md:w-1/3">
                    <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Filtrar por categoría</label>
                    <select name="categoria_id" id="categoria_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#690375] focus:ring focus:ring-[#690375] focus:ring-opacity-50">
                        <option value="">Todas las categorías</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="pt-6">
                    <button type="submit" class="bg-[#690375] text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition-colors">
                        Filtrar
                    </button>
                    @if(request('categoria_id'))
                        <a href="{{ route('productos.all') }}" class="ml-2 text-[#690375] hover:underline">
                            Limpiar filtros
                        </a>
                    @endif
                </div>
            </form>
        </div>
        
        <!-- Listado de productos -->
        @if($productos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($productos as $producto)
                    <x-product-card :producto="$producto" />
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $productos->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <p class="text-gray-500">No se encontraron productos</p>
                @if(request('categoria_id'))
                    <a href="{{ route('productos.all') }}" class="mt-4 inline-block text-[#690375] hover:underline">
                        Ver todos los productos
                    </a>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>
