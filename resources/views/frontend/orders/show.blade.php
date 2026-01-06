@extends('layouts.app')

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

        .page-title i {
            color: #B7AF83;
        }

        .order-id {
            font-family: 'Courier New', monospace;
            color: #063C0F;
        }

        .btn-back {
            background-color: #f5f5f5;
            color: #666;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1.75rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #B7AF83;
            color: #ffffff;
            border-color: #B7AF83;
        }

        .page-divider {
            border: none;
            height: 3px;
            background: linear-gradient(90deg, #063C0F, transparent);
            margin: 2rem 0;
        }

        /* === CARD STYLES === */
        .detail-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .detail-card .card-body {
            padding: 2rem;
        }

        .card-title-custom {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-title-custom i {
            color: #B7AF83;
            font-size: 1.4rem;
        }

        /* === ITEMS TABLE === */
        .items-table {
            width: 100%;
            margin-top: 1rem;
        }

        .items-table tbody tr {
            border-bottom: 1px solid #f0f0f0;
        }

        .items-table tbody tr:last-of-type {
            border-bottom: 2px solid #e0e0e0;
        }

        .items-table tbody tr.total-row {
            border-bottom: none !important;
        }

        .items-table td {
            padding: 1rem 0.5rem;
            vertical-align: middle;
        }

        .item-name {
            font-weight: 600;
            color: #1a1a1a;
            font-size: 1rem;
        }

        .item-quantity {
            color: #666;
            font-size: 0.95rem;
        }

        .item-price {
            font-weight: 700;
            color: #063C0F;
            text-align: right;
            font-size: 1rem;
        }

        .total-row td {
            padding: 1.5rem 0.5rem 0 !important;
        }

        .total-label {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.2rem;
            text-align: right;
        }

        .total-price {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.3rem;
            text-align: right;
        }

        /* === INFO SECTION === */
        .info-section {
            margin-bottom: 1.5rem;
        }

        .info-label {
            font-weight: 700;
            color: #063C0F;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-label i {
            color: #7B8D63;
            font-size: 1.1rem;
        }

        .info-value {
            color: #333;
            font-size: 1rem;
            line-height: 1.6;
            background-color: #f9f9f9;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border-left: 4px solid #B7AF83;
        }

        /* === STATUS BADGE === */
        .status-display {
            background-color: #f9f9f9;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .status-label {
            font-weight: 700;
            color: #063C0F;
            font-size: 0.95rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1rem;
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
            font-size: 1.1rem;
        }

        /* === ORDER TIMELINE === */
        .order-timeline {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px dashed #e0e0e0;
        }

        .timeline-title {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .timeline-title i {
            color: #B7AF83;
        }

        .timeline-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.25rem;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .timeline-item:hover {
            background-color: #f0f0f0;
            transform: translateX(5px);
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-date {
            color: #7B8D63;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .timeline-text {
            color: #333;
            font-weight: 600;
            margin-top: 0.25rem;
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

            .btn-back {
                width: 100%;
                justify-content: center;
            }

            .detail-card .card-body {
                padding: 1.5rem;
            }

            .card-title-custom {
                font-size: 1.1rem;
            }

            .items-table td {
                padding: 0.75rem 0.25rem;
                font-size: 0.9rem;
            }
        }
    </style>

    <div class="container">
        {{-- Page Header --}}
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-receipt-cutoff"></i>
                Detail Pesanan <span class="order-id">#{{ $order->id }}</span>
            </h1>
            <a href="{{ route('user.orders.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Riwayat
            </a>
        </div>

        <hr class="page-divider">

        <div class="row">
            {{-- Left Column: Order Items --}}
            <div class="col-lg-8 mb-4">
                <div class="card detail-card">
                    <div class="card-body">
                        <h5 class="card-title-custom">
                            <i class="bi bi-basket"></i>
                            Item yang Dipesan
                        </h5>
                        
                        <table class="items-table">
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="item-name">{{ $item->product->name }}</div>
                                        </td>
                                        <td>
                                            <div class="item-quantity">
                                                {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="item-price">
                                                Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr class="total-row">
                                    <td colspan="2" class="total-label">Total Pembayaran</td>
                                    <td class="total-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- Order Timeline --}}
                        <div class="order-timeline">
                            <div class="timeline-title">
                                <i class="bi bi-clock-history"></i>
                                Riwayat Pesanan
                            </div>
                            
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="bi bi-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                                    <div class="timeline-text">Pesanan dibuat</div>
                                </div>
                            </div>

                            @if($order->payment)
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="bi bi-credit-card"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">{{ $order->payment->created_at->format('d M Y, H:i') }}</div>
                                        <div class="timeline-text">Bukti pembayaran diunggah</div>
                                    </div>
                                </div>
                            @endif

                            @if(in_array(strtolower($order->status), ['selesai', 'completed']))
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="bi bi-check-circle"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <div class="timeline-date">{{ $order->updated_at->format('d M Y, H:i') }}</div>
                                        <div class="timeline-text">Pesanan selesai</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Order Info --}}
            <div class="col-lg-4">
                <div class="card detail-card">
                    <div class="card-body">
                        <h5 class="card-title-custom">
                            <i class="bi bi-info-circle"></i>
                            Informasi Pesanan
                        </h5>

                        {{-- Status --}}
                        <div class="status-display">
                            <div class="status-label">
                                <i class="bi bi-flag"></i>
                                Status Pesanan
                            </div>
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
                        </div>

                        {{-- Shipping Address --}}
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-geo-alt"></i>
                                Alamat Pengiriman
                            </div>
                            <div class="info-value">{{ $order->shipping_address }}</div>
                        </div>

                        {{-- Phone Number --}}
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-telephone"></i>
                                Nomor Telepon
                            </div>
                            <div class="info-value">{{ $order->phone_number }}</div>
                        </div>

                        {{-- Order Date --}}
                        <div class="info-section">
                            <div class="info-label">
                                <i class="bi bi-calendar-event"></i>
                                Tanggal Pemesanan
                            </div>
                            <div class="info-value">{{ $order->created_at->format('d F Y, H:i') }} WIB</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection