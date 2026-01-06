@extends('layouts.app')

@section('content')
    <style>
        /* === PAGE HEADER === */
        .payment-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .page-header {
            text-align: center;
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
            justify-content: center;
            gap: 0.75rem;
        }

        .page-title i {
            color: #B7AF83;
        }

        .order-id {
            display: inline-block;
            background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
            color: #ffffff;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1rem;
            font-family: 'Courier New', monospace;
        }

        .page-subtitle {
            color: #7B8D63;
            font-size: 1rem;
            margin-top: 1rem;
        }

        /* === PAYMENT STEPS === */
        .payment-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
            padding: 1.25rem;
            background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .step-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .step-number {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
        }

        .step-label {
            font-weight: 600;
            color: #063C0F;
            font-size: 0.85rem;
        }

        .step-arrow {
            color: #B7AF83;
            font-size: 1rem;
        }

        /* === CARD STYLES === */
        .payment-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .payment-card .card-body {
            padding: 2rem;
        }

        /* === TOTAL SECTION === */
        .total-section {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .total-label {
            color: #B7AF83;
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .total-amount {
            font-family: 'Merriweather', serif;
            color: #FFFBE2;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
        }

        /* === QRIS SECTION === */
        .qris-section {
            text-align: center;
        }

        .qris-title {
            font-weight: 700;
            color: #063C0F;
            font-size: 1.1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .qris-title i {
            color: #B7AF83;
            font-size: 1.3rem;
        }

        .qris-description {
            color: #7B8D63;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .qris-wrapper {
            background-color: #f9f9f9;
            border: 3px dashed #e0e0e0;
            border-radius: 16px;
            padding: 1.5rem;
            display: inline-block;
            max-width: 100%;
        }

        .qris-image {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* === UPLOAD SECTION === */
        .upload-section {
            text-align: center;
        }

        .upload-title {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            color: #063C0F;
            font-size: 1.3rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .upload-title i {
            color: #B7AF83;
            font-size: 1.4rem;
        }

        .upload-description {
            color: #7B8D63;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        /* === FILE INPUT === */
        .file-input-wrapper {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control[type="file"] {
            border: 2px dashed #e0e0e0;
            border-radius: 12px;
            padding: 2rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: #fafafa;
            cursor: pointer;
        }

        .form-control[type="file"]:hover {
            border-color: #B7AF83;
            background-color: #f5f5f5;
        }

        .form-control[type="file"]::file-selector-button {
            background-color: #B7AF83;
            color: #ffffff;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 1rem;
            transition: all 0.2s ease;
        }

        .form-control[type="file"]::file-selector-button:hover {
            background-color: #9a9370;
        }

        .file-hint {
            font-size: 0.85rem;
            color: #7B8D63;
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .file-hint i {
            font-size: 0.9rem;
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
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            border-left: 4px solid #ff9800;
            padding: 1rem 1.25rem;
            border-radius: 10px;
            margin-top: 1.5rem;
            text-align: left;
        }

        .info-box-title {
            font-weight: 700;
            color: #e65100;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-box-list {
            color: #e65100;
            font-size: 0.9rem;
            margin: 0;
            padding-left: 1.5rem;
        }

        .info-box-list li {
            margin-bottom: 0.5rem;
        }

        /* === RESPONSIVE === */
        @media (max-width: 576px) {
            .payment-container {
                padding: 1rem 0.5rem;
            }

            .page-title {
                font-size: 1.5rem;
                flex-direction: column;
                gap: 0.5rem;
            }

            .total-amount {
                font-size: 2rem;
            }

            .payment-card .card-body {
                padding: 1.5rem;
            }

            .payment-steps {
                flex-direction: column;
                gap: 0.75rem;
            }

            .step-arrow {
                display: none;
            }
        }
    </style>

    <div class="payment-container">
        {{-- Page Header --}}
        <div class="page-header">
            <h1 class="page-title">
                <i class="bi bi-credit-card-2-front"></i>
                Pembayaran Pesanan
            </h1>
            <div class="order-id">#{{ $order->id }}</div>
            <p class="page-subtitle">Silakan selesaikan pembayaran untuk memproses pesanan Anda</p>
        </div>

        {{-- Payment Steps --}}
        <div class="payment-steps">
            <div class="step-item">
                <div class="step-number">1</div>
                <span class="step-label">Scan QRIS</span>
            </div>
            <i class="bi bi-chevron-right step-arrow"></i>
            <div class="step-item">
                <div class="step-number">2</div>
                <span class="step-label">Bayar</span>
            </div>
            <i class="bi bi-chevron-right step-arrow"></i>
            <div class="step-item">
                <div class="step-number">3</div>
                <span class="step-label">Upload Bukti</span>
            </div>
        </div>

        {{-- Total Amount Card --}}
        <div class="payment-card">
            <div class="card-body">
                <div class="total-section">
                    <p class="total-label">Total Tagihan</p>
                    <h2 class="total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h2>
                </div>

                {{-- QRIS Section --}}
                <div class="qris-section">
                    <h3 class="qris-title">
                        <i class="bi bi-qr-code-scan"></i>
                        Scan QRIS untuk Membayar
                    </h3>
                    <p class="qris-description">
                        Buka aplikasi pembayaran digital Anda (GoPay, OVO, Dana, ShopeePay, dll) dan scan kode QRIS di bawah ini
                    </p>
                    <div class="qris-wrapper">
                        <img src="/images/qris.jpg" alt="QRIS Code" class="qris-image">
                    </div>
                </div>
            </div>
        </div>

        {{-- Upload Proof Card --}}
        <div class="payment-card">
            <div class="card-body">
                <div class="upload-section">
                    <h3 class="upload-title">
                        <i class="bi bi-cloud-upload"></i>
                        Konfirmasi Pembayaran
                    </h3>
                    <p class="upload-description">
                        Setelah melakukan pembayaran, silakan upload bukti transfer untuk konfirmasi pesanan
                    </p>

                    <form action="{{ route('payment.store', $order) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="file-input-wrapper">
                            <input 
                                type="file" 
                                name="payment_proof" 
                                class="form-control @error('payment_proof') is-invalid @enderror" 
                                accept="image/*"
                                required>
                            @error('payment_proof')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="file-hint">
                                <i class="bi bi-info-circle"></i>
                                Format: JPG, PNG, JPEG. Maksimal 2MB
                            </div>
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-circle"></i>
                            Kirim Bukti Pembayaran
                        </button>
                    </form>

                    {{-- Info Box --}}
                    <div class="info-box">
                        <div class="info-box-title">
                            <i class="bi bi-exclamation-triangle"></i>
                            Penting!
                        </div>
                        <ul class="info-box-list">
                            <li>Pastikan bukti pembayaran terlihat jelas</li>
                            <li>Nominal pembayaran harus sesuai dengan total tagihan</li>
                            <li>Pesanan akan diproses setelah pembayaran terverifikasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection