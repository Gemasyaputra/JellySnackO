@extends('layouts.app')

@section('content')
    <style>
        /* === PAGE HEADER === */
        .page-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .page-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .page-title i {
            color: #B7AF83;
        }

        .page-subtitle {
            color: #7B8D63;
            font-size: 1rem;
        }

        /* === CHECKOUT STEPS === */
        .checkout-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-bottom: 3rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .step-number.inactive {
            background: #e0e0e0;
            color: #999;
        }

        .step-label {
            font-weight: 600;
            color: #063C0F;
            font-size: 0.95rem;
        }

        .step-label.inactive {
            color: #999;
        }

        .step-arrow {
            color: #B7AF83;
            font-size: 1.2rem;
        }

        /* === CARD STYLES === */
        .checkout-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .checkout-card .card-body {
            padding: 2rem;
        }

        .card-title-custom {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 1.4rem;
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
            font-size: 1.5rem;
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

        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: #fafafa;
        }

        .form-control:focus, .form-select:focus {
            border-color: #7B8D63;
            box-shadow: 0 0 0 0.25rem rgba(123, 141, 99, 0.15);
            background-color: #ffffff;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        /* === ORDER SUMMARY === */
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 10px;
            margin-bottom: 0.75rem;
            transition: all 0.2s ease;
        }

        .order-item:hover {
            background-color: #f0f0f0;
            transform: translateX(5px);
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .item-name {
            font-weight: 600;
            color: #1a1a1a;
        }

        .item-quantity {
            display: inline-block;
            background-color: #B7AF83;
            color: #ffffff;
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .item-price {
            font-weight: 700;
            color: #063C0F;
            font-size: 1rem;
        }

        /* === TOTAL SECTION === */
        .total-section {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            padding: 1.5rem;
            border-radius: 12px;
            margin-top: 1.5rem;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .total-label {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            color: #FFFBE2;
            font-size: 1.3rem;
        }

        .total-value {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            color: #FFFBE2;
            font-size: 1.5rem;
        }

        /* === SUBMIT BUTTON === */
        .btn-submit {
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
            width: 100%;
            justify-content: center;
        }

        .btn-submit:hover {
            background-color: #084d14;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        /* === INFO BOX === */
        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-left: 4px solid #2196f3;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-top: 1.5rem;
        }

        .info-box-title {
            font-weight: 700;
            color: #1565c0;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-box-text {
            color: #0d47a1;
            font-size: 0.9rem;
            margin: 0;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }

            .checkout-steps {
                flex-direction: column;
                gap: 1rem;
            }

            .step-arrow {
                display: none;
            }

            .checkout-card .card-body {
                padding: 1.5rem;
            }

            .card-title-custom {
                font-size: 1.2rem;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-credit-card"></i>
            Checkout
        </h1>
        <p class="page-subtitle">Lengkapi informasi pengiriman untuk menyelesaikan pesanan Anda</p>
    </div>

    {{-- Checkout Steps --}}
    <div class="checkout-steps">
        <div class="step-item">
            <div class="step-number">1</div>
            <span class="step-label">Keranjang</span>
        </div>
        <i class="bi bi-chevron-right step-arrow"></i>
        <div class="step-item">
            <div class="step-number">2</div>
            <span class="step-label">Checkout</span>
        </div>
        <i class="bi bi-chevron-right step-arrow"></i>
        <div class="step-item">
            <div class="step-number inactive">3</div>
            <span class="step-label inactive">Pembayaran</span>
        </div>
    </div>

    <div class="row">
        {{-- Left Column: Shipping Form --}}
        <div class="col-lg-7 mb-4">
            <div class="card checkout-card">
                <div class="card-body">
                    <h5 class="card-title-custom">
                        <i class="bi bi-geo-alt"></i>
                        Alamat Pengiriman
                    </h5>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="address" class="form-label">
                                <i class="bi bi-house"></i>
                                Alamat Lengkap
                            </label>
                            <textarea 
                                name="address" 
                                id="address" 
                                rows="4" 
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap pengiriman (nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan)"
                                required>{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                <i class="bi bi-whatsapp"></i>
                                Nomor Telepon (WhatsApp)
                            </label>
                            <input 
                                type="text" 
                                name="phone" 
                                id="phone" 
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Contoh: 08123456789"
                                value="{{ old('phone') }}"
                                required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Info Box --}}
                        <div class="info-box">
                            <div class="info-box-title">
                                <i class="bi bi-info-circle"></i>
                                Informasi Penting
                            </div>
                            <p class="info-box-text">
                                Pastikan nomor WhatsApp yang Anda masukkan aktif untuk mempermudah komunikasi terkait pengiriman pesanan.
                            </p>
                        </div>

                        <button type="submit" class="btn-submit mt-4">
                            <i class="bi bi-check-circle"></i>
                            Buat Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Right Column: Order Summary --}}
        <div class="col-lg-5">
            <div class="card checkout-card">
                <div class="card-body">
                    <h5 class="card-title-custom">
                        <i class="bi bi-receipt"></i>
                        Ringkasan Pesanan
                    </h5>

                    {{-- Order Items --}}
                    @foreach($cartItems as $item)
                        <div class="order-item">
                            <div class="item-info">
                                <span class="item-name">{{ $item->name }}</span>
                                <span class="item-quantity">x{{ $item->quantity }}</span>
                            </div>
                            <span class="item-price">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </span>
                        </div>
                    @endforeach

                    {{-- Total Section --}}
                    <div class="total-section">
                        <div class="total-row">
                            <span class="total-label">Total Pembayaran</span>
                            <span class="total-value">Rp {{ number_format(Cart::getTotal(), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- Additional Info --}}
                    <div class="info-box">
                        <div class="info-box-title">
                            <i class="bi bi-shield-check"></i>
                            Keamanan Transaksi
                        </div>
                        <p class="info-box-text">
                            Pesanan Anda akan diproses setelah melakukan pembayaran dan mengunggah bukti transfer.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection