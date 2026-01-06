@extends('layouts.app')

@section('content')
    <style>
        /* === HERO SECTION === */
        .hero-section {
            background: linear-gradient(135deg, #FFFBE2 0%, #f5f2dc 100%);
            padding: 5rem 2rem;
            margin-bottom: 4rem;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '🍪';
            position: absolute;
            top: -30px;
            right: 8%;
            font-size: 150px;
            opacity: 0.08;
            transform: rotate(-15deg);
            animation: float 6s ease-in-out infinite;
        }

        .hero-section::after {
            content: '🥨';
            position: absolute;
            bottom: -30px;
            left: 5%;
            font-size: 120px;
            opacity: 0.08;
            transform: rotate(15deg);
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(-15deg); }
            50% { transform: translateY(-20px) rotate(-20deg); }
        }

        .hero-content {
            max-width: 700px;
            margin: 0 auto;
        }

        .hero-section h1 {
            color: #063C0F;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            line-height: 1.2;
        }

        .hero-section p {
            color: #7B8D63;
            font-size: 1.3rem;
            font-weight: 400;
            margin-bottom: 2rem;
        }

        .hero-badges {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .badge-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #063C0F;
            font-weight: 600;
        }

        .badge-item i {
            color: #B7AF83;
            font-size: 1.5rem;
        }

        .btn-hero {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            color: #FFFBE2;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-hero:hover {
            background: linear-gradient(135deg, #084d14 0%, #063C0F 100%);
            color: #FFFBE2;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(6, 60, 15, 0.4);
        }

        /* === FEATURES SECTION === */
        .features-section {
            margin-bottom: 4rem;
        }

        .feature-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2.5rem;
        }

        .feature-card h3 {
            color: #063C0F;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #666;
            margin: 0;
            line-height: 1.6;
        }

        /* === SECTION HEADER === */
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-header h2 {
            color: #063C0F;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #063C0F 0%, #B7AF83 100%);
            border-radius: 2px;
        }

        .section-header p {
            color: #7B8D63;
            font-size: 1.1rem;
            margin-top: 1.5rem;
        }

        /* === CATEGORY SECTION === */
        .category-section {
            margin-bottom: 4rem;
        }

        .category-card {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .category-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(183, 175, 131, 0.2) 0%, transparent 70%);
            transition: all 0.5s ease;
        }

        .category-card:hover::before {
            top: -60%;
            right: -60%;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(6, 60, 15, 0.3);
        }

        .category-card i {
            font-size: 3rem;
            color: #B7AF83;
            margin-bottom: 1rem;
            z-index: 1;
        }

        .category-card h4 {
            color: #FFFBE2;
            font-weight: 700;
            margin: 0;
            z-index: 1;
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
            color: #063C0F;
            font-size: 1.1rem;
            font-weight: 700;
            margin-left: 1rem;
            white-space: nowrap;
        }

        .btn-detail {
            background-color: #17a2b8;
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
            background-color: #138496;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
        }

        /* === CTA SECTION === */
        .cta-section {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            border-radius: 20px;
            padding: 4rem 2rem;
            text-align: center;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '✨';
            position: absolute;
            top: 20px;
            left: 10%;
            font-size: 60px;
            opacity: 0.2;
        }

        .cta-section::after {
            content: '🎉';
            position: absolute;
            bottom: 20px;
            right: 10%;
            font-size: 60px;
            opacity: 0.2;
        }

        .cta-section h2 {
            color: #FFFBE2;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-section p {
            color: #B7AF83;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .btn-cta {
            background-color: #B7AF83;
            color: #063C0F;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-cta:hover {
            background-color: #9a9370;
            color: #063C0F;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(183, 175, 131, 0.4);
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 3rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .empty-state i {
            font-size: 4rem;
            color: #B7AF83;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #7B8D63;
            font-size: 1.1rem;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 1.5rem;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1.1rem;
            }

            .hero-badges {
                gap: 1rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .cta-section h2 {
                font-size: 2rem;
            }

            .cta-section {
                padding: 3rem 1.5rem;
            }
        }
    </style>

    {{-- Hero Section --}}
    <div class="hero-section text-center">
        <div class="hero-content">
            <h1>Selamat Datang di Jelly SnackO</h1>
            <p>Camilan Sehat, Alami & Homemade untuk Keluarga Indonesia</p>
            
            <div class="hero-badges">
                <div class="badge-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>100% Natural</span>
                </div>
                <div class="badge-item">
                    <i class="bi bi-heart-fill"></i>
                    <span>Homemade</span>
                </div>
                <div class="badge-item">
                    <i class="bi bi-shield-check"></i>
                    <span>Terjamin Halal</span>
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-hero">
                <i class="bi bi-bag-heart-fill"></i> Belanja Sekarang
            </a>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="features-section">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        🚚
                    </div>
                    <h3>Pengiriman Cepat</h3>
                    <p>Produk fresh sampai di tangan Anda dengan packaging yang aman</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        🌿
                    </div>
                    <h3>Bahan Alami</h3>
                    <p>Menggunakan bahan pilihan berkualitas tanpa pengawet berbahaya</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        💯
                    </div>
                    <h3>Kualitas Terjamin</h3>
                    <p>Setiap produk melalui quality control ketat sebelum dikirim</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Category Section --}}
    <div class="category-section">
        <div class="section-header">
            <h2>Kategori Produk</h2>
            <p>Pilih kategori favoritmu</p>
        </div>
        <div class="row g-3">
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('products.index') }}?category=1" style="text-decoration: none;">
                    <div class="category-card">
                        <i class="bi bi-cookie"></i>
                        <h4>Snack Kering</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('products.index') }}?category=2" style="text-decoration: none;">
                    <div class="category-card">
                        <i class="bi bi-egg-fried"></i>
                        <h4>Snack Basah</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('products.index') }}?category=3" style="text-decoration: none;">
                    <div class="category-card">
                        <i class="bi bi-cup-straw"></i>
                        <h4>Minuman</h4>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ route('products.index') }}" style="text-decoration: none;">
                    <div class="category-card">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <h4>Semua Produk</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- Products Section --}}
    <div class="section-header">
        <h2>Produk Terbaru</h2>
        <p>Jangan lewatkan produk-produk terbaru kami</p>
    </div>

    <div class="row g-4">
        @forelse($latestProducts as $product)
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
                    <p>Belum ada produk.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- CTA Section --}}
    <div class="cta-section">
        <h2>Siap Mencoba Camilan Sehat Kami?</h2>
        <p>Dapatkan diskon spesial untuk pembelian pertama Anda!</p>
        <a href="{{ route('products.index') }}" class="btn btn-cta">
            <i class="bi bi-cart-plus-fill"></i> Mulai Belanja
        </a>
    </div>
@endsection