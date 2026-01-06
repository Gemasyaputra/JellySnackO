<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jelly SnackO - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Merriweather', serif;
        }

        /* === SIDEBAR === */
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: linear-gradient(180deg, #063C0F 0%, #084d14 100%);
            padding: 2rem 1.5rem;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* === LOGO SECTION === */
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #FFFBE2;
            text-decoration: none;
            margin-bottom: 2rem;
            padding: 1rem;
            background: rgba(255, 251, 226, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .sidebar-logo:hover {
            background: rgba(255, 251, 226, 0.2);
            transform: translateX(5px);
        }

        .sidebar-logo i {
            font-size: 2rem;
            color: #B7AF83;
        }

        .sidebar-logo span {
            font-family: 'Merriweather', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #FFFBE2;
        }

        /* === NAVIGATION === */
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            color: #FFFBE2;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link-custom::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #B7AF83;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link-custom:hover {
            background: rgba(255, 251, 226, 0.15);
            color: #FFFBE2;
            transform: translateX(5px);
        }

        .nav-link-custom:hover::before {
            transform: scaleY(1);
        }

        .nav-link-custom.active {
            background: rgba(183, 175, 131, 0.3);
            color: #FFFBE2;
            font-weight: 600;
        }

        .nav-link-custom.active::before {
            transform: scaleY(1);
        }

        .nav-link-custom i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        /* === DIVIDER === */
        .sidebar-divider {
            border: none;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 251, 226, 0.3), transparent);
            margin: 2rem 0;
        }

        /* === LOGOUT SECTION === */
        .sidebar-footer {
            position: absolute;
            bottom: 2rem;
            left: 1.5rem;
            right: 1.5rem;
        }

        .logout-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            background: rgba(239, 83, 80, 0.2);
            color: #FFFBE2;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .logout-link:hover {
            background: rgba(239, 83, 80, 0.3);
            color: #FFFBE2;
            transform: translateX(5px);
        }

        .logout-link i {
            font-size: 1.2rem;
        }

        /* === MAIN CONTENT === */
        .main-content {
            margin-left: 280px;
            padding: 2.5rem;
            min-height: 100vh;
            background-color: #f5f5f5;
        }

        /* Hide default title from old layout */
        .main-content > h1.mb-4 {
            display: none;
        }

        /* === ADMIN INFO BADGE === */
        .admin-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            background: rgba(255, 251, 226, 0.1);
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #B7AF83, #9a9370);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFBE2;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .admin-details {
            flex: 1;
        }

        .admin-name {
            font-weight: 600;
            color: #FFFBE2;
            font-size: 0.9rem;
            margin: 0;
        }

        .admin-role {
            font-size: 0.75rem;
            color: #B7AF83;
            margin: 0;
        }

        /* === RESPONSIVE === */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 1.5rem 0.75rem;
            }

            .sidebar-logo span,
            .nav-link-custom span,
            .logout-link span,
            .admin-info {
                display: none;
            }

            .sidebar-logo {
                justify-content: center;
                padding: 0.75rem;
            }

            .nav-link-custom,
            .logout-link {
                justify-content: center;
                padding: 0.875rem;
            }

            .nav-link-custom i,
            .logout-link i {
                margin: 0;
            }

            .main-content {
                margin-left: 80px;
                padding: 1.5rem;
            }

            .sidebar-footer {
                left: 0.75rem;
                right: 0.75rem;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                min-height: auto;
                position: relative;
                padding: 1rem;
            }

            .sidebar-footer {
                position: relative;
                bottom: auto;
                left: auto;
                right: auto;
                margin-top: 2rem;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .sidebar-logo span,
            .nav-link-custom span,
            .logout-link span {
                display: inline;
            }

            .nav-link-custom,
            .logout-link {
                justify-content: flex-start;
            }
        }

        /* === SCROLLBAR STYLING === */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 251, 226, 0.1);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(183, 175, 131, 0.5);
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(183, 175, 131, 0.7);
        }
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar">
            {{-- Logo --}}
            <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
                <i class="bi bi-shop"></i>
                <span>Jelly SnackO</span>
            </a>

            {{-- Admin Info --}}
            <div class="admin-info">
                <div class="admin-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="admin-details">
                    <p class="admin-name">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="admin-role">Administrator</p>
                </div>
            </div>

            <hr class="sidebar-divider">

            {{-- Navigation --}}
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}"
                        class="nav-link-custom {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i>
                        <span>Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-link-custom {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}"
                        class="nav-link-custom {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="bi bi-cart-check"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
            </ul>

            <hr class="sidebar-divider">

            {{-- Logout --}}
            <div class="sidebar-footer">
                <a href="#" class="logout-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="main-content">
            <h1 class="mb-4">@yield('title')</h1>
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>