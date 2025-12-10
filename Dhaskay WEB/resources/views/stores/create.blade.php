@extends('layouts.app')

@section('title', 'Tambah Toko')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white py-4">
                    <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Toko Baru</h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('stores.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fas fa-tag me-2"></i>Nama Toko</label>
                            <input name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Nama Toko" required>
                            @error('name')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <label class="form-label"><i class="fas fa-map-marker me-2"></i>Lokasi</label>
                            <input name="location" class="form-control form-control-lg @error('location') is-invalid @enderror" 
                                   value="{{ old('location') }}" placeholder="Lokasi Toko">
                            @error('location')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check me-2"></i>Simpan Toko
                            </button>
                            <a href="{{ route('stores.index') }}" class="btn btn-secondary btn-lg">
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
