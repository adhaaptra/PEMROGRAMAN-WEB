@extends('layouts.app')

@section('title', 'Detail Stok')

@section('content')
<div class="container">
    <h2>📦 Detail Stok</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Produk:</strong> {{ $stock->product->name ?? '-' }}</p>
            <p><strong>Toko:</strong> {{ $stock->store->name ?? 'Global' }}</p>
            <p><strong>Jumlah:</strong> {{ $stock->quantity }}</p>
        </div>
    </div>

    <a href="{{ route('stocks.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection
