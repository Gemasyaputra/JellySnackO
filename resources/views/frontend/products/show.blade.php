@extends('layouts.app')

@section('content')
    <style>
        /* === PRODUCT DETAIL STYLES === */
        .product-detail-section {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .product-image-wrapper {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .product-image-wrapper img {
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-image-wrapper:hover img {
            transform: scale(1.05);
        }

        .product-info {
            padding: 1rem 0;
        }

        .product-title {
            font-family: 'Merriweather', serif;
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .product-price {
            color: #063C0F;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .product-meta {
            display: flex;
            gap: 2rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-item i {
            color: #7B8D63;
            font-size: 1.2rem;
        }

        .meta-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .meta-value {
            color: #1a1a1a;
            font-weight: 600;
        }

        .badge-category {
            background-color: #B7AF83;
            color: #063C0F;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge-stock {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .badge-stock.low-stock {
            background-color: #fff3e0;
            color: #e65100;
        }

        .badge-stock.out-of-stock {
            background-color: #ffebee;
            color: #c62828;
        }

        .divider {
            border: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #B7AF83, transparent);
            margin: 1.5rem 0;
        }

        .product-description {
            color: #555;
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .add-to-cart-section {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 15px;
            border: 2px dashed #B7AF83;
        }

        .quantity-label {
            color: #1a1a1a;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: block;
        }

        .quantity-input-group {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            background-color: #ffffff;
            overflow: hidden;
        }

        .quantity-btn {
            background-color: #f5f5f5;
            border: none;
            padding: 0.75rem 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #063C0F;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .quantity-btn:hover {
            background-color: #B7AF83;
            color: #ffffff;
        }

        .quantity-input {
            border: none;
            text-align: center;
            width: 60px;
            padding: 0.75rem 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            color: #1a1a1a;
        }

        .quantity-input:focus {
            outline: none;
        }

        /* Remove spinner from number input */
        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input[type=number] {
            -moz-appearance: textfield;
        }

        .btn-add-cart {
            background-color: #063C0F;
            color: #ffffff;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
        }

        .btn-add-cart:hover {
            background-color: #126620;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(23, 162, 184, 0.4);
        }

        .btn-add-cart:disabled {
            background-color: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #7B8D63;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 1.5rem;
            transition: color 0.2s ease;
        }

        .btn-back:hover {
            color: #063C0F;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .product-detail-section {
                padding: 1.5rem;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .product-price {
                font-size: 1.5rem;
            }

            .product-meta {
                gap: 1rem;
            }

            .quantity-input-group {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-add-cart {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- Back Button --}}
    <a href="{{ route('products.index') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali ke Produk
    </a>

    <div class="product-detail-section">
        <div class="row g-4">
            {{-- Product Image --}}
            <div class="col-md-6">
                <div class="product-image-wrapper">
                    <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}">
                </div>
            </div>

            {{-- Product Info --}}
            <div class="col-md-6">
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    
                    <div class="product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="product-meta">
                        <div class="meta-item">
                            <i class="bi bi-tag-fill"></i>
                            <span class="badge-category">{{ $product->category->name }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="bi bi-box-seam"></i>
                            @if($product->stock > 10)
                                <span class="badge-stock">Stok: {{ $product->stock }}</span>
                            @elseif($product->stock > 0)
                                <span class="badge-stock low-stock">Stok: {{ $product->stock }} (Terbatas)</span>
                            @else
                                <span class="badge-stock out-of-stock">Habis</span>
                            @endif
                        </div>
                    </div>

                    <hr class="divider">

                    <div class="product-description">
                        {{ $product->description ?? 'Produk berkualitas tinggi dari Jelly SnackO.' }}
                    </div>

                    <hr class="divider">

                    {{-- Add to Cart Form --}}
                    <div class="add-to-cart-section">
                        <form action="{{ route('cart.store') }}" method="POST" id="cartForm">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <label class="quantity-label">
                                <i class="bi bi-cart-check"></i> Jumlah Pembelian
                            </label>
                            
                            <div class="quantity-input-group">
                                <div class="quantity-control">
                                    <button type="button" class="quantity-btn" onclick="decreaseQuantity()">-</button>
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        id="quantityInput"
                                        class="quantity-input" 
                                        value="1" 
                                        min="1"
                                        max="{{ $product->stock }}"
                                        readonly>
                                    <button type="button" class="quantity-btn" onclick="increaseQuantity()">+</button>
                                </div>
                                
                                <button 
                                    type="submit" 
                                    class="btn-add-cart"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    <i class="bi bi-cart-plus-fill"></i>
                                    {{ $product->stock == 0 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const maxStock = {{ $product->stock }};

        function increaseQuantity() {
            const input = document.getElementById('quantityInput');
            let value = parseInt(input.value);
            if (value < maxStock) {
                input.value = value + 1;
            }
        }

        function decreaseQuantity() {
            const input = document.getElementById('quantityInput');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }
    </script>
@endsection