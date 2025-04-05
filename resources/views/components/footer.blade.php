<footer class="bg-[#0B0A07] text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">{{ config('store.name') }}</h3>
                <p class="text-gray-300">{{ config('store.description') }}</p>
            </div>
            
            <div>
                <h3 class="text-xl font-bold mb-4">Enlaces</h3>
                <ul class="space-y-2 text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Inicio</a></li>
                    <li><a href="{{ route('productos.index') }}" class="hover:text-white transition">Productos</a></li>
                    <li><a href="{{ route('categorias.index') }}" class="hover:text-white transition">Categorías</a></li>
                    <li><a href="#" class="hover:text-white transition">Sobre nosotros</a></li>
                </ul>
            </div>
            
            <div>
                <h3 class="text-xl font-bold mb-4">Contacto</h3>
                <ul class="space-y-2 text-gray-300">
                    <li>Email: info@mitienda.com</li>
                    <li>Teléfono: +123 456 7890</li>
                    <li>Dirección: Calle Principal 123</li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Mi Tienda. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
