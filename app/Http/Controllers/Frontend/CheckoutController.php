<?php

namespace App\Http\Controllers\Frontend;

use Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::getContent();
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }
        return view('frontend.checkout.index', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
            'phone' => 'required|string|max:15',
        ]);

        $cartItems = Cart::getContent();
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong.');
        }

        // Buat pesanan baru
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => Cart::getTotal(),
            'shipping_address' => $request->address,
            'phone_number' => $request->phone,
            'status' => 'menunggu konfirmasi admin',
        ]);

        // Simpan setiap item di keranjang ke order_items
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ]);
        }

        // Kosongkan keranjang
        Cart::clear();

        // Arahkan ke halaman pembayaran
        return redirect()->route('payment.show', $order)->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
    }
}
