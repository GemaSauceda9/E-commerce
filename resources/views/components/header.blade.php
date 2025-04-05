<header class="bg-[#690375] text-white shadow-lg">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold">{{ config('store.name') }}</a>
            </div>
            
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" class="hover:text-gray-200 transition">Inicio</a>
                <a href="{{ route('productos.index') }}" class="hover:text-gray-200 transition">Productos</a>
                <a href="{{ route('categorias.index') }}" class="hover:text-gray-200 transition">Categorías</a>
                <a href="#" class="hover:text-gray-200 transition">Contacto</a>
            </nav>
            
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </a>
                
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-200 transition">Mi cuenta</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-200 transition">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </div>
</header>
