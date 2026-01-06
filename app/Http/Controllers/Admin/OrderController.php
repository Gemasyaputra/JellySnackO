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

        $newStatus = $request->status;
        $order->update(['status' => $newStatus]);

        // --- LOGIKA NOTIFIKASI WHATSAPP DIMULAI DI SINI ---

        $phone = $order->phone_number;
        // Format nomor telepon ke format internasional (62), jika dimulai dengan 0
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $message = '';

        // 3. Buat pesan berdasarkan status baru
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
                $message = "Dengan berat hati kami memberitahukan bahwa pesanan #{$order->id} Anda telah dibatalkan.";
                break;
        }

        // 4. Kirim pesan jika ada pesan yang perlu dikirim
        if (!empty($message)) {
            $whatsAppService->sendMessage($phone, $message);
        }
        
        // --- LOGIKA NOTIFIKASI WHATSAPP SELESAI ---

        return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diperbarui.');
    }
}

