@extends('layouts.app')

@section('title', 'Daftar Stok')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2><i class="fas fa-cubes me-2"></i>Manajemen Stok</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('stocks.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>Tambah/Atur Stok
            </a>
        </div>
    </div>

    @if($stocks->count())
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-2"></i>ID</th>
                    <th><i class="fas fa-box me-2"></i>Produk</th>
                    <th><i class="fas fa-store me-2"></i>Toko</th>
                    <th style="width: 120px;"><i class="fas fa-cubes me-2"></i>Jumlah</th>
                    <th style="width: 200px;"><i class="fas fa-tools me-2"></i>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $s)
                <tr>
                    <td><strong>#{{ $s->id }}</strong></td>
                    <td><strong>{{ $s->product->name ?? '-' }}</strong></td>
                    <td><i class="fas fa-map-marker me-1"></i>{{ $s->store->name ?? 'Global' }}</td>
                    <td>
                        <span class="badge bg-info">{{ $s->quantity }} pcs</span>
                    </td>
                    <td>
                        <a href="{{ route('stocks.edit', $s->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('stocks.destroy', $s->id) }}" method="POST" style="display:inline;">
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
            <h4>Belum ada data stok</h4>
            <p class="mb-3">Mulai tambahkan stok untuk produk Anda.</p>
            <a href="{{ route('stocks.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Buat Stok Pertama
            </a>
        </div>
    @endif
</div>
@endsection
