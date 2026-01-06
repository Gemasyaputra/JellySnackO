<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan milik pengguna yang sedang login.
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->latest()
                        ->paginate(10);
                        
        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        // Keamanan: Pastikan pesanan ini benar-benar milik pengguna yang sedang login.
        if ($order->user_id !== Auth::id()) {
            abort(403, 'UNAUTHORIZED ACTION.');
        }

        // Eager load relasi untuk efisiensi
        $order->load('items.product');

        return view('frontend.orders.show', compact('order'));
    }
}
