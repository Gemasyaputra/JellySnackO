@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')

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

        /* === FORM CARD === */
        .form-card {
            background-color: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .form-card .card-body {
            padding: 2.5rem;
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

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background-color: #fafafa;
        }

        .form-control:focus {
            border-color: #7B8D63;
            box-shadow: 0 0 0 0.25rem rgba(123, 141, 99, 0.15);
            background-color: #ffffff;
        }

        .form-control.is-invalid {
            border-color: #ef5350;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(239, 83, 80, 0.15);
        }

        .invalid-feedback {
            color: #ef5350;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .invalid-feedback::before {
            content: '⚠';
            font-size: 1rem;
        }

        /* === FORM SECTION === */
        .form-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-family: 'Merriweather', serif;
            color: #063C0F;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: #B7AF83;
            font-size: 1.3rem;
        }

        /* === FORM HINT === */
        .form-hint {
            font-size: 0.85rem;
            color: #7B8D63;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-hint i {
            font-size: 0.9rem;
        }

        /* === ACTION BUTTONS === */
        .action-buttons {
            display: flex;
            gap: 1rem;
            padding-top: 2rem;
            border-top: 2px solid #f0f0f0;
            margin-top: 2rem;
        }

        .btn-save {
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
        }

        .btn-save:hover {
            background-color: #084d14;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        .btn-cancel {
            background-color: #f5f5f5;
            color: #666;
            border: 2px solid #e0e0e0;
            padding: 0.875rem 2.5rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background-color: #B7AF83;
            color: #ffffff;
            border-color: #B7AF83;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .form-card .card-body {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-save,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-plus-circle"></i> Tambah Kategori Baru
        </h1>
        <div class="breadcrumb-custom">
            <a href="{{ route('admin.categories.index') }}">
                <i class="bi bi-grid-3x3-gap"></i> Kategori
            </a>
            <i class="bi bi-chevron-right"></i>
            <span>Tambah Baru</span>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                {{-- Category Information Section --}}
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="bi bi-info-circle"></i>
                        Informasi Kategori
                    </h3>

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <i class="bi bi-tag"></i> Nama Kategori
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama kategori">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-hint">
                            <i class="bi bi-info-circle"></i>
                            Slug akan dibuat otomatis dari nama kategori
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle"></i>
                        Simpan Kategori
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection