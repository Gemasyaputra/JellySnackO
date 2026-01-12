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
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: 'Merriweather', serif;
            }

            /* === NAVBAR STYLES === */
            .navbar {
                background: linear-gradient(135deg, #063C0F 0%, #084d14 100%) !important;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
                padding: 0.75rem 0;
                position: sticky;
                top: 0;
                z-index: 1000;
            }

            .navbar .container {
                display: flex;
                align-items: center;
                gap: 2rem;
            }

            .navbar-collapse {
                flex-grow: 1;
            }

            /* === BRAND === */
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
                width: 45px;
                height: 45px;
                background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 8px rgba(183, 175, 131, 0.3);
            }

            .brand-logo i {
                font-size: 1.5rem;
                color: #063C0F;
            }

            .brand-text {
                font-family: 'Merriweather', serif;
                font-weight: 700;
                font-size: 1.4rem;
                color: #FFFBE2;
            }

            /* === NAV LINKS === */
            .navbar-nav {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .nav-link {
                color: #FFFBE2 !important;
                font-weight: 500;
                transition: all 0.3s ease;
                padding: 0.5rem 0.875rem !important;
                border-radius: 10px;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                position: relative;
                white-space: nowrap;
            }

            .nav-link i {
                font-size: 1rem;
            }

            .nav-link:hover {
                background-color: rgba(255, 251, 226, 0.1);
            }

            .nav-link.active {
                background-color: rgba(183, 175, 131, 0.2);
                color: #B7AF83 !important;
            }

            .nav-link.active::after {
                content: '';
                position: absolute;
                bottom: -0.75rem;
                left: 50%;
                transform: translateX(-50%);
                width: 30px;
                height: 3px;
                background-color: #B7AF83;
                border-radius: 2px;
            }

            /* === SEARCH BAR === */
            .navbar .search-form {
                flex: 1;
                max-width: 600px;
                margin: 0 auto;
            }

            .navbar .search-wrapper {
                position: relative;
                width: 100%;
                display: flex;
                align-items: center;
            }

            .navbar .search-icon {
                position: absolute;
                left: 1rem;
                color: #7B8D63;
                font-size: 1.1rem;
                z-index: 1;
            }

            .navbar .search-input {
                background-color: rgba(255, 251, 226, 0.15);
                border: 2px solid rgba(255, 251, 226, 0.2);
                color: #FFFBE2;
                border-radius: 25px;
                padding: 0.7rem 3.5rem 0.7rem 3rem;
                font-size: 0.95rem;
                transition: all 0.3s ease;
                width: 100%;
            }

            .navbar .search-input::placeholder {
                color: rgba(255, 251, 226, 0.6);
            }

            .navbar .search-input:focus {
                background-color: rgba(255, 251, 226, 0.25);
                border-color: #B7AF83;
                color: #FFFBE2;
                box-shadow: 0 0 0 0.25rem rgba(183, 175, 131, 0.15);
                outline: none;
            }

            .navbar .btn-search {
                position: absolute;
                right: 0.3rem;
                background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
                color: #063C0F;
                border: none;
                border-radius: 20px;
                padding: 0.5rem 0.9rem;
                cursor: pointer;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .navbar .btn-search:hover {
                transform: scale(1.05);
                box-shadow: 0 2px 8px rgba(183, 175, 131, 0.4);
            }

            .navbar .btn-search i {
                font-size: 1.1rem;
            }

            /* === CART LINK === */
            .nav-link-cart {
                position: relative;
                padding: 0.5rem 0.875rem !important;
            }

            .cart-icon-wrapper {
                position: relative;
                display: inline-flex;
                align-items: center;
            }

            .cart-badge {
                position: absolute;
                top: -8px;
                right: -10px;
                background: linear-gradient(135deg, #ef5350 0%, #e53935 100%);
                color: #ffffff;
                font-size: 0.7rem;
                font-weight: 700;
                padding: 0.2rem 0.45rem;
                border-radius: 10px;
                line-height: 1;
                box-shadow: 0 2px 4px rgba(239, 83, 80, 0.4);
                animation: pulse-badge 2s infinite;
            }

            @keyframes pulse-badge {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.1);
                }
            }

            /* === USER ACCOUNT === */
            .nav-link-account {
                background-color: rgba(183, 175, 131, 0.15);
                border-radius: 10px;
                font-weight: 600;
                padding: 0.5rem 0.875rem !important;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
                border-radius: 50%;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                margin-right: 0.5rem;
            }

            .user-avatar i {
                color: #063C0F;
                font-size: 1rem;
            }

            /* === DROPDOWN === */
            .dropdown-menu-modern {
                border: none;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
                border-radius: 12px;
                padding: 0.5rem;
                margin-top: 0.5rem;
                min-width: 220px;
            }

            .dropdown-header {
                padding: 1rem;
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                border-radius: 8px;
                margin-bottom: 0.5rem;
            }

            .user-info {
                display: flex;
                flex-direction: column;
                gap: 0.25rem;
            }

            .user-info strong {
                color: #063C0F;
                font-size: 0.95rem;
            }

            .user-info small {
                color: #666;
                font-size: 0.8rem;
            }

            .dropdown-menu-modern .dropdown-item {
                color: #063C0F;
                transition: all 0.2s ease;
                border-radius: 8px;
                padding: 0.75rem 1rem;
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-weight: 500;
            }

            .dropdown-menu-modern .dropdown-item i {
                font-size: 1.1rem;
                color: #7B8D63;
            }

            .dropdown-menu-modern .dropdown-item:hover {
                background-color: #7B8D63;
                color: #FFFBE2;
            }

            .dropdown-menu-modern .dropdown-item:hover i {
                color: #FFFBE2;
            }

            .dropdown-item-danger {
                color: #ef5350 !important;
            }

            .dropdown-item-danger i {
                color: #ef5350 !important;
            }

            .dropdown-item-danger:hover {
                background-color: #ef5350 !important;
                color: #ffffff !important;
            }

            .dropdown-item-danger:hover i {
                color: #ffffff !important;
            }

            .dropdown-divider {
                margin: 0.5rem 0;
                border-color: #e9ecef;
            }

            /* === NAVBAR TOGGLER === */
            .navbar-toggler {
                border: 2px solid rgba(255, 251, 226, 0.3);
                border-radius: 8px;
            }

            .navbar-toggler:focus {
                box-shadow: 0 0 0 0.25rem rgba(183, 175, 131, 0.25);
            }

            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23FFFBE2' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            }

            /* === MAIN CONTENT === */
            main {
                min-height: calc(100vh - 200px);
            }

            /* === FOOTER STYLES === */
            footer {
                background: linear-gradient(135deg, var(--color-primary) 0%, #084d14 100%);
                color: var(--color-light);
                padding: 2.5rem 0;
                box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.15);
                position: relative;
            }

            footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 3px;
                background: linear-gradient(90deg, var(--color-beige) 0%, var(--color-secondary) 50%, var(--color-beige) 100%);
            }

            footer p {
                margin: 0;
                font-weight: 300;
                letter-spacing: 0.5px;
            }

            footer .footer-icon {
                color: var(--color-beige);
                margin: 0 0.5rem;
                font-size: 1.5rem;
            }

            /* === WHATSAPP FLOATING BUTTON === */
            .whatsapp-float {
                position: fixed;
                width: 60px;
                height: 60px;
                bottom: 40px;
                right: 40px;
                background: linear-gradient(135deg, #25d366 0%, #1da851 100%);
                color: #FFF;
                border-radius: 50px;
                text-align: center;
                font-size: 30px;
                box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4);
                z-index: 100;
                display: flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .whatsapp-float:hover {
                color: #FFF;
                background: linear-gradient(135deg, #128C7E 0%, #075e54 100%);
                transform: scale(1.1);
                box-shadow: 0 6px 16px rgba(18, 140, 126, 0.5);
            }

            .whatsapp-float i {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(1.1);
                }
            }

            /* === RESPONSIVE === */
            @media (max-width: 991px) {
                .search-form {
                    margin: 1rem 0;
                    max-width: 100%;
                }

                .nav-link.active::after {
                    display: none;
                }

                footer .container>div {
                    justify-content: center !important;
                    text-align: center !important;
                }

                footer .container>div>div:last-child {
                    text-align: center !important;
                    width: 100%;
                }
            }

            @media (max-width: 768px) {
                .brand-text {
                    font-size: 1.2rem;
                }

                .brand-logo {
                    width: 38px;
                    height: 38px;
                }

                .brand-logo i {
                    font-size: 1.2rem;
                }
            }

            /* === FOOTER STYLES === */
            .footer-section {
                background-color: #063C0F;
                /* Warna Hijau Tua Utama */
                color: #FFFBE2;
                /* Warna Krem Text */
                padding-top: 4rem;
                padding-bottom: 2rem;
                margin-top: auto;
                /* Agar footer selalu di bawah */
                border-top-left-radius: 50px;
                /* Lengkungan estetis di kiri atas */
                border-top-right-radius: 50px;
                /* Lengkungan estetis di kanan atas */
                position: relative;
            }

            .footer-brand {
                font-family: 'Merriweather', serif;
                font-weight: 700;
                font-size: 1.5rem;
                margin-bottom: 1rem;
                display: inline-block;
            }

            .footer-desc {
                color: #B7AF83;
                /* Warna Emas Pudar */
                font-size: 0.95rem;
                line-height: 1.6;
                margin-bottom: 1.5rem;
                max-width: 300px;
            }

            .footer-heading {
                color: #FFFBE2;
                font-weight: 700;
                font-size: 1.1rem;
                margin-bottom: 1.5rem;
                position: relative;
                display: inline-block;
            }

            /* Garis kecil di bawah judul footer */
            .footer-heading::after {
                content: '';
                position: absolute;
                bottom: -8px;
                left: 0;
                width: 40px;
                height: 3px;
                background-color: #B7AF83;
                border-radius: 2px;
            }

            .footer-links {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .footer-links li {
                margin-bottom: 0.8rem;
            }

            .footer-links a {
                color: #cfc8a8;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 8px;
            }

            .footer-links a:hover {
                color: #FFFBE2;
                transform: translateX(5px);
                /* Efek geser saat hover */
            }

            .social-links {
                display: flex;
                gap: 1rem;
                margin-top: 1rem;
            }

            .social-btn {
                width: 40px;
                height: 40px;
                background-color: rgba(255, 251, 226, 0.1);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #FFFBE2;
                text-decoration: none;
                transition: all 0.3s ease;
                font-size: 1.2rem;
            }

            .social-btn:hover {
                background-color: #B7AF83;
                color: #063C0F;
                transform: translateY(-3px);
            }

            .footer-bottom {
                border-top: 1px solid rgba(255, 251, 226, 0.1);
                margin-top: 3rem;
                padding-top: 1.5rem;
                font-size: 0.9rem;
                color: #9fad90;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                {{-- Brand/Logo Toko --}}
                <a class="navbar-brand" href="{{ route('home') }}">
                    <div class="brand-logo">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <span class="brand-text">Jelly SnackO</span>
                </a>

                {{-- Tombol Toggler untuk Mobile --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- Kontainer Navigasi --}}
                <div class="collapse navbar-collapse" id="navbarNav">
                    {{-- Navigasi Kiri --}}
                    <ul class="navbar-nav mb-2 mb-lg-0" style="flex: 0 0 auto;">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="bi bi-house-door"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                                href="{{ route('products.index') }}">
                                <i class="bi bi-grid"></i>
                                <span>Produk</span>
                            </a>
                        </li>
                    </ul>

                    {{-- Search Bar di Tengah --}}
                    <form class="search-form d-flex" action="{{ route('products.index') }}" method="GET">
                        <div class="search-wrapper">
                            <i class="bi bi-search search-icon"></i>
                            <input class="form-control search-input" type="search" name="search"
                                placeholder="Cari snack favorit..." aria-label="Search" value="{{ request('search') }}">
                            <button class="btn-search" type="submit">
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>

                    {{-- Navigasi Kanan --}}
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="flex: 0 0 auto;">
                        <li class="nav-item">
                            <a class="nav-link nav-link-cart" href="{{ route('cart.index') }}">
                                <div class="cart-icon-wrapper">
                                    <i class="bi bi-cart3"></i>
                                    @if (Cart::getTotalQuantity() > 0)
                                        <span class="cart-badge">{{ Cart::getTotalQuantity() }}</span>
                                    @endif
                                </div>
                                <span>Keranjang</span>
                            </a>
                        </li>
                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav-link-account" href="#" id="navbarDropdownGuest"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i>
                                    <span>Akun</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-end"
                                    aria-labelledby="navbarDropdownGuest">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login') }}">
                                            <i class="bi bi-box-arrow-in-right"></i>
                                            <span>Login</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('register') }}">
                                            <i class="bi bi-person-plus"></i>
                                            <span>Register</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav-link-account" href="#" id="navbarDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-avatar">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <span>{{ Str::limit(Auth::user()->name, 12) }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-modern dropdown-menu-end"
                                    aria-labelledby="navbarDropdown">
                                    <li class="dropdown-header">
                                        <div class="user-info">
                                            <strong>{{ Auth::user()->name }}</strong>
                                            <small>{{ Auth::user()->email }}</small>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.orders.index') }}">
                                            <i class="bi bi-receipt"></i>
                                            <span>Pesanan Saya</span>
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item dropdown-item-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Logout</span>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
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

        <main class="py-5">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="footer-section">
            <div class="container">
                <div class="row gy-5">
                    {{-- Kolom 1: Brand & About --}}
                    <div class="col-lg-4 col-md-6">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="bi bi-box-seam-fill text-warning fs-3"></i>
                            <span class="footer-brand">Jelly SnackO</span>
                        </div>
                        <p class="footer-desc">
                            Menyediakan camilan rumahan yang sehat, alami, dan tanpa pengawet. Pilihan terbaik untuk
                            menemani waktu santai keluarga Anda.
                        </p>
                        <div class="social-links">
                            <a href="https://www.instagram.com/jellysnacko?igsh=MW5rZGs1bmdxN2M4bA=" target="_blank" class="social-btn"><i class="bi bi-instagram"></i></a>
                            <a href="https://wa.me/+6281268257643" target="_blank" class="social-btn"><i class="bi bi-whatsapp"></i></a>
                            <a href="https://www.tiktok.com/@snackojelly?_r=1&_t=ZS-930gqk52iK0" target="_blank" class="social-btn"><i class="bi bi-tiktok"></i></a>
                        </div>
                    </div>

                    {{-- Kolom 2: Quick Links --}}
                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-heading">Navigasi Cepat</h5>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"
                                        style="font-size: 0.7rem;"></i> Beranda</a></li>
                            <li><a href="{{ route('products.index') }}"><i class="bi bi-chevron-right"
                                        style="font-size: 0.7rem;"></i> Semua Produk</a></li>
                            <li><a href="{{ route('cart.index') }}"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i>
                                    Keranjang Belanja</a></li>
                            <li><a href="#"><i class="bi bi-chevron-right" style="font-size: 0.7rem;"></i> Riwayat
                                    Pesanan</a></li>
                        </ul>
                    </div>

                    {{-- Kolom 3: Contact & Info --}}
                    <div class="col-lg-4 col-md-12">
                        <h5 class="footer-heading">Hubungi Kami</h5>
                        <ul class="footer-links">
                            <li>
                                <a href="#" style="pointer-events: none;">
                                    <i class="bi bi-geo-alt-fill text-warning"></i>
                                    Perumahan Sejahtera blok C2 , Kel. gurun laweh, Kec. nanggalo, Padang
                                </a>
                            </li>
                            <li>
                                <a href="https://wa.me/6281268257643" target="_blank">
                                    <i class="bi bi-whatsapp text-warning"></i>
                                    +62 812-6825-7643
                                </a>
                            </li>
                            <li>
                                <a href="mailto:admin@jellysnacko.com">
                                    <i class="bi bi-envelope-fill text-warning"></i>
                                    admin@jellysnacko.com
                                </a>
                            </li>
                        </ul>

                        {{-- Payment Methods Badge (Optional) --}}
                        <div class="mt-4">
                            <p class="mb-2 text-white-50" style="font-size: 0.85rem;">Metode Pembayaran:</p>
                            <div class="d-flex gap-2">                              
                                <i class="bi bi-qr-code-scan fs-4 text-white-50"></i>
                                {{-- <i class="bi bi-wallet2 fs-4 text-white-50"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Copyright Section --}}
                <div class="footer-bottom text-center text-md-start">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            &copy; {{ date('Y') }} <strong>Jelly SnackO</strong>. All Rights Reserved.
                        </div>
                        <div class="col-md-6 text-md-end mt-2 mt-md-0">
                            <span style="font-size: 0.85rem;">Dibuat dengan <i class="bi bi-heart-fill text-danger"></i>
                                di Padang</span>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        {{-- HTML UNTUK FLOATING BUTTON --}}
        <a href="https://wa.me/+6281268257643?text=Halo,%20saya%20ingin%20bertanya%20tentang%20produk%20di%20Jelly%20SnackO."
            class="whatsapp-float" target="_blank" aria-label="Chat WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
