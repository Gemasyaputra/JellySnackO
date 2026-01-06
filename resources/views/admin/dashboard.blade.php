@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <style>
        :root {
            --primary: #063C0F;     /* Hijau Tua */
            --secondary: #7B8D63;   /* Hijau Muda/Sage */
            --accent: #B7AF83;      /* Beige/Emas */
            --bg-light: #FFFBE2;    /* Krem Lembut */
            --white: #ffffff;
            --text-dark: #2c3e50;
            --text-muted: #6c757d;
        }

        /* === DASHBOARD HEADER === */
        .dashboard-header {
            margin-bottom: 2.5rem;
            border-bottom: 2px dashed #e0e0e0;
            padding-bottom: 1.5rem;
        }

        .dashboard-title {
            font-family: 'Merriweather', serif;
            color: var(--primary);
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dashboard-subtitle {
            color: var(--secondary);
            font-size: 1.05rem;
            font-weight: 500;
        }

        /* === STATS CARDS === */
        .stats-card {
            background: var(--white);
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 20px;
            padding: 1.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(6, 60, 15, 0.05);
            height: 100%;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .stats-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(6, 60, 15, 0.15);
        }

        .stats-card:hover::after {
            opacity: 1;
        }

        .stats-icon-wrapper {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            flex-shrink: 0;
        }

        /* Varian Warna Icon */
        .icon-revenue { background-color: #e8f5e9; color: var(--primary); }
        .icon-orders { background-color: #fff3e0; color: #f57c00; }
        .icon-customers { background-color: #e3f2fd; color: #1565c0; }
        .icon-alert { background-color: #ffebee; color: #c62828; }

        .stats-content {
            flex-grow: 1;
        }

        .stats-label {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .stats-value {
            color: var(--text-dark);
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1.2;
        }

        /* === TABLE CARDS === */
        .table-card {
            background-color: var(--white);
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            height: 100%;
        }

        .table-card .card-header {
            background: var(--white);
            border-bottom: 2px solid #f0f0f0;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--primary);
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
        }

        .card-header-title i {
            font-size: 1.4rem;
            color: var(--secondary);
        }

        /* === CUSTOM TABLE === */
        .custom-table {
            margin: 0;
            width: 100%;
        }

        .custom-table thead th {
            background-color: #fafafa;
            color: var(--primary);
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .custom-table tbody td {
            padding: 1.2rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f9f9f9;
            color: #555;
            font-size: 0.95rem;
        }

        .custom-table tbody tr:hover {
            background-color: #fcfcfc;
        }

        /* === BADGES === */
        .badge-custom {
            padding: 0.5em 1em;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        .badge-pending { background-color: #fff8e1; color: #ff8f00; border: 1px solid #ffe082; }
        .badge-processing { background-color: #e3f2fd; color: #1976d2; border: 1px solid #bbdefb; }
        .badge-shipped { background-color: #f3e5f5; color: #7b1fa2; border: 1px solid #e1bee7; }
        .badge-delivered { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .badge-cancelled { background-color: #ffebee; color: #c62828; border: 1px solid #ef9a9a; }
        
        .badge-stock-alert {
            background-color: #ffebee;
            color: #c62828;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-block;
            min-width: 40px;
            text-align: center;
        }

        /* === GREEN BUTTONS === */
        .btn-green-primary {
            background: linear-gradient(135deg, var(--primary) 0%, #095015 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(6, 60, 15, 0.2);
        }

        .btn-green-primary:hover {
            background: linear-gradient(135deg, #095015 0%, #063C0F 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(6, 60, 15, 0.3);
            color: white;
        }

        .btn-green-soft {
            background-color: #e8f5e9;
            color: var(--primary);
            border: 1px solid transparent;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-green-soft:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(6, 60, 15, 0.15);
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
        }
        .empty-state i {
            font-size: 3rem;
            color: #e0e0e0;
            margin-bottom: 1rem;
            display: block;
        }
        .empty-state p {
            color: var(--text-muted);
            margin: 0;
        }

        @media (max-width: 768px) {
            .stats-card { padding: 1.25rem; gap: 1rem; }
            .stats-icon-wrapper { width: 50px; height: 50px; font-size: 1.4rem; }
            .stats-value { font-size: 1.4rem; }
        }
    </style>

    {{-- Dashboard Header --}}
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="bi bi-grid-fill" style="color: var(--secondary)"></i> Dashboard Admin
        </h1>
        <p class="dashboard-subtitle">Halo Admin! Berikut adalah ringkasan performa toko <span style="color: var(--primary); font-weight:700">Jelly SnackO</span> hari ini.</p>
    </div>

    {{-- Cards Stats --}}
    <div class="row g-4 mb-5">
        {{-- Total Pendapatan --}}
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper icon-revenue">
                    <i class="bi bi-wallet2"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-label">Pendapatan</div>
                    <div class="stats-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>

        {{-- Pesanan Baru --}}
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper icon-orders">
                    <i class="bi bi-bag-check-fill"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-label">Pesanan Baru</div>
                    <div class="stats-value">{{ $newOrdersCount }}</div>
                </div>
            </div>
        </div>

        {{-- Total Pelanggan --}}
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper icon-customers">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-label">Pelanggan</div>
                    <div class="stats-value">{{ $customersCount }}</div>
                </div>
            </div>
        </div>

        {{-- Stok Kritis --}}
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-wrapper icon-alert">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-label">Stok Menipis</div>
                    <div class="stats-value">{{ $lowStockCount }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tables Section --}}
    <div class="row g-4">
        {{-- Pesanan Terbaru --}}
        <div class="col-lg-8">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="card-header-title">
                        <i class="bi bi-receipt-cutoff"></i>
                        Transaksi Terbaru
                    </h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn-green-soft" style="font-size: 0.8rem;">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestOrders as $order)
                                    <tr>
                                        <td><span style="font-family: monospace; font-weight: 700;">#{{ $order->id }}</span></td>
                                        <td>
                                            <div style="font-weight: 600; color: var(--text-dark)">{{ $order->user->name }}</div>
                                            <div style="font-size: 0.75rem; color: #999;">{{ $order->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td style="font-weight: 700; color: var(--primary);">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <span class="badge-custom badge-{{ $order->status }}">
                                                {{ ucwords($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-green-primary">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-state">
                                            <i class="bi bi-cart-x"></i>
                                            <p>Belum ada pesanan masuk.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Stok Kritis --}}
        <div class="col-lg-4">
            <div class="table-card">
                <div class="card-header">
                    <h5 class="card-header-title">
                        <i class="bi bi-exclamation-octagon"></i>
                        Stok Warning
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Sisa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStockProducts as $product)
                                    <tr>
                                        <td style="font-weight: 600;">{{ $product->name }}</td>
                                        <td class="text-center">
                                            <span class="badge-stock-alert">{{ $product->stock }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-green-soft">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="empty-state">
                                            <i class="bi bi-check-circle-fill" style="color: var(--secondary)"></i>
                                            <p>Semua stok produk aman!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection