@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    @auth
        <div class="row mb-4">
            <div class="col-md-12">
                <h1>Selamat datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-muted">Kelola produk e-commerce Anda di sini.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">📦 Produk</h5>
                        <p class="card-text">Kelola semua produk Anda</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">➕ Produk Baru</h5>
                        <p class="card-text">Tambahkan produk baru</p>
                        <a href="{{ route('products.create') }}" class="btn btn-success">Buat Produk</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">👤 Profil</h5>
                        <p class="card-text">{{ Auth::user()->email }}</p>
                        <a href="#" class="btn btn-info disabled">Coming Soon</a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="mb-4">🛍️ Selamat Datang di E-Commerce</h1>
                <p class="lead mb-4">Platform e-commerce modern untuk mengelola produk Anda</p>

                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Sudah punya akun?</h5>
                                <p class="card-text">Login untuk mengakses dashboard</p>
                                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Belum punya akun?</h5>
                                <p class="card-text">Daftar sekarang untuk memulai</p>
                                <a href="{{ route('register') }}" class="btn btn-success">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info">
                    <strong>💡 Tip:</strong> Silahkan daftar terlebih dahulu, kemudian login untuk mengakses semua fitur.
                </div>
            </div>
        </div>
    @endauth
</div>
@endsection