@extends('layouts.admin')

@section('title', 'Manajemen Pesanan')

@section('content')
    <style>
        /* === PAGE HEADER === */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* === TABLE CARD === */
        .table-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .table-card .card-body {
            padding: 0;
        }

        /* === TABLE STYLES === */
        .orders-table {
            margin: 0;
            width: 100%;
        }

        .orders-table thead {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%) !important;
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
        }

        /* === ORDER INFO === */
        .order-id {
            font-weight: 700;
            color: #063C0F;
            font-size: 1rem;
            font-family: 'Courier New', monospace;
        }

        .customer-name {
            font-weight: 600;
            color: #1a1a1a;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .customer-name i {
            color: #7B8D63;
        }

        .order-price {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.05rem;
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .order-date i {
            color: #B7AF83;
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

        .status-pending {
            background-color: #fff3e0;
            color: #e65100;
            border: 2px solid #ffb74d;
        }

        .status-processing {
            background-color: #e3f2fd;
            color: #1565c0;
            border: 2px solid #64b5f6;
        }

        .status-shipped {
            background-color: #f3e5f5;
            color: #6a1b9a;
            border: 2px solid #ba68c8;
        }

        .status-completed {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 2px solid #66bb6a;
        }

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
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 5rem;
            color: #B7AF83;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .empty-state h4 {
            color: #063C0F;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            color: #7B8D63;
            font-size: 1rem;
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

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .orders-table {
                font-size: 0.85rem;
            }

            .orders-table thead th,
            .orders-table tbody td {
                padding: 0.75rem 1rem;
            }

            .customer-name,
            .order-date {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .btn-detail {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-cart-check"></i> Manajemen Pesanan
        </h1>
    </div>

    {{-- Orders Table --}}
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table orders-table">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Nama Pelanggan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>
                                    <div class="order-id">#{{ $order->id }}</div>
                                </td>
                                <td>
                                    <div class="customer-name">
                                        <i class="bi bi-person-circle"></i>
                                        {{ $order->user->name }}
                                    </div>
                                </td>
                                <td>
                                    <div class="order-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        $statusIcon = '';
                                        switch($order->status) {
                                            case 'pending':
                                                $statusClass = 'status-pending';
                                                $statusIcon = 'bi-clock-history';
                                                break;
                                            case 'processing':
                                                $statusClass = 'status-processing';
                                                $statusIcon = 'bi-arrow-repeat';
                                                break;
                                            case 'shipped':
                                                $statusClass = 'status-shipped';
                                                $statusIcon = 'bi-truck';
                                                break;
                                            case 'completed':
                                                $statusClass = 'status-completed';
                                                $statusIcon = 'bi-check-circle';
                                                break;
                                            case 'cancelled':
                                                $statusClass = 'status-cancelled';
                                                $statusIcon = 'bi-x-circle';
                                                break;
                                            default:
                                                $statusClass = 'status-pending';
                                                $statusIcon = 'bi-clock-history';
                                        }
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="bi {{ $statusIcon }}"></i>
                                        {{ ucwords($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="order-date">
                                        <i class="bi bi-calendar-event"></i>
                                        {{ $order->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-detail">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h4>Belum Ada Pesanan</h4>
                                        <p>Pesanan dari pelanggan akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($orders->hasPages())
                <div class="pagination-wrapper">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection