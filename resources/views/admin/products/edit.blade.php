@extends('layouts.admin')

@section('title', 'Edit Produk')

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

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #ef5350;
        }

        .form-control.is-invalid:focus, .form-select.is-invalid:focus {
            box-shadow: 0 0 0 0.25rem rgba(239, 83, 80, 0.15);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
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

        /* === FILE INPUT === */
        .file-input-wrapper {
            position: relative;
        }

        .form-control[type="file"] {
            cursor: pointer;
        }

        .file-input-hint {
            font-size: 0.85rem;
            color: #7B8D63;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .file-input-hint i {
            font-size: 0.9rem;
        }

        /* === CURRENT IMAGE DISPLAY === */
        .current-image-wrapper {
            background-color: #f9f9f9;
            border: 2px dashed #e0e0e0;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .current-image-wrapper img {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
        }

        .no-image-text {
            color: #7B8D63;
            font-style: italic;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 2rem;
        }

        .no-image-text i {
            font-size: 2rem;
            color: #B7AF83;
        }

        /* === FORM SECTION === */
        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 2px dashed #e0e0e0;
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
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
            <i class="bi bi-pencil-square"></i> Edit Produk
        </h1>
        <div class="breadcrumb-custom">
            <a href="{{ route('admin.products.index') }}">
                <i class="bi bi-box-seam"></i> Produk
            </a>
            <i class="bi bi-chevron-right"></i>
            <span>Edit Produk</span>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card form-card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Basic Information Section --}}
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="bi bi-info-circle"></i>
                        Informasi Dasar
                    </h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-tag"></i> Nama Produk
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $product->name) }}"
                                placeholder="Masukkan nama produk">
                            @error('name') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label">
                                <i class="bi bi-grid"></i> Kategori
                            </label>
                            <select 
                                class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" 
                                name="category_id">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option 
                                        value="{{ $category->id }}" 
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="bi bi-text-left"></i> Deskripsi
                        </label>
                        <textarea 
                            class="form-control @error('description') is-invalid @enderror" 
                            id="description" 
                            name="description" 
                            rows="4"
                            placeholder="Deskripsikan produk Anda...">{{ old('description', $product->description) }}</textarea>
                        @error('description') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror
                    </div>
                </div>

                {{-- Pricing & Stock Section --}}
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="bi bi-cash-stack"></i>
                        Harga & Stok
                    </h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">
                                <i class="bi bi-currency-dollar"></i> Harga (Rp)
                            </label>
                            <input 
                                type="number" 
                                class="form-control @error('price') is-invalid @enderror" 
                                id="price" 
                                name="price" 
                                value="{{ old('price', $product->price) }}"
                                placeholder="0"
                                min="0">
                            @error('price') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label">
                                <i class="bi bi-box"></i> Stok
                            </label>
                            <input 
                                type="number" 
                                class="form-control @error('stock') is-invalid @enderror" 
                                id="stock" 
                                name="stock" 
                                value="{{ old('stock', $product->stock) }}"
                                placeholder="0"
                                min="0">
                            @error('stock') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Product Image Section --}}
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="bi bi-image"></i>
                        Gambar Produk
                    </h3>

                    {{-- Current Image Display --}}
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="bi bi-eye"></i> Gambar Saat Ini
                        </label>
                        <div class="current-image-wrapper">
                            @if($product->image_path)
                                <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" width="200">
                            @else
                                <div class="no-image-text">
                                    <i class="bi bi-image-alt"></i>
                                    <span>Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Upload New Image --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">
                            <i class="bi bi-upload"></i> Ganti Gambar (Opsional)
                        </label>
                        <div class="file-input-wrapper">
                            <input 
                                type="file" 
                                class="form-control @error('image') is-invalid @enderror" 
                                id="image" 
                                name="image"
                                accept="image/*">
                            @error('image') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>
                        <div class="file-input-hint">
                            <i class="bi bi-info-circle"></i>
                            Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengganti gambar
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle"></i>
                        Update Produk
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection