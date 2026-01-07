<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\WhatsAppService; // <-- 1. Import Service
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product', 'payment');
        return view('admin.orders.show', compact('order'));
    }

    // 2. Inject WhatsAppService ke dalam method
    public function updateStatus(Request $request, Order $order, WhatsAppService $whatsAppService)
    {
        $request->validate(['status' => 'required|string']);

        $oldStatus = $order->status; // Simpan status lama
        $newStatus = $request->status;

        // --- LOGIKA PENGEMBALIAN STOK (RESTOCK) ---
        // Jika status baru adalah 'dibatalkan' DAN status lama BUKAN 'dibatalkan'
        if ($newStatus == 'dibatalkan' && $oldStatus != 'dibatalkan') {
            // Kembalikan stok untuk setiap item
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->increment('stock', $item->quantity);
                }
            }
        }
        // Catatan: Jika kamu ingin mengurangi stok lagi kalau admin batal membatalkan (misal dari 'dibatalkan' ubah ke 'diproses'),
        // kamu perlu tambahkan logika kebalikan (decrement) di sini.
        // ------------------------------------------

        $order->update(['status' => $newStatus]);

        // --- LOGIKA NOTIFIKASI WHATSAPP ---
        $phone = $order->phone_number;
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $message = '';

        switch ($newStatus) {
            case 'diproses':
                $message = "Halo {$order->user->name}, pembayaran untuk pesanan #{$order->id} telah kami konfirmasi. Pesanan Anda sedang kami proses. Terima kasih!";
                break;
            case 'dikirim':
                $message = "Kabar baik! Pesanan #{$order->id} Anda telah kami kirim. Semoga segera sampai!";
                break;
            case 'selesai':
                $message = "Pesanan #{$order->id} Anda telah selesai. Terima kasih telah berbelanja di Jelly SnackO!";
                break;
            case 'dibatalkan':
                $message = "Mohon maaf, pesanan #{$order->id} Anda telah dibatalkan. Silakan hubungi admin untuk info lebih lanjut.";
                break;
        }

        if (!empty($message)) {
            $whatsAppService->sendMessage($phone, $message);
        }

        return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

