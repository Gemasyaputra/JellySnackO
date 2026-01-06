<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Jelly SnackO - @yield('title')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            overflow-x: hidden;
        }

        h1,h2,h3,h4,h5,h6 {
            font-family: 'Merriweather', serif;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #063C0F 0%, #084d14 100%);
            padding: 2rem 1.5rem;
            box-shadow: 4px 0 15px rgba(0,0,0,.1);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1rem;
            border-radius: 12px;
            text-decoration: none;
            color: #FFFBE2;
            background: rgba(255,251,226,.1);
            margin-bottom: 2rem;
        }

        .sidebar-logo i {
            font-size: 2rem;
            color: #B7AF83;
        }

        .sidebar-logo span {
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* ================= ADMIN INFO ================= */
        .admin-info {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1rem;
            border-radius: 10px;
            background: rgba(255,251,226,.1);
            margin-bottom: 1.5rem;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg,#B7AF83,#9a9370);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .admin-name {
            margin: 0;
            font-size: .9rem;
            color: #fff;
            font-weight: 600;
        }

        .admin-role {
            margin: 0;
            font-size: .75rem;
            color: #B7AF83;
        }

        /* ================= NAV ================= */
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 2rem 0;
        }

        .sidebar-nav li {
            margin-bottom: .5rem;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1.25rem;
            color: #FFFBE2;
            text-decoration: none;
            border-radius: 12px;
            font-size: .95rem;
        }

        .nav-link-custom.active,
        .nav-link-custom:hover {
            background: rgba(183,175,131,.3);
            color: #fff;
        }

        .nav-link-custom i {
            font-size: 1.2rem;
        }

        .sidebar-divider {
            border: none;
            height: 1px;
            background: rgba(255,251,226,.2);
            margin: 1.5rem 0;
        }

        /* ================= LOGOUT ================= */
        .sidebar-footer {
            margin-top: auto;
        }

        .logout-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1.25rem;
            background: rgba(239,83,80,.25);
            border-radius: 12px;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
        }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            margin-left: 280px;
            padding: 1.25rem 2rem; /* 🔥 lebih padat */
            background-color: #f5f5f5;
        }

        /* ================= RESPONSIVE ================= */
        @media(max-width:992px){
            .sidebar {
                width: 80px;
                padding: 1.5rem .75rem;
            }

            .sidebar-logo span,
            .admin-info,
            .nav-link-custom span,
            .logout-link span {
                display: none;
            }

            .main-content {
                margin-left: 80px;
                padding: 1rem;
            }
        }

        @media(max-width:768px){
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

{{-- Sidebar --}}
<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <i class="bi bi-shop"></i>
        <span>Jelly SnackO</span>
    </a>

    <div class="admin-info">
        <div class="admin-avatar">
            {{ strtoupper(substr(Auth::user()->name ?? 'A',0,1)) }}
        </div>
        <div>
            <p class="admin-name">{{ Auth::user()->name ?? 'Admin' }}</p>
            <p class="admin-role">Administrator</p>
        </div>
    </div>

    <hr class="sidebar-divider">

    <ul class="sidebar-nav">
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i><span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.products.index') }}"
               class="nav-link-custom {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i><span>Produk</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link-custom {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-grid-3x3-gap"></i><span>Kategori</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}"
               class="nav-link-custom {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-cart-check"></i><span>Pesanan</span>
            </a>
        </li>
    </ul>

    <hr class="sidebar-divider">

    <div class="sidebar-footer">
        <a href="#" class="logout-link"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i><span>Sign Out</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
