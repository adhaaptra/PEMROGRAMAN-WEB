@extends('layouts.app')

@section('title', 'Edit Stok')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-warning text-dark py-4">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Stok</h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('stocks.update', $stock->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fas fa-box me-2"></i>Produk</label>
                            <select name="product_id" class="form-select form-select-lg @error('product_id') is-invalid @enderror" required>
                                @foreach($products as $p)
                                    <option value="{{ $p->id }}" {{ $stock->product_id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label"><i class="fas fa-store me-2"></i>Toko</label>
                            <select name="store_id" class="form-select form-select-lg @error('store_id') is-invalid @enderror">
                                <option value="">-- Pilih Toko --</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->id }}" {{ $stock->store_id == $store->id ? 'selected' : '' }}>{{ $store->name }} - {{ $store->location }}</option>
                                @endforeach
                            </select>
                            @error('store_id')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <label class="form-label"><i class="fas fa-cubes me-2"></i>Jumlah</label>
                            <input type="number" name="quantity" class="form-control form-control-lg @error('quantity') is-invalid @enderror" 
                                   value="{{ old('quantity', $stock->quantity) }}" required>
                            @error('quantity')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="fas fa-save me-2"></i>Update
                            </button>
                            <a href="{{ route('stocks.index') }}" class="btn btn-secondary btn-lg">
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
