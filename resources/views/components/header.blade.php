<header class="bg-[#690375] text-white shadow-lg">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold">{{ config('store.name') }}</a>
            </div>
            
            <nav class="hidden md:flex space-x-8">
                <a href=""" class="hover:text-gray-200 transition">Inicio</a>
                <a href="" class="hover:text-gray-200 transition">Productos</a>
                <a href="" class="hover:text-gray-200 transition">Categorías</a>
                <a href="" class="hover:text-gray-2pindex00 transition">Contacto</a>
            </nav>
            
            <div class="flex items-center space-x-4">
                @auth
                <a href="{{ route('cart.index') }}" class="hover:text-gray-200 transition relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @php
                        $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('cantidad');
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-200 transition">Panel Admin</a>
                @endif
                <a href="{{ route('dashboard') }}" class="hover:text-gray-200 transition">Mi cuenta</a>
                @else
                <a href="{{ route('login') }}" class="hover:text-gray-200 transition">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </div>
</header>
