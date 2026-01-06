@extends('layouts.app')

@section('content')
    <style>
        /* === PAGE HEADER === */
        .page-header {
            margin-bottom: 2.5rem;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-title i {
            color: #B7AF83;
        }

        .page-subtitle {
            color: #7B8D63;
            font-size: 1rem;
        }

        .page-divider {
            border: none;
            height: 3px;
            background: linear-gradient(90deg, #063C0F, transparent);
            margin: 2rem 0;
        }

        /* === TABLE CARD === */
        .orders-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .orders-card .card-body {
            padding: 0;
        }

        /* === TABLE STYLES === */
        .orders-table {
            margin: 0;
            width: 100%;
        }

        .orders-table thead {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
        }

        .orders-table thead th {
            color: #ffffff !important;
            background-color: transparent !important;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1.25rem 1.5rem !important;
            border: none !important;
            white-space: nowrap;
        }

        .orders-table tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .orders-table tbody tr:last-child td {
            border-bottom: none;
        }

        .orders-table tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.001);
            transition: all 0.2s ease;
        }

        /* === ORDER INFO === */
        .order-id {
            font-weight: 700;
            color: #063C0F;
            font-size: 1rem;
            font-family: 'Courier New', monospace;
        }

        .order-date {
            color: #666;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .order-date i {
            color: #B7AF83;
        }

        .order-price {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.05rem;
        }

        /* === STATUS BADGES === */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            white-space: nowrap;
        }

        .status-pending,
        .status-menunggu {
            background-color: #fff3e0;
            color: #e65100;
            border: 2px solid #ffb74d;
        }

        .status-diproses,
        .status-processing {
            background-color: #e3f2fd;
            color: #1565c0;
            border: 2px solid #64b5f6;
        }

        .status-dikirim,
        .status-shipped {
            background-color: #f3e5f5;
            color: #6a1b9a;
            border: 2px solid #ba68c8;
        }

        .status-selesai,
        .status-completed {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 2px solid #66bb6a;
        }

        .status-dibatalkan,
        .status-cancelled {
            background-color: #ffebee;
            color: #c62828;
            border: 2px solid #ef5350;
        }

        .status-badge i {
            font-size: 1rem;
        }

        /* === ACTION BUTTON === */
        .btn-detail {
            background-color: #063C0F;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            text-decoration: none;
        }

        .btn-detail:hover {
            background-color: #084d14;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(6, 60, 15, 0.3);
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
        }

        .empty-state i {
            font-size: 6rem;
            color: #B7AF83;
            margin-bottom: 2rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #7B8D63;
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .btn-shop {
            background-color: #063C0F;
            color: #ffffff;
            border: none;
            padding: 0.875rem 2.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
        }

        .btn-shop:hover {
            background-color: #084d14;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        /* === PAGINATION === */
        .pagination-wrapper {
            padding: 1.5rem;
            display: flex;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .pagination {
            gap: 0.5rem;
        }

        .pagination .page-link {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            color: #063C0F;
            padding: 0.6rem 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .pagination .page-link:hover {
            background-color: #B7AF83;
            border-color: #B7AF83;
            color: #ffffff;
        }

        .pagination .page-item.active .page-link {
            background-color: #063C0F;
            border-color: #063C0F;
            color: #ffffff;
        }

        /* === INFO STATS === */
        .order-stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .stat-card {
            flex: 1;
            min-width: 200px;
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-color: #B7AF83;
        }

        .stat-icon {
            font-size: 2rem;
            color: #B7AF83;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-family: 'Merriweather', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #063C0F;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #7B8D63;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }

            .orders-table {
                font-size: 0.85rem;
            }

            .orders-table thead th,
            .orders-table tbody td {
                padding: 1rem;
            }

            .order-date {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .btn-detail {
                width: 100%;
                justify-content: center;
            }

            .order-stats {
                flex-direction: column;
            }

            .stat-card {
                min-width: 100%;
            }
        }
    </style>

    <div class="container">
        {{-- Page Header --}}
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-clock-history"></i>
                Riwayat Pesanan Saya
            </h1>
            <p class="page-subtitle">Lihat dan lacak semua pesanan yang pernah Anda buat</p>
        </div>

        <hr class="page-divider">

        {{-- Order Statistics --}}
        @if(count($orders) > 0)
            <div class="order-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div class="stat-value">{{ $orders->total() }}</div>
                    <div class="stat-label">Total Pesanan</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <div class="stat-value">{{ $orders->where('status', 'menunggu pembayaran')->count() + $orders->where('status', 'pending')->count() }}</div>
                    <div class="stat-label">Menunggu</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-value">{{ $orders->where('status', 'selesai')->count() + $orders->where('status', 'completed')->count() }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
            </div>
        @endif

        {{-- Orders Table --}}
        <div class="card orders-card">
            <div class="card-body">
                @if(count($orders) > 0)
                    <div class="table-responsive">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>ID Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="order-id">#{{ $order->id }}</div>
                                        </td>
                                        <td>
                                            <div class="order-date">
                                                <i class="bi bi-calendar-event"></i>
                                                {{ $order->created_at->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = '';
                                                $statusIcon = '';
                                                $statusNormalized = strtolower(str_replace(' ', '', $order->status));
                                                
                                                switch($statusNormalized) {
                                                    case 'menunggupembayaran':
                                                    case 'pending':
                                                        $statusClass = 'status-menunggu';
                                                        $statusIcon = 'bi-clock-history';
                                                        break;
                                                    case 'diproses':
                                                    case 'processing':
                                                        $statusClass = 'status-diproses';
                                                        $statusIcon = 'bi-arrow-repeat';
                                                        break;
                                                    case 'dikirim':
                                                    case 'shipped':
                                                        $statusClass = 'status-dikirim';
                                                        $statusIcon = 'bi-truck';
                                                        break;
                                                    case 'selesai':
                                                    case 'completed':
                                                        $statusClass = 'status-selesai';
                                                        $statusIcon = 'bi-check-circle';
                                                        break;
                                                    case 'dibatalkan':
                                                    case 'cancelled':
                                                        $statusClass = 'status-dibatalkan';
                                                        $statusIcon = 'bi-x-circle';
                                                        break;
                                                    default:
                                                        $statusClass = 'status-menunggu';
                                                        $statusIcon = 'bi-clock-history';
                                                }
                                            @endphp
                                            <span class="status-badge {{ $statusClass }}">
                                                <i class="bi {{ $statusIcon }}"></i>
                                                {{ ucwords($order->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="order-price">
                                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.orders.show', $order->id) }}" class="btn-detail">
                                                <i class="bi bi-eye"></i>
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($orders->hasPages())
                        <div class="pagination-wrapper">
                            {{ $orders->links() }}
                        </div>
                    @endif
                @else
                    {{-- Empty State --}}
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h3>Belum Ada Riwayat Pesanan</h3>
                        <p>Anda belum pernah melakukan pemesanan</p>
                        <a href="{{ route('home') }}" class="btn-shop">
                            <i class="bi bi-shop"></i>
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection