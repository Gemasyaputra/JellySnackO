@extends('layouts.app')

@section('content')
    <style>
        /* === COLOR PALETTE (Sesuai kode awal) === */
        :root {
            --primary-green: #063C0F;
            --secondary-green: #084d14;
            --sage-green: #7B8D63;
            --cream-bg: #FFFBE2;
            --gold-accent: #B7AF83;
        }

        /* === HERO SECTION === */
        .hero-section {
            background: linear-gradient(135deg, #FFFBE2 0%, #f5f2dc 100%);
            padding: 5rem 2rem;
            margin-bottom: 4rem;
            border-radius: 20px;
            /* Kembali ke rounded original */
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        /* Dekorasi Hero tetap sama */
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

            0%,
            100% {
                transform: translateY(0) rotate(-15deg);
            }

            50% {
                transform: translateY(-20px) rotate(-20deg);
            }
        }

        .hero-content {
            max-width: 750px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            color: var(--primary-green);
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            line-height: 1.2;
        }

        .hero-section p {
            color: var(--sage-green);
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
            color: var(--primary-green);
            font-weight: 600;
        }

        .badge-item i {
            color: var(--gold-accent);
            font-size: 1.5rem;
        }

        .btn-hero {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            /* Original Green Gradient */
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

        /* === SECTION HEADERS === */
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-header h2 {
            color: var(--primary-green);
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
            color: var(--sage-green);
            font-size: 1.1rem;
            margin-top: 1.5rem;
        }

        /* === ABOUT SECTION (Style disesuaikan dengan tema hijau) === */
        .about-section {
            margin-bottom: 5rem;
        }

        .about-container {
            background-color: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #eef0e5;
            /* Border tipis kehijauan */
        }

        .about-img {
            width: 100%;
            height: 100%;
            min-height: 350px;
            object-fit: cover;
        }

        .about-content {
            padding: 3rem;
        }

        .about-subtitle {
            color: var(--gold-accent);
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
            display: block;
        }

        .about-title {
            color: var(--primary-green);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .about-desc {
            color: #555;
            line-height: 1.8;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }

        .stat-box {
            background: var(--cream-bg);
            /* Latar krem */
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
            border: 1px solid #f0ebd0;
        }

        .stat-number {
            display: block;
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary-green);
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--sage-green);
        }

        /* === IMPROVED FEATURES SECTION === */
        .features-section {
            margin-bottom: 5rem;
            padding: 0 1rem;
        }

        .feature-item {
            background: #ffffff;
            padding: 2.5rem 2rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            /* Efek membal halus */
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
            height: 100%;
            z-index: 1;
        }

        /* Garis aksen hijau di bawah kartu */
        .feature-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: var(--primary-green, #063C0F);
            /* Gunakan variabel atau kode warna langsung */
            transition: width 0.4s ease;
        }

        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: transparent;
        }

        .feature-item:hover::after {
            width: 100%;
        }

        .feature-icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #FFFBE2 0%, #f0ebd0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: var(--primary-green, #063C0F);
            transition: all 0.4s ease;
            box-shadow: inset 0 0 10px rgba(183, 175, 131, 0.2);
        }

        .feature-item:hover .feature-icon-box {
            background: var(--primary-green, #063C0F);
            color: #FFFBE2;
            transform: rotateY(180deg);
            /* Efek putar ikon saat hover */
        }

        /* Supaya ikon tidak ikut terbalik saat box diputar */
        .feature-item:hover .feature-icon-box i {
            transform: rotateY(-180deg);
            transition: transform 0.4s ease;
        }

        .feature-item h3 {
            color: var(--primary-green, #063C0F);
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-item p {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* === CATEGORY SECTION (Original Green Gradient) === */
        .category-section {
            margin-bottom: 4rem;
        }

        .category-card {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            /* Full Green Block */
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

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(6, 60, 15, 0.3);
        }

        .category-card:hover::before {
            top: -60%;
            right: -60%;
        }

        .category-card i {
            font-size: 3rem;
            color: var(--gold-accent);
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
        }

        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .card-img-top {
            height: 240px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .product-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
            background-color: #ffffff;
        }

        .card-title {
            color: #1a1a1a;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0;
        }

        .card-price {
            color: var(--primary-green);
            font-size: 1.1rem;
            font-weight: 700;
            margin-left: 1rem;
            white-space: nowrap;
        }

        .btn-detail {
            background-color: #084d14;
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-detail:hover {
            background-color: #063C0F;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* === LOCATION SECTION (BARU - Dominan Hijau) === */
        .location-section {
            margin-top: 5rem;
            margin-bottom: 5rem;
        }

        .location-container {
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .location-info {
            background: var(--primary-green);
            /* Hijau Penuh */
            color: var(--cream-bg);
            padding: 3rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .info-item {
            margin-bottom: 2rem;
            display: flex;
            gap: 1rem;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 251, 226, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--gold-accent);
            flex-shrink: 0;
        }

        .info-content h5 {
            margin: 0 0 0.5rem 0;
            font-weight: 700;
            color: #fff;
        }

        .info-content p {
            margin: 0;
            color: #ccc;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .map-wrapper {
            height: 100%;
            min-height: 400px;
            width: 100%;
        }

        .map-wrapper iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* === CTA SECTION === */
        .cta-section {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            /* Original Green */
            border-radius: 20px;
            padding: 4rem 2rem;
            text-align: center;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
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
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                padding: 3rem 1.5rem;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .location-info {
                padding: 2rem;
            }

            .map-wrapper {
                min-height: 300px;
            }
        }
    </style>

    {{-- Hero Section --}}
    <div class="hero-section text-center">
        <div class="hero-content">
            <h1>Jelly SnackO<br>Camilan Rumahan Pilihan</h1>
            <p>Rasakan kelezatan camilan homemade yang alami, sehat, dan dibuat dengan penuh cinta untuk keluarga Anda.</p>

            <div class="hero-badges">
                <div class="badge-item">
                    <i class="bi bi-check-circle-fill"></i> <span>100% Alami</span>
                </div>
                <div class="badge-item">
                    <i class="bi bi-heart-fill"></i> <span>Homemade</span>
                </div>
                <div class="badge-item">
                    <i class="bi bi-shield-check"></i> <span>Tanpa Pengawet</span>
                </div>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-hero">
                <i class="bi bi-bag-heart-fill"></i> Belanja Sekarang
            </a>
        </div>
    </div>

    <div class="container">
        {{-- Features Section (Tetap dipertahankan karena informatif) --}}
        <div class="features-section">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-item">
                        <div class="feature-icon-box">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <h3>Pengiriman Aman</h3>
                        <p>Setiap paket dilapisi <i>bubble wrap</i> tebal dan dikemas rapi agar produk sampai dengan utuh
                            dan tetap estetik.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-item">
                        <div class="feature-icon-box">
                            <i class="bi bi-flower1"></i>
                        </div>
                        <h3>Bahan Baku Premium</h3>
                        <p>Tanpa pengawet buatan. Kami menggunakan bahan-bahan alami pilihan yang dibelanjakan <i>fresh</i>
                            setiap hari.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-item">
                        <div class="feature-icon-box">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3>Jaminan Kualitas</h3>
                        <p>Telah dipercaya oleh ratusan pelanggan. Rasa tidak sesuai? Layanan pelanggan kami siap membantu
                            Anda.</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- NEW: About Us Section (Penjelasan Usaha) --}}
        <div class="about-section">
            <div class="about-container">
                <div class="row g-0">
                    <div class="col-lg-5">
                        {{-- Ganti URL gambar ini dengan foto produk/dapur kamu yang asli --}}
                        <img src="images/cendil.jpeg"
                            class="about-img" alt="Tentang Jelly SnackO">
                    </div>
                    <div class="col-lg-7">
                        <div class="about-content">
                            <span class="about-subtitle">Kenalan Yuk!</span>
                            <h2 class="about-title">Tentang Jelly SnackO</h2>
                            <p class="about-desc">
                                Jelly SnackO adalah usaha rumahan (UMKM) yang berdedikasi untuk menghadirkan camilan
                                berkualitas tinggi dengan harga yang terjangkau.
                                Berawal dari dapur sederhana, kami berkomitmen untuk menciptakan produk yang tidak hanya
                                enak di lidah, tetapi juga aman dikonsumsi oleh segala usia.
                                <br><br>
                                Kami percaya bahwa "Rasa Tak Pernah Bohong". Oleh karena itu, kami menjaga keaslian resep
                                tradisional yang dipadukan dengan inovasi rasa modern.
                            </p>

                            <div class="row g-3">
                                <div class="col-4">
                                    <div class="stat-box">
                                        <span class="stat-number">100%</span>
                                        <span class="stat-label">Halal</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-box">
                                        <span class="stat-number">Fresh</span>
                                        <span class="stat-label">Setiap Hari</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-box">
                                        <span class="stat-number">4.9</span>
                                        <span class="stat-label">Rating</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Category Section --}}
        <div class="category-section">
            <div class="section-header">
                <h2>Kategori Produk</h2>
                <p>Mau nyemil apa hari ini?</p>
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
                            <h4>Lihat Semua</h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        {{-- Products Section --}}
        <div class="section-header">
            <h2>Produk Terbaru</h2>
            <p>Jajanan hits yang wajib kamu coba</p>
        </div>

        <div class="row g-4">
            @forelse($latestProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card product-card">
                        <div class="card-img-wrapper" style="overflow: hidden; border-radius: 20px 20px 0 0;">
                            <img src="{{ Storage::url($product->image_path) }}" class="card-img-top"
                                alt="{{ $product->name }}">
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
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
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <p class="text-muted mt-3">Belum ada produk.</p>
                </div>
            @endforelse
        </div>

        {{-- NEW: Location & Contact Section (Pengganti Testimoni) --}}
        <div class="location-section">
            <div class="section-header">
                <h2>Lokasi & Kontak</h2>
                <p>Kunjungi kami atau hubungi untuk pemesanan</p>
            </div>
            <div class="location-container">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="location-info">
                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                <div class="info-content">
                                    <h5>Alamat Produksi</h5>
                                    <p>Perumahan Sejahtera blok C2<br> Kel. gurun laweh<br>Kec. nanggalo, Padang</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-whatsapp"></i></div>
                                <div class="info-content">
                                    <h5>Hubungi Kami</h5>
                                    <p>+62 812-6825-7643</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-icon"><i class="bi bi-clock-fill"></i></div>
                                <div class="info-content">
                                    <h5>Jam Operasional</h5>
                                    <p>Senin - Sabtu<br>08.00 - 17.00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="map-wrapper">
                            {{-- Ganti src iframe di bawah ini dengan Link Embed Google Maps lokasi kamu sendiri --}}
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127669.04949576054!2d100.3524959!3d-0.9345806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b942e2b117bb%3A0x5bd44d4d386634!2sPadang%2C%20Kota%20Padang%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- End Container --}}

    {{-- CTA Section --}}
    <div class="cta-section">
        <h2>Siap Mencoba Camilan Sehat Kami?</h2>
        <p>Pesan sekarang dan rasakan bedanya!</p>
        <a href="{{ route('products.index') }}" class="btn btn-cta">
            <i class="bi bi-cart-plus-fill"></i> Mulai Belanja
        </a>
    </div>
@endsection
