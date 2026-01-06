<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Memulai query builder untuk produk
        $query = Product::query();

        // 1. Filter berdasarkan pencarian (search)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 2. Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 3. Filter berdasarkan rentang harga
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 4. Proses sorting (pengurutan)
        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort == 'termahal') {
                $query->orderBy('price', 'desc');
            }
        } else {
            // Default sort: terbaru
            $query->latest();
        }

        // Ambil data kategori untuk ditampilkan di form filter
        $categories = Category::all();

        // Eksekusi query dengan paginasi
        // withQueryString() penting agar filter tetap aktif saat pindah halaman
        $products = $query->paginate(8)->withQueryString();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('frontend.products.show', compact('product'));
    }
}
