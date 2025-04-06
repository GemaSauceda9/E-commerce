<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Bienvenido al panel de administración</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ route('productos.index') }}" class="bg-purple-100 p-6 rounded-lg shadow hover:shadow-lg transition">
                            <h4 class="font-bold text-purple-800 mb-2">Gestionar Productos</h4>
                            <p class="text-purple-600">Administra el catálogo de productos.</p>
                        </a>
                        
                        <a href="{{ route('categorias.index') }}" class="bg-blue-100 p-6 rounded-lg shadow hover:shadow-lg transition">
                            <h4 class="font-bold text-blue-800 mb-2">Gestionar Categorías</h4>
                            <p class="text-blue-600">Administra las categorías de productos.</p>
                        </a>
                        
                        <a href="{{ route('etiquetas.index') }}" class="bg-green-100 p-6 rounded-lg shadow hover:shadow-lg transition">
                            <h4 class="font-bold text-green-800 mb-2">Gestionar Etiquetas</h4>
                            <p class="text-green-600">Administra las etiquetas de productos.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
