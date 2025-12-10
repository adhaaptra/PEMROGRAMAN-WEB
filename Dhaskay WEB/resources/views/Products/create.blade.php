@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white py-4">
                    <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Produk Baru</h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('products.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-group mb-4">
                            <label for="name" class="form-label"><i class="fas fa-tag me-2"></i>Nama Produk</label>
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   id="name" name="name" placeholder="Nama Produk" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="price" class="form-label"><i class="fas fa-money-bill me-2"></i>Harga Produk</label>
                            <input type="number" class="form-control form-control-lg @error('price') is-invalid @enderror" 
                                   id="price" name="price" placeholder="Harga Produk" value="{{ old('price') }}" required>
                            @error('price')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="description" class="form-label"><i class="fas fa-file-alt me-2"></i>Deskripsi</label>
                            <textarea class="form-control form-control-lg @error('description') is-invalid @enderror" 
                                      id="description" name="description" placeholder="Deskripsi Produk" 
                                      rows="4" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="stok" class="form-label"><i class="fas fa-cubes me-2"></i>Stok</label>
                            <input type="number" class="form-control form-control-lg @error('stok') is-invalid @enderror" 
                                   id="stok" name="stok" placeholder="Jumlah Stok" value="{{ old('stok', 0) }}" required>
                            @error('stok')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label for="store_id" class="form-label"><i class="fas fa-store me-2"></i>Toko</label>
                            <select id="store_id" name="store_id" class="form-select form-select-lg @error('store_id') is-invalid @enderror">
                                <option value="">-- Pilih Toko (opsional) --</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>{{ $store->name }} - {{ $store->location }}</option>
                                @endforeach
                            </select>
                            @error('store_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check me-2"></i>Simpan Produk
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection