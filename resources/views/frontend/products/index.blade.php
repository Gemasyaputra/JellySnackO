@extends('layouts.app')

@section('content')
    <style>
        /* === PAGE HEADER === */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2.5rem;
            font-weight: 700;
            position: relative;
            display: inline-block;
            padding-bottom: 0.5rem;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #063C0F 0%, #B7AF83 100%);
            border-radius: 2px;
        }

        /* === FILTER CARD === */
        .filter-card {
            background-color: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .filter-card .card-body {
            padding: 2rem;
        }

        .filter-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .filter-header i {
            color: #7B8D63;
            font-size: 1.5rem;
        }

        .filter-header h5 {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-weight: 700;
            margin: 0;
            font-size: 1.2rem;
        }

        .form-label {
            color: #555;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #7B8D63;
            box-shadow: 0 0 0 0.25rem rgba(123, 141, 99, 0.15);
        }

        .form-control::placeholder {
            color: #aaa;
        }

        /* === FILTER BUTTONS === */
        .btn-filter {
            background-color: #063C0F;
            color: #ffffff;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
        }

        .btn-filter:hover {
            background-color: #084d14;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        .btn-reset {
            background-color: #f5f5f5;
            color: #666;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            background-color: #B7AF83;
            color: #ffffff;
            border-color: #B7AF83;
        }

        /* === PRODUCT CARD === */
        .product-card {
            background-color: #ffffff;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            height: 100%;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .product-card .card-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 20px 20px 0 0;
        }

        .product-card .card-img-top {
            height: 240px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .product-card .card-body {
            padding: 1.5rem;
            background-color: #ffffff;
        }

        .product-card .card-header-info {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .product-card .card-title {
            color: #1a1a1a;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
            line-height: 1.3;
            flex: 1;
        }

        .product-card .card-price {
            color: #1a1a1a;
            font-size: 1.1rem;
            font-weight: 700;
            margin-left: 1rem;
            white-space: nowrap;
        }

        .btn-detail {
            background-color: #063C0F;
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .btn-detail:hover {
            background-color: #137423;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .empty-state i {
            font-size: 5rem;
            color: #B7AF83;
            margin-bottom: 1.5rem;
        }

        .empty-state h4 {
            color: #063C0F;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            color: #7B8D63;
            font-size: 1.1rem;
        }

        /* === PAGINATION === */
        .pagination-wrapper {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            gap: 0.5rem;
        }

        .pagination .page-link {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            color: #063C0F;
            padding: 0.6rem 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover {
            background-color: #B7AF83;
            border-color: #B7AF83;
            color: #ffffff;
        }

        .pagination .page-item.active .page-link {
            background-color: #063C0F;
            border-color: #063C0F;
            color: #ffffff;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .filter-card .card-body {
                padding: 1.5rem;
            }

            .btn-filter, .btn-reset {
                width: 100%;
                margin-bottom: 0.5rem;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">Semua Produk</h1>
    </div>

    {{-- Filter Card --}}
    <div class="card filter-card">
        <div class="card-body">
            <div class="filter-header">
                <i class="bi bi-funnel-fill"></i>
                <h5>Filter & Pencarian</h5>
            </div>

            <form action="{{ route('products.index') }}" method="GET">
                <div class="row g-3">
                    {{-- Baris Pertama: Search & Kategori --}}
                    <div class="col-md-8">
                        <label for="search" class="form-label">
                            <i class="bi bi-search"></i> Cari Produk
                        </label>
                        <input 
                            type="text" 
                            name="search" 
                            id="search" 
                            class="form-control"
                            value="{{ request('search') }}" 
                            placeholder="Masukkan nama snack...">
                    </div>
                    <div class="col-md-4">
                        <label for="category" class="form-label">
                            <i class="bi bi-tag-fill"></i> Kategori
                        </label>
                        <select name="category" id="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Baris Kedua: Harga & Sortir --}}
                    <div class="col-md-3">
                        <label for="min_price" class="form-label">
                            <i class="bi bi-currency-dollar"></i> Harga Minimum
                        </label>
                        <input 
                            type="number" 
                            name="min_price" 
                            id="min_price" 
                            class="form-control"
                            value="{{ request('min_price') }}" 
                            placeholder="Rp 0">
                    </div>
                    <div class="col-md-3">
                        <label for="max_price" class="form-label">
                            <i class="bi bi-currency-dollar"></i> Harga Maximum
                        </label>
                        <input 
                            type="number" 
                            name="max_price" 
                            id="max_price" 
                            class="form-control"
                            value="{{ request('max_price') }}" 
                            placeholder="Rp 100.000">
                    </div>
                    <div class="col-md-3">
                        <label for="sort" class="form-label">
                            <i class="bi bi-sort-down"></i> Urutkan
                        </label>
                        <select name="sort" id="sort" class="form-select">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                            <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
                            <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
                        </select>
                    </div>

                    {{-- Baris Ketiga: Tombol --}}
                    <div class="col-md-3 d-flex align-items-end gap-2">
                        <button type="submit" class="btn btn-filter flex-grow-1">
                            <i class="bi bi-check-circle"></i> Terapkan
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-reset">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <div class="card-img-wrapper">
                        <img src="{{ Storage::url($product->image_path) }}" class="card-img-top" alt="{{ $product->name }}">
                    </div>
                    <div class="card-body">
                        <div class="card-header-info">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <div class="card-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-detail">
                            <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>Produk Tidak Ditemukan</h4>
                    <p>Maaf, tidak ada produk yang sesuai dengan filter Anda. Coba ubah filter atau reset pencarian.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
@endsection