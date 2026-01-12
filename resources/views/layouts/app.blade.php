<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jelly SnackO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <style>
        /* === ROOT VARIABLES === */
        :root {
            --color-primary: #063C0F;
            --color-secondary: #7B8D63;
            --color-light: #FFFBE2;
            --color-beige: #B7AF83;
            --color-white: #ffffff;
        }

        /* === GENERAL STYLES === */
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            background-color: var(--color-light);
            
            /* 1. Ini SOLUSI agar tidak nabrak Navbar */
            /* Sesuaikan angka ini dengan tinggi navbar kamu */
            padding-top: 100px; 
            
            /* 2. Ini settingan agar Footer selalu di bawah (Sticky Footer) */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            /* 3. Agar konten mengisi ruang kosong dan mendorong footer ke bawah */
            flex: 1; 
            
            /* 4. Memberi jarak tambahan agar konten tidak mepet */
            padding-top: 2rem;    /* Jarak dari atas */
            padding-bottom: 4rem; /* Jarak dari bawah (sebelum footer) */
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Merriweather', serif;
        }

        /* === NAVBAR STYLES === */
        .navbar {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%) !important;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
            padding: 0.75rem 0;
            position: fixed; /* Ubah ke fixed agar selalu diatas */
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1030;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: transform 0.3s ease;
            text-decoration: none;
        }

        .navbar-brand:hover {
            transform: scale(1.02);
        }

        .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(183, 175, 131, 0.3);
        }

        .brand-logo i {
            font-size: 1.2rem;
            color: #063C0F;
        }

        .brand-text {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 1.25rem;
            color: #FFFBE2;
        }

        /* === NAV LINKS === */
        .nav-link {
            color: #FFFBE2 !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem !important;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .nav-link:hover {
            background-color: rgba(255, 251, 226, 0.1);
        }

        .nav-link.active {
            background-color: rgba(183, 175, 131, 0.2);
            color: #B7AF83 !important;
        }

        /* === SEARCH BAR === */
        .navbar .search-form {
            flex: 1;
            max-width: 500px;
            margin: 0 1.5rem;
        }

        .navbar .search-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .navbar .search-input {
            background-color: rgba(255, 251, 226, 0.15);
            border: 1px solid rgba(255, 251, 226, 0.2);
            color: #FFFBE2;
            border-radius: 50px;
            padding: 0.6rem 3rem 0.6rem 1.2rem;
            font-size: 0.9rem;
            width: 100%;
        }

        .navbar .search-input::placeholder {
            color: rgba(255, 251, 226, 0.6);
        }

        .navbar .search-input:focus {
            background-color: rgba(255, 251, 226, 0.25);
            border-color: #B7AF83;
            color: #FFFBE2;
            box-shadow: none;
        }

        .navbar .btn-search {
            position: absolute;
            right: 4px;
            top: 4px;
            bottom: 4px;
            background: #B7AF83;
            color: #063C0F;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .navbar .btn-search:hover {
            transform: scale(1.1);
        }

        /* === MOBILE CART ICON (NEW) === */
        .mobile-cart-btn {
            position: relative;
            color: #FFFBE2;
            margin-right: 15px;
            display: none; /* Hidden on desktop */
        }
        
        .mobile-cart-badge {
            position: absolute;
            top: -5px;
            right: -8px;
            background-color: #ef5350;
            color: white;
            font-size: 0.65rem;
            padding: 2px 5px;
            border-radius: 10px;
            font-weight: bold;
        }

        /* === DESKTOP CART & ACCOUNT === */
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef5350;
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 0.1rem 0.4rem;
            border-radius: 10px;
        }

        /* === FOOTER STYLES === */
        .footer-section {
            background-color: #063C0F;
            color: #FFFBE2;
            padding-top: 3rem;
            padding-bottom: 1.5rem;
            margin-top: auto;
            border-top-left-radius: 30px;
            border-top-right-radius: 30px;
        }

        .footer-brand {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .footer-desc {
            color: #B7AF83;
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .footer-heading {
            color: #FFFBE2;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
            display: inline-block;
            position: relative;
        }
        
        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: #B7AF83;
        }

        /* Mobile specific alignment for footer underline */
        @media (max-width: 767px) {
            .footer-heading::after {
                left: 50%;
                transform: translateX(-50%);
            }
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.6rem;
        }

        .footer-links a {
            color: #cfc8a8;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #FFFBE2;
            padding-left: 5px;
        }

        .social-btn {
            width: 35px;
            height: 35px;
            background-color: rgba(255, 251, 226, 0.1);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #FFFBE2;
            text-decoration: none;
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            background-color: #B7AF83;
            color: #063C0F;
            transform: translateY(-3px);
        }

        /* === WHATSAPP FLOATING === */
        .whatsapp-float {
            position: fixed;
            width: 55px;
            height: 55px;
            bottom: 30px;
            right: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 28px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        /* === RESPONSIVE TWEAKS === */
        @media (max-width: 991px) {
            .navbar .container {
                padding-right: 15px; /* Adjust container padding */
            }
            
            /* Tampilkan Cart di luar menu toggle pada mobile */
            .mobile-cart-btn {
                display: block;
            }

            /* Search form full width di mobile dan ada jarak */
            .navbar .search-form {
                margin: 1rem 0;
                max-width: 100%;
                width: 100%;
            }

            .navbar-collapse {
                background-color: rgba(6, 60, 15, 0.95); /* Sedikit backdrop */
                padding: 10px;
                border-radius: 10px;
                margin-top: 10px;
            }

            /* Sembunyikan cart link yang ada di dalam menu (karena sudah ada di luar) */
            .nav-link-cart {
                display: none !important;
            }
            
            /* Footer adjustments */
            .footer-section {
                text-align: center; /* Default center for mobile */
            }
            
            .social-links {
                justify-content: center;
                margin-bottom: 1.5rem;
            }
        }

        @media (min-width: 768px) {
            .footer-section {
                text-align: left; /* Reset ke left untuk tablet/desktop */
            }
            .social-links {
                justify-content: flex-start;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            {{-- Brand/Logo Toko --}}
            <a class="navbar-brand me-auto" href="{{ route('home') }}">
                <div class="brand-logo">
                    <i class="bi bi-box-seam"></i>
                </div>
                <span class="brand-text">Jelly SnackO</span>
            </a>

            {{-- 
                MOBILE CART ICON
                Ini hanya muncul di layar kecil (d-lg-none). 
                Ditaruh SEBELUM tombol toggler agar posisinya [Brand] [Cart] [Toggler]
            --}}
            <a href="{{ route('cart.index') }}" class="mobile-cart-btn d-lg-none text-decoration-none">
                <i class="bi bi-cart3 fs-4"></i>
                @if (Cart::getTotalQuantity() > 0)
                    <span class="mobile-cart-badge">{{ Cart::getTotalQuantity() }}</span>
                @endif
            </a>

            {{-- Tombol Toggler --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: none;">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Kontainer Menu (Collapsible) --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                
                {{-- Search Bar (Akan pindah ke atas di mobile karena urutan HTML) --}}
                <form class="search-form d-flex order-lg-2" action="{{ route('products.index') }}" method="GET">
                    <div class="search-wrapper">
                        <input class="form-control search-input" type="search" name="search"
                            placeholder="Cari camilan..." value="{{ request('search') }}">
                        <button class="btn-search" type="submit">
                            <i class="bi bi-search" style="font-size: 0.9rem;"></i>
                        </button>
                    </div>
                </form>

                {{-- Navigasi Kiri --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 order-lg-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                            <i class="bi bi-grid"></i> Produk
                        </a>
                    </li>
                </ul>

                {{-- Navigasi Kanan (Desktop Cart & Account) --}}
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 order-lg-3">
                    {{-- Desktop Cart (Hidden on Mobile) --}}
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-cart" href="{{ route('cart.index') }}">
                            <div class="position-relative">
                                <i class="bi bi-cart3 fs-5"></i>
                                @if (Cart::getTotalQuantity() > 0)
                                    <span class="cart-badge">{{ Cart::getTotalQuantity() }}</span>
                                @endif
                            </div>
                        </a>
                    </li>

                    {{-- Account Dropdown --}}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-account" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar d-inline-flex align-items-center justify-content-center bg-white text-success rounded-circle me-1" style="width: 24px; height: 24px;">
                                    <i class="bi bi-person-fill" style="font-size: 0.8rem;"></i>
                                </div>
                                {{ Str::limit(Auth::user()->name, 10) }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" aria-labelledby="navbarDropdown">
                                <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('user.orders.index') }}">Pesanan Saya</a></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer-section text-center text-md-start">
        <div class="container">
            <div class="row gy-4">
                {{-- Kolom 1: Brand --}}
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-2 mb-3">
                        <i class="bi bi-box-seam-fill text-warning fs-3"></i>
                        <span class="footer-brand">Jelly SnackO</span>
                    </div>
                    <p class="footer-desc mx-auto mx-md-0" style="max-width: 350px;">
                        Camilan rumahan sehat, alami, tanpa pengawet. Teman terbaik waktu santai Anda.
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="social-btn"><i class="bi bi-instagram"></i></a>
                        <a href="https://wa.me/+6281268257643" class="social-btn"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="social-btn"><i class="bi bi-tiktok"></i></a>
                    </div>
                </div>

                {{-- Kolom 2: Navigasi --}}
                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-heading">Menu Cepat</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}">Produk Kami</a></li>
                        <li><a href="{{ route('cart.index') }}">Keranjang</a></li>
                        <li><a href="#">Lacak Pesanan</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Kontak --}}
                <div class="col-lg-4 col-md-12">
                    <h5 class="footer-heading">Kontak</h5>
                    <ul class="footer-links">
                        <li class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                            <span class="ms-2">Perumahan Sejahtera blok C2, Kel. gurun laweh, Kec. nanggalo, Padang</span>
                        </li>
                        <li>
                            <a href="https://wa.me/6281268257643">
                                <i class="bi bi-whatsapp text-warning me-2"></i> +62 812-6825-7643
                            </a>
                        </li>
                        <li>
                            <a href="mailto:admin@jellysnacko.com">
                                <i class="bi bi-envelope-fill text-warning me-2"></i> admin@jellysnacko.com
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr style="border-color: rgba(255,251,226,0.2); margin: 2rem 0;">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <small>&copy; {{ date('Y') }} <strong>Jelly SnackO</strong>. All Rights Reserved.</small>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <small>Dibuat di Padang <i class="bi bi-heart-fill text-danger"></i></small>
                </div>
            </div>
        </div>
    </footer>

    {{-- WA Float --}}
    <a href="https://wa.me/+6281268257643" class="whatsapp-float" target="_blank">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>