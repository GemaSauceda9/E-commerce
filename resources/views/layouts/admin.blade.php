<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Panel de Administración</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
</head>
<body class="bg-gray-100">
    <x-header />
    
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-[#690375] text-white hidden md:block">
            <div class="p-4">
                <h2 class="text-xl font-bold">Panel Admin</h2>
            </div>
            <nav class="mt-4">
                <a href="{{ route('dashboard') }}" class="block py-2.5 px-4 hover:bg-[#4f0257] transition">
                    Dashboard
                </a>
                <a href="{{ route('productos.index') }}" class="block py-2.5 px-4 hover:bg-[#4f0257] transition">
                    Productos
                </a>
                <a href="{{ route('categorias.index') }}" class="block py-2.5 px-4 hover:bg-[#4f0257] transition">
                    Categorías
                </a>
                <a href="{{ route('etiquetas.index') }}" class="block py-2.5 px-4 hover:bg-[#4f0257] transition">
                    Etiquetas
                </a>
            </nav>
        </div>
        
        <!-- Content -->
        <div class="flex-1">
            <div class="container mx-auto px-4 py-6">
                @yield('content')
            </div>
        </div>
    </div>
    
    @yield('scripts')
</body>
</html>
