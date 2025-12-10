@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2><i class="fas fa-box me-2"></i>Daftar Produk</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-success btn-lg">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </a>
        </div>
    </div>

    @if($products->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-2"></i>ID</th>
                    <th><i class="fas fa-tag me-2"></i>Nama</th>
                    <th><i class="fas fa-money-bill me-2"></i>Harga</th>
                    <th><i class="fas fa-cubes me-2"></i>Stok</th>
                    <th><i class="fas fa-store me-2"></i>Toko</th>
                    <th><i class="fas fa-file-alt me-2"></i>Deskripsi</th>
                    <th style="width: 200px;"><i class="fas fa-tools me-2"></i>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                <tr>
                    <td><strong>#{{ $p->id }}</strong></td>
                    <td><strong>{{ $p->name }}</strong></td>
                    <td><span class="badge bg-info">Rp {{ number_format($p->price, 0, ',', '.') }}</span></td>
                    <td>
                        @if(optional($p->stock)->quantity > 0)
                            <span class="badge bg-success"><i class="fas fa-check me-1"></i>{{ optional($p->stock)->quantity }} pcs</span>
                        @else
                            <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Habis</span>
                        @endif
                    </td>
                    <td><i class="fas fa-map-marker me-1"></i>{{ $p->store->name ?? '-' }}</td>
                    <td><small>{{ \Illuminate\Support\Str::limit($p->description, 40) }}</small></td>
                    <td>
                        <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info text-center py-5" role="alert">
        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block; opacity: 0.5;"></i>
        <h4>Belum ada produk</h4>
        <p class="mb-3">Mulai tambahkan produk untuk memulai bisnis Anda.</p>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Buat Produk Pertama
        </a>
    </div>
    @endif
</div>
@endsection
