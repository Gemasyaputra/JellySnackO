@extends('layouts.admin')

@section('title', 'Manajemen Produk')

@section('content')
    <style>
        /* === PAGE HEADER === */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
        }

        .btn-add {
            background-color: #063C0F;
            color: #FFFBE2;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add:hover {
            background-color: #084d14;
            color: #FFFBE2;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        /* === ALERT === */
        .alert-success {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border: 2px solid #66bb6a;
            border-radius: 12px;
            color: #2e7d32;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
        }

        .alert-success::before {
            content: '✓';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background-color: #2e7d32;
            color: #ffffff;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* === TABLE CARD === */
        .table-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table-card .card-body {
            padding: 0;
        }

        /* === TABLE STYLES === */
        .products-table {
            margin: 0;
            width: 100%;
        }

        .products-table thead {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%) !important;
        }

        .products-table thead th {
            color: #ffffff !important;
            background-color: transparent !important;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1.25rem 1.5rem !important;
            border: none !important;
            white-space: nowrap;
        }

        .products-table tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .products-table tbody tr:last-child td {
            border-bottom: none;
        }

        .products-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* === PRODUCT IMAGE === */
        .product-img-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
            font-size: 0.75rem;
            text-align: center;
            padding: 0.5rem;
        }

        /* === PRODUCT INFO === */
        .product-name {
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .product-category {
            display: inline-block;
            background-color: #B7AF83;
            color: #063C0F;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .product-price {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.1rem;
        }

        .product-stock {
            font-weight: 700;
            font-size: 1rem;
        }

        .stock-good {
            color: #2e7d32;
        }

        .stock-low {
            color: #e65100;
        }

        .stock-out {
            color: #c62828;
        }

        /* === ACTION BUTTONS === */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-edit {
            background-color: #ffa726;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-edit:hover {
            background-color: #fb8c00;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 167, 38, 0.3);
        }

        .btn-delete {
            background-color: #ef5350;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-delete:hover {
            background-color: #e53935;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 83, 80, 0.3);
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 5rem;
            color: #B7AF83;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .empty-state h4 {
            color: #063C0F;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            color: #7B8D63;
            font-size: 1rem;
        }

        /* === PAGINATION === */
        .pagination-wrapper {
            padding: 1.5rem;
            display: flex;
            justify-content: center;
            background-color: #f8f9fa;
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
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .products-table {
                font-size: 0.85rem;
            }

            .products-table thead th,
            .products-table tbody td {
                padding: 0.75rem 1rem;
            }

            .product-img-wrapper,
            .no-image {
                width: 60px;
                height: 60px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-edit,
            .btn-delete {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-box-seam"></i> Manajemen Produk
        </h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Products Table --}}
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table products-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image_path)
                                        <div class="product-img-wrapper">
                                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}">
                                        </div>
                                    @else
                                        <div class="no-image">
                                            <i class="bi bi-image"></i>
                                            <br>No Image
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="product-name">{{ $product->name }}</div>
                                </td>
                                <td>
                                    <span class="product-category">{{ $product->category->name }}</span>
                                </td>
                                <td>
                                    <div class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    <div class="product-stock 
                                        @if($product->stock > 10) stock-good
                                        @elseif($product->stock > 0) stock-low
                                        @else stock-out
                                        @endif">
                                        {{ $product->stock }} unit
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h4>Belum Ada Produk</h4>
                                        <p>Silakan tambah produk baru untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($products->hasPages())
                <div class="pagination-wrapper">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection