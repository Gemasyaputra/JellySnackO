@extends('layouts.app')

@section('content')
    <style>
        /* === PAGE HEADER === */
        .page-header {
            margin-bottom: 2.5rem;
            text-align: center;
            padding-top: 1rem;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .page-title i {
            color: #B7AF83;
        }

        .page-subtitle {
            color: #7B8D63;
            font-size: 1rem;
        }

        /* === ALERT === */
        .alert-success {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border: 2px solid #66bb6a;
            border-radius: 12px;
            color: #2e7d32;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
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

        /* === CART CONTAINER === */
        .cart-container {
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        /* === CART TABLE DEFAULT (DESKTOP) === */
        .cart-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .cart-table thead {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
        }

        .cart-table thead th {
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1.5rem 1.5rem;
            border: none;
            white-space: nowrap;
            text-align: left;
        }

        .cart-table tbody td {
            padding: 1.5rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .cart-table tbody tr:last-child td {
            border-bottom: none;
        }

        .cart-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* === PRODUCT INFO === */
        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .product-name {
            font-weight: 600;
            color: #1a1a1a;
            font-size: 1rem;
        }

        .product-price, .product-subtotal {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.05rem;
        }

        /* === QUANTITY FORM === */
        .quantity-form {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-input {
            width: 60px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.5rem;
            font-weight: 600;
            text-align: center;
            transition: all 0.2s ease;
        }

        .quantity-input:focus {
            border-color: #7B8D63;
            outline: none;
        }

        /* Buttons */
        .btn-update, .btn-remove {
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
        }

        .btn-update {
            background-color: #7B8D63;
            color: #ffffff;
        }

        .btn-update:hover {
            background-color: #6a7a56;
            transform: translateY(-2px);
        }

        .btn-remove {
            background-color: #ef5350;
            color: #ffffff;
        }

        .btn-remove:hover {
            background-color: #e53935;
            transform: translateY(-2px);
        }

        /* === CART SUMMARY === */
        .cart-summary {
            background: linear-gradient(135deg, #f9f9f9 0%, #f0f0f0 100%);
            padding: 2rem;
            border-top: 3px solid #063C0F;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 0.5rem;
        }

        .total-label {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            color: #063C0F;
            font-size: 1.3rem;
        }

        .total-value {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            color: #063C0F;
            font-size: 1.5rem;
        }

        /* === CHECKOUT BUTTONS === */
        .checkout-section {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-continue, .btn-checkout, .btn-shop {
            padding: 0.875rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
        }

        .btn-continue {
            background-color: #f5f5f5;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-continue:hover {
            background-color: #B7AF83;
            color: #ffffff;
            border-color: #B7AF83;
        }

        .btn-checkout, .btn-shop {
            background-color: #063C0F;
            color: #ffffff;
            border: none;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
        }

        .btn-checkout:hover, .btn-shop:hover {
            background-color: #084d14;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        /* === EMPTY CART === */
        .empty-cart {
            text-align: center;
            padding: 5rem 2rem;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        }
        .empty-cart i { font-size: 6rem; color: #B7AF83; margin-bottom: 2rem; opacity: 0.5; }
        .empty-cart h3 { font-family: 'Merriweather', serif; color: #063C0F; font-weight: 700; margin-bottom: 1rem; }
        .empty-cart p { color: #7B8D63; font-size: 1.1rem; margin-bottom: 2rem; }


        /* =========================================
           RESPONSIVE MOBILE STYLES (CARD VIEW)
           ========================================= */
        @media (max-width: 768px) {
            .page-title { font-size: 1.8rem; flex-direction: column; gap: 0.5rem; }
            
            /* Sembunyikan Header Tabel */
            .cart-table thead { display: none; }
            
            /* Ubah Baris (TR) menjadi Kartu */
            .cart-table tbody tr {
                display: block;
                background-color: #fff;
                border: 1px solid #e0e0e0;
                border-radius: 12px;
                margin-bottom: 1rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.05);
                padding: 1rem;
            }

            /* Ubah Kolom (TD) menjadi baris flex */
            .cart-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 0;
                border-bottom: 1px solid #f0f0f0;
                text-align: right;
            }

            /* Hapus border pada elemen terakhir */
            .cart-table tbody td:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            /* Tambahkan Label di sebelah kiri menggunakan data-label */
            .cart-table tbody td::before {
                content: attr(data-label);
                font-weight: 700;
                color: #7B8D63;
                text-transform: uppercase;
                font-size: 0.75rem;
                text-align: left;
                margin-right: 1rem;
            }

            /* Khusus untuk Produk (Gambar + Nama) */
            .cart-table tbody td[data-label="Produk"] {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            .cart-table tbody td[data-label="Produk"]::before {
                display: none; /* Sembunyikan label "Produk" agar lebih bersih */
            }
            .product-info {
                width: 100%;
                gap: 1rem;
            }

            /* Styling Input Quantity Mobile */
            .quantity-form {
                width: 100%;
                justify-content: flex-end;
            }
            
            /* Tombol Checkout responsive */
            .checkout-section {
                flex-direction: column;
                gap: 0.8rem;
            }
            .btn-continue, .btn-checkout {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-cart3"></i>
            Keranjang Belanja
        </h1>
        <p class="page-subtitle">Kelola produk yang ingin Anda beli</p>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Cart Content --}}
    @if (count($cartItems) > 0)
        <div class="cart-container">
            <div class="table-responsive"> {{-- Wrapper opsional --}}
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $subtotal = $item->price * $item->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                {{-- PERHATIKAN: Saya menambahkan data-label="" untuk mobile --}}
                                <td data-label="Produk">
                                    <div class="product-info">
                                        <img src="{{ Storage::url($item->attributes->image) }}" 
                                             alt="{{ $item->name }}" 
                                             class="product-image">
                                        <span class="product-name">{{ $item->name }}</span>
                                    </div>
                                </td>
                                <td data-label="Harga">
                                    <div class="product-price">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td data-label="Jumlah">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="quantity-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" 
                                               name="quantity" 
                                               value="{{ $item->quantity }}" 
                                               class="quantity-input"
                                               min="1">
                                        <button type="submit" class="btn-update">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </form>
                                </td>
                                <td data-label="Subtotal">
                                    <div class="product-subtotal">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td data-label="Aksi">
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Cart Summary --}}
            <div class="cart-summary">
                <div class="summary-row total-row">
                    <span class="total-label">Total Pembayaran:</span>
                    <span class="total-value">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <div class="checkout-section">
                    <a href="{{ route('home') }}" class="btn-continue">
                        <i class="bi bi-arrow-left"></i>
                        Lanjut Belanja
                    </a>
                    <a href="{{ route('checkout.index') }}" class="btn-checkout">
                        <i class="bi bi-credit-card"></i>
                        Lanjut ke Checkout
                    </a>
                </div>
            </div>
        </div>
    @else
        {{-- Empty Cart --}}
        <div class="empty-cart">
            <i class="bi bi-cart-x"></i>
            <h3>Keranjang Belanja Kosong</h3>
            <p>Anda belum menambahkan produk apapun ke keranjang</p>
            <a href="{{ route('home') }}" class="btn-shop">
                <i class="bi bi-shop"></i>
                Mulai Belanja
            </a>
        </div>
    @endif
@endsection