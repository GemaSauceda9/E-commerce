<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Producto;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('producto')
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->cantidad * $item->producto->precio;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function add(Request $request, Producto $producto)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('producto_id', $producto->id)
            ->first();

        if ($cartItem) {
            $cartItem->cantidad += $request->cantidad;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'producto_id' => $producto->id,
                'cantidad' => $request->cantidad,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Producto añadido al carrito');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'cantidad' => $request->cantidad,
        ]);

        return redirect()->route('cart.index')->with('success', 'Carrito actualizado');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }
}
