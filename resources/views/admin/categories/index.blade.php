@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

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

        .btn-add {
            background-color: #063C0F;
            color: #FFFBE2;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 60, 15, 0.2);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add:hover {
            background-color: #084d14;
            color: #FFFBE2;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(6, 60, 15, 0.3);
        }

        /* === ALERT === */
        .alert-success {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            border: 2px solid #66bb6a;
            border-radius: 12px;
            color: #2e7d32;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
        }

        .alert-success::before {
            content: '✓';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background-color: #2e7d32;
            color: #ffffff;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.2rem;
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
        .categories-table {
            margin: 0;
            width: 100%;
        }

        .categories-table thead {
            background: linear-gradient(135deg, #063C0F 0%, #084d14 100%) !important;
        }

        .categories-table thead th {
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

        .categories-table tbody td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #333;
        }

        .categories-table tbody tr:last-child td {
            border-bottom: none;
        }

        .categories-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* === CATEGORY INFO === */
        .category-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #B7AF83 0%, #9a9370 100%);
            color: #ffffff;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
        }

        .category-name {
            font-weight: 700;
            color: #1a1a1a;
            font-size: 1.1rem;
        }

        .category-slug {
            display: inline-block;
            background-color: #f5f5f5;
            color: #7B8D63;
            padding: 0.4rem 1rem;
            border-radius: 15px;
            font-weight: 600;
            font-size: 0.85rem;
            font-family: 'Courier New', monospace;
        }

        /* === ACTION BUTTONS === */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-edit {
            background-color: #ffa726;
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
        }

        .btn-edit:hover {
            background-color: #fb8c00;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 167, 38, 0.3);
        }

        .btn-delete {
            background-color: #ef5350;
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
        }

        .btn-delete:hover {
            background-color: #e53935;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(239, 83, 80, 0.3);
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

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .categories-table {
                font-size: 0.85rem;
            }

            .categories-table thead th,
            .categories-table tbody td {
                padding: 0.75rem 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-edit,
            .btn-delete {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    {{-- Page Header --}}
    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-grid-3x3-gap"></i> Manajemen Kategori
        </h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>
    </div>

    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Categories Table --}}
    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table categories-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Slug</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>
                                    <div class="category-number">{{ $loop->iteration }}</div>
                                </td>
                                <td>
                                    <div class="category-name">{{ $category->name }}</div>
                                </td>
                                <td>
                                    <span class="category-slug">{{ $category->slug }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-delete">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h4>Belum Ada Kategori</h4>
                                        <p>Silakan tambah kategori baru untuk memulai.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($categories->hasPages())
                <div class="pagination-wrapper">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection