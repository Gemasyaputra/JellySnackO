<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Pastikan user hanya bisa melihat halaman pembayaran order miliknya
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }
        return view('frontend.payment.show', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        $request->validate(['payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);

        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $proofPath = $request->file('payment_proof')->store('proofs', 'public');

        $order->payment()->create(['proof_path' => $proofPath]);

        // Opsional: Ubah status order atau biarkan admin yang verifikasi
        // $order->update(['status' => 'menunggu konfirmasi']);

        return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diunggah. Pesanan Anda akan segera kami proses.');
    }
}
