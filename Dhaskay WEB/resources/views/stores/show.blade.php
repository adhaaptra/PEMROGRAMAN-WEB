@extends('layouts.app')

@section('title', 'Detail Toko')

@section('content')
<div class="container">
    <h2>🏬 {{ $store->name }}</h2>
    <p><strong>Lokasi:</strong> {{ $store->location ?? '-' }}</p>

    <h4 class="mt-4">Produk di toko ini</h4>
    @if($store->products && $store->products->count())
        <ul class="list-group">
            @foreach($store->products as $p)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $p->name }}
                    <span class="badge bg-primary">{{ optional($p->stock)->quantity ?? 0 }} pcs</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info">Belum ada produk di toko ini.</div>
    @endif

    <a href="{{ route('stores.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection
