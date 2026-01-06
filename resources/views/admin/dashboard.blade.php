@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <style>
        /* === DASHBOARD HEADER === */
        .dashboard-header {
            margin-bottom: 2rem;
        }

        .dashboard-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .dashboard-subtitle {
            color: #7B8D63;
            font-size: 1rem;
        }

        /* === STATS CARDS === */
        .stats-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: none;
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--card-color) 0%, var(--card-color-light) 100%);
        }

        .stats-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
        }

        .stats-card.success {
            --card-color: #2e7d32;
            --card-color-light: #66bb6a;
        }

        .stats-card.primary {
            --card-color: #1976d2;
            --card-color-light: #42a5f5;
        }

        .stats-card.info {
            --card-color: #0288d1;
            --card-color-light: #29b6f6;
        }

        .stats-card.danger {
            --card-color: #d32f2f;
            --card-color-light: #ef5350;
        }

        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .stats-card.success .stats-icon {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #2e7d32;
        }

        .stats-card.primary .stats-icon {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #1976d2;
        }

        .stats-card.info .stats-icon {
            background: linear-gradient(135deg, #e1f5fe 0%, #b3e5fc 100%);
            color: #0288d1;
        }

        .stats-card.danger .stats-icon {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #d32f2f;
        }

        .stats-label {
            color: #666;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .stats-value {
            color: #1a1a1a;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
        }

        /* === TABLE CARDS === */
        .table-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .table-card .card-header {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            color: #FFFBE2;
            padding: 1.25rem 1.5rem;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .table-card .card-header i {
            font-size: 1.5rem;
            color: #B7AF83;
        }

        .table-card .card-header h5 {
            font-family: 'Merriweather', serif;
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .table-card .card-body {
            padding: 0;
        }

        /* === TABLE STYLES === */
        .custom-table {
            margin: 0;
        }

        .custom-table thead {
            background-color: #f8f9fa;
        }

        .custom-table thead th {
            color: #063C0F;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.5rem;
            border: none;
        }

        .custom-table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }

        .custom-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* === BADGES === */
        .badge-custom {
            padding: 0.4rem 0.9rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: capitalize;
        }

        .badge-pending {
            background-color: #fff3e0;
            color: #e65100;
        }

        .badge-processing {
            background-color: #e3f2fd;
            color: #1976d2;
        }

        .badge-shipped {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }

        .badge-delivered {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .badge-cancelled {
            background-color: #ffebee;
            color: #c62828;
        }

        .badge-stock {
            background-color: #ffebee;
            color: #c62828;
            padding: 0.3rem 0.7rem;
            border-radius: 15px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        /* === BUTTONS === */
        .btn-detail {
            background-color: #17a2b8;
            color: #ffffff;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-detail:hover {
            background-color: #138496;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
        }

        .btn-edit {
            background-color: #ffa726;
            color: #ffffff;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-edit:hover {
            background-color: #fb8c00;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 167, 38, 0.3);
        }

        /* === EMPTY STATE === */
        .empty-row {
            text-align: center;
            padding: 2rem;
            color: #7B8D63;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .stats-value {
                font-size: 1.5rem;
            }

            .table-card {
                margin-bottom: 1rem;
            }

            .custom-table {
                font-size: 0.85rem;
            }

            .custom-table thead th,
            .custom-table tbody td {
                padding: 0.75rem 1rem;
            }
        }
    </style>

    {{-- Dashboard Header --}}
    <div class="dashboard-header">
        <h1 class="dashboard-title">
            <i class="bi bi-speedometer2"></i> Dashboard Admin
        </h1>
        <p class="dashboard-subtitle">Selamat datang kembali! Berikut ringkasan toko Anda hari ini.</p>
    </div>

    {{-- Baris untuk Kartu Statistik --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card success">
                <div class="stats-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div class="stats-label">Total Pendapatan</div>
                <div class="stats-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card primary">
                <div class="stats-icon">
                    <i class="bi bi-cart-check"></i>
                </div>
                <div class="stats-label">Pesanan Baru</div>
                <div class="stats-value">{{ $newOrdersCount }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card info">
                <div class="stats-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stats-label">Total Pelanggan</div>
                <div class="stats-value">{{ $customersCount }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="stats-card danger">
                <div class="stats-icon">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div class="stats-label">Stok Kritis</div>
                <div class="stats-value">{{ $lowStockCount }}</div>
            </div>
        </div>
    </div>

    {{-- Tabel Pesanan Terbaru & Stok Menipis --}}
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card table-card">
                <div class="card-header">
                    <i class="bi bi-receipt"></i>
                    <h5>Pesanan Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestOrders as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td>{{ $order->user->name }}</td>
                                        <td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
                                        <td>
                                            <span class="badge-custom badge-{{ $order->status }}">
                                                {{ ucwords($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-row">
                                            <i class="bi bi-inbox" style="font-size: 2rem; opacity: 0.5;"></i>
                                            <p class="mb-0 mt-2">Belum ada pesanan.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card table-card">
                <div class="card-header">
                    <i class="bi bi-exclamation-circle"></i>
                    <h5>Produk Stok Kritis</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStockProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <span class="badge-stock">{{ $product->stock }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-edit">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="empty-row">
                                            <i class="bi bi-check-circle" style="font-size: 2rem; opacity: 0.5; color: #2e7d32;"></i>
                                            <p class="mb-0 mt-2">Semua produk aman!</p>
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