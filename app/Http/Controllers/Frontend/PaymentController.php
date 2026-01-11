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

        // 1. Simpan Bukti Pembayaran (Kode Lama)
        $proofPath = $request->file('payment_proof')->store('proofs', 'public');
        $order->payment()->create(['proof_path' => $proofPath]);

        $order->load('items.product');

        foreach ($order->items as $item) {
            // Kurangi stok
            $item->product->decrement('stock', $item->quantity);
        }

        // Opsional: Update status jika diperlukan
        // $order->update(['status' => 'menunggu konfirmasi']);

        // 2. LOAD DATA ITEM AGAR BISA DITAMPILKAN DI CHAT
        // Kita perlu meload relasi items dan product untuk mengambil nama barang
        $order->load('items.product');

        // 3. KONFIGURASI NOMOR ADMIN
        // Ganti dengan nomor WhatsApp Admin Anda (gunakan format 628...)
        $adminPhoneNumber = '6281268257643';

        // 4. SUSUN PESAN WHATSAPP (Format Formal Tanpa Emoji)
        $user = Auth::user(); // Ambil nama user untuk identitas

        $message = "*KONFIRMASI PEMBAYARAN*\n\n";
        $message .= "Halo Admin JellySnackO,\n";
        $message .= "Saya telah melakukan pembayaran dan unggah bukti transfer. Berikut rinciannya:\n\n";

        $message .= "*DATA PESANAN*\n";
        $message .= "No. Order   : #{$order->id}\n";
        $message .= "Nama        : {$user->name}\n";
        $message .= "Total Bayar : Rp " . number_format($order->total_price, 0, ',', '.') . "\n\n";

        $message .= "*DETAIL PRODUK*\n";
        foreach ($order->items as $item) {
            $productName = $item->product ? $item->product->name : 'Produk tidak ditemukan';

            // Ambil harga dari item (pastikan di tabel order_items ada kolom price)
            // Jika tidak ada di order_items, gunakan $item->product->price
            $price = $item->price ?? $item->product->price ?? 0;

            // Hitung subtotal (Harga Satuan x Jumlah)
            $subtotal = $price * $item->quantity;

            // Format angka ke rupiah
            $fmtPrice = number_format($price, 0, ',', '.');
            $fmtSubtotal = number_format($subtotal, 0, ',', '.');

            // Hasil format: - Nama Produk (2x @ Rp 10.000) = Rp 20.000
            $message .= "- {$productName} ({$item->quantity}x @ Rp {$fmtPrice}) = Rp {$fmtSubtotal}\n";
        }

        $message .= "\nMohon pesanan segera diproses. Terima kasih.";        // 5. ENCODE PESAN DAN REDIRECT
        $encodedMessage = urlencode($message);
        $whatsappUrl = "https://wa.me/{$adminPhoneNumber}?text={$encodedMessage}";

        // Menggunakan redirect()->away() untuk membuka URL eksternal
        return redirect()->away($whatsappUrl);
    }
}
