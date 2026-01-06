@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->id)

@section('content')
    <style>
        /* === PAGE HEADER === */
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .breadcrumb-custom {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #7B8D63;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .breadcrumb-custom a {
            color: #7B8D63;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .breadcrumb-custom a:hover {
            color: #063C0F;
        }

        /* === CARD STYLES === */
        .detail-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 1.5rem;
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

        .items-table tbody tr:last-child {
            border-bottom: 2px solid #e0e0e0;
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
            border-bottom: none !important;
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

        /* === SHIPPING INFO === */
        .info-row {
            display: flex;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background-color: #f9f9f9;
            border-radius: 10px;
        }

        .info-label {
            font-weight: 700;
            color: #063C0F;
            min-width: 120px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-label i {
            color: #7B8D63;
        }

        .info-value {
            color: #333;
            flex: 1;
        }

        /* === STATUS SECTION === */
        .current-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 1.5rem;
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

        /* === FORM STYLES === */
        .form-label {
            color: #063C0F;
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: #7B8D63;
        }

        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: #fafafa;
        }

        .form-select:focus {
            border-color: #7B8D63;
            box-shadow: 0 0 0 0.25rem rgba(123, 141, 99, 0.15);
            background-color: #ffffff;
        }

        .btn-update {
            background-color: #063C0F;
            color: #ffffff;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            width: 100%;
            justify-content: center;
        }

        .btn-update:hover {
            background-color: #084d14;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        /* === PAYMENT PROOF === */
        .payment-image-wrapper {
            background-color: #f9f9f9;
            border: 2px dashed #e0e0e0;
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            margin-top: 1rem;
        }

        .payment-image-wrapper img {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
            transition: transform 0.3s ease;
        }

        .payment-image-wrapper img:hover {
            transform: scale(1.05);
        }

        .no-payment {
            color: #7B8D63;
            font-style: italic;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 12px;
            margin-top: 1rem;
        }

        .no-payment i {
            font-size: 2rem;
            color: #B7AF83;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem;
            }

            .detail-card .card-body {
                padding: 1.5rem;
            }

            .card-title-custom {
                font-size: 1.1rem;
            }

            .info-row {
                flex-direction: column;
                gap: 0.5rem;
            }

            .info-label {
                min-width: auto;
            }

            .items-table td {
                padding: 0.75rem 0.25rem;
                font-size: 0.9rem;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-receipt"></i> Detail Pesanan #{{ $order->id }}
        </h1>
        <div class="breadcrumb-custom">
            <a href="{{ route('admin.orders.index') }}">
                <i class="bi bi-cart-check"></i> Pesanan
            </a>
            <i class="bi bi-chevron-right"></i>
            <span>Detail Pesanan</span>
        </div>
    </div>

    <div class="row">
        {{-- Left Column --}}
        <div class="col-md-8">
            {{-- Order Items Card --}}
            <div class="card detail-card">
                <div class="card-body">
                    <h5 class="card-title-custom">
                        <i class="bi bi-basket"></i>
                        Detail Item Pesanan
                    </h5>
                    
                    <table class="items-table">
                        <tbody>
                            @foreach ($order->items as $item)
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
                </div>
            </div>

            {{-- Shipping Address Card --}}
            <div class="card detail-card">
                <div class="card-body">
                    <h5 class="card-title-custom">
                        <i class="bi bi-geo-alt"></i>
                        Alamat Pengiriman
                    </h5>
                    
                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-person-circle"></i>
                            Nama:
                        </div>
                        <div class="info-value">{{ $order->user->name }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-telephone"></i>
                            Telepon/WA:
                        </div>
                        <div class="info-value">{{ $order->phone_number }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-house"></i>
                            Alamat:
                        </div>
                        <div class="info-value">{{ $order->shipping_address }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column --}}
        <div class="col-md-4">
            {{-- Status Update Card --}}
            <div class="card detail-card">
                <div class="card-body">
                    <h5 class="card-title-custom">
                        <i class="bi bi-gear"></i>
                        Status Pesanan
                    </h5>
                    
                    @php
                        $statusClass = '';
                        $statusIcon = '';
                        switch($order->status) {
                            case 'menunggu konfirmasi admin':
                            case 'pending':
                                $statusClass = 'status-pending';
                                $statusIcon = 'bi-clock-history';
                                break;
                            case 'diproses':
                            case 'processing':
                                $statusClass = 'status-processing';
                                $statusIcon = 'bi-arrow-repeat';
                                break;
                            case 'dikirim':
                            case 'shipped':
                                $statusClass = 'status-shipped';
                                $statusIcon = 'bi-truck';
                                break;
                            case 'selesai':
                            case 'completed':
                                $statusClass = 'status-completed';
                                $statusIcon = 'bi-check-circle';
                                break;
                            case 'dibatalkan':
                            case 'cancelled':
                                $statusClass = 'status-cancelled';
                                $statusIcon = 'bi-x-circle';
                                break;
                            default:
                                $statusClass = 'status-pending';
                                $statusIcon = 'bi-clock-history';
                        }
                    @endphp

                    <div class="current-status {{ $statusClass }}">
                        <i class="bi {{ $statusIcon }}"></i>
                        {{ ucwords($order->status) }}
                    </div>

                    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label">
                                <i class="bi bi-arrow-left-right"></i>
                                Ubah Status Pesanan
                            </label>
                            <select name="status" id="status" class="form-select">
                                <option value="menunggu konfirmasi admin" {{ $order->status == 'menunggu konfirmasi admin' ? 'selected' : '' }}>
                                    Menunggu Konfirmasi Admin
                                </option>
                                <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>
                                    Dikirim
                                </option>
                                <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn-update">
                            <i class="bi bi-check-circle"></i>
                            Update Status
                        </button>
                    </form>
                </div>
            </div>

            {{-- Payment Proof Card --}}
            <div class="card detail-card">
                <div class="card-body">
                    <h5 class="card-title-custom">
                        <i class="bi bi-credit-card"></i>
                        Bukti Pembayaran
                    </h5>
                    
                    @if ($order->payment)
                        <div class="payment-image-wrapper">
                            <a href="{{ Storage::url($order->payment->proof_path) }}" target="_blank">
                                <img src="{{ Storage::url($order->payment->proof_path) }}" alt="Bukti Pembayaran">
                            </a>
                        </div>
                    @else
                        <div class="no-payment">
                            <i class="bi bi-image-alt"></i>
                            <span>Pelanggan belum mengunggah bukti pembayaran</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection