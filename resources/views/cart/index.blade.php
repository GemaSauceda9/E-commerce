<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Mi Carrito</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($cartItems->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Producto</th>
                            <th class="text-center py-2">Precio</th>
                            <th class="text-center py-2">Cantidad</th>
                            <th class="text-center py-2">Subtotal</th>
                            <th class="text-center py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr class="border-b">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="{{ $item->producto->imagen ? asset($item->producto->imagen) : 'https://via.placeholder.com/80x80' }}" alt="{{ $item->producto->nombre }}" class="w-16 h-16 object-cover rounded">
                                        <div class="ml-4">
                                            <h3 class="font-medium">{{ $item->producto->nombre }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center py-4">${{ $item->producto->precio }}</td>
                                <td class="text-center py-4">
                                    <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center justify-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" class="border rounded w-16 text-center py-1">
                                        <button type="submit" class="ml-2 text-gray-600 hover:text-[#690375]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center py-4">${{ number_format($item->producto->precio * $item->cantidad, 2) }}</td>
                                <td class="text-center py-4">
                                    <form action="{{ route('cart.remove', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-8 flex justify-between items-center">
                    <a href="{{ route('productos.all') }}" class="text-[#690375] hover:underline">
                        ← Seguir comprando
                    </a>
                    <div class="text-right">
                        <p class="text-lg font-bold">Total: ${{ number_format($total, 2) }}</p>
                        <button class="mt-4 bg-[#690375] text-white px-6 py-2 rounded hover:bg-opacity-90 transition-colors">
                            Proceder al pago
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <p class="text-gray-500 mb-4">Tu carrito está vacío</p>
                <a href="{{ route('productos.all') }}" class="text-[#690375] hover:underline">
                    ← Ir a comprar
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
