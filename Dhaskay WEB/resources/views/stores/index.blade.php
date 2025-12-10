@extends('layouts.app')

@section('title', 'Daftar Toko')

@section('content')
<div class="container">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2><i class="fas fa-store me-2"></i>Daftar Toko</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('stores.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>Tambah Toko
            </a>
        </div>
    </div>

    @if($stores->count())
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th><i class="fas fa-hashtag me-2"></i>ID</th>
                    <th><i class="fas fa-tag me-2"></i>Nama</th>
                    <th><i class="fas fa-map-marker me-2"></i>Lokasi</th>
                    <th style="width: 200px;"><i class="fas fa-tools me-2"></i>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $s)
                <tr>
                    <td><strong>#{{ $s->id }}</strong></td>
                    <td><strong>{{ $s->name }}</strong></td>
                    <td><i class="fas fa-map-marker me-1"></i>{{ $s->location ?? '-' }}</td>
                    <td>
                        <a href="{{ route('stores.edit', $s->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('stores.destroy', $s->id) }}" method="POST" style="display:inline;">
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
            <h4>Belum ada toko</h4>
            <p class="mb-3">Mulai buat toko untuk mengorganisir produk Anda.</p>
            <a href="{{ route('stores.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Buat Toko Pertama
            </a>
        </div>
    @endif
</div>
@endsection
