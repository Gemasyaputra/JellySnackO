<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
   public function index()
{
    // Menghitung total pendapatan dari pesanan yang sudah selesai
    $totalRevenue = Order::where('status', 'selesai')->sum('total_price');

    // Menghitung jumlah pesanan yang masih perlu diproses
    $newOrdersCount = Order::whereIn('status', ['menunggu konfirmasi admin', 'diproses'])->count();
    
    // Menghitung jumlah pelanggan (user dengan role 'user')
    $customersCount = User::where('role', 'user')->count();
    
    // Menghitung produk yang stoknya akan habis (misal, di bawah 5)
    $lowStockCount = Product::where('stock', '<', 5)->count();

    // Mengambil 5 pesanan terbaru untuk ditampilkan di tabel
    $latestOrders = Order::with('user')->latest()->take(5)->get();

    // Mengambil produk yang stoknya menipis
    $lowStockProducts = Product::where('stock', '<', 5)->get();
    
    // Mengirim semua data ke view
    return view('admin.dashboard', compact(
        'totalRevenue',
        'newOrdersCount',
        'customersCount',
        'lowStockCount',
        'latestOrders',
        'lowStockProducts'
    ));
}
}