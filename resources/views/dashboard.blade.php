@extends('layouts.app')

@section('content')
<div class="row align-items-center mb-5">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="display-4 fw-bold" style="color: var(--text-main);">Hi, {{ Auth::user()->name }}!</h1>
        <p class="text-muted fs-5">Selamat datang di {{ $title }}</p>
    </div>
    <div class="col-lg-6 text-lg-end">
        <h5 class="text-accent mb-0 d-flex align-items-center justify-content-lg-end gap-2">
            Role: 
            <span class="badge rounded-pill" style="background: rgba(99, 102, 241, 0.15); color: #818cf8; border: 1px solid rgba(99, 102, 241, 0.3); padding: 0.5em 1em; font-size: 1rem; font-weight: 600; letter-spacing: 0.5px;">
                {{ ucfirst(Auth::user()->role) }}
            </span>
        </h5>
    </div>
</div>

<div class="row g-4">
    @if(Auth::user()->role === 'admin')
        <!-- Admin Dashboard Cards -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="glass-card text-center transition-all hover-card h-100">
                    <h3 class="mb-3">Kelola Produk</h3>
                    <p class="text-muted mb-0">Tambah, Edit, Hapus, dan lihat daftar stok produk.</p>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.transactions') }}" class="text-decoration-none">
                <div class="glass-card text-center transition-all hover-card h-100">
                    <h3 class="mb-3">Riwayat Transaksi</h3>
                    <p class="text-muted mb-0">Lihat seluruh rekam laporan transaksi penjualan.</p>
                </div>
            </a>
        </div>
    @elseif(Auth::user()->role === 'kasir')
        <!-- Kasir Dashboard Cards -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('kasir.index') }}" class="text-decoration-none">
                <div class="glass-card text-center transition-all hover-card h-100 pb-5 pt-5 border-primary">
                    <h3 class="text-primary fw-bold mb-3">Mulai Kasir (POS)</h3>
                    <p class="text-muted mb-0">Proses transaksi pelanggan secara real-time.</p>
                </div>
            </a>
        </div>
    @elseif(Auth::user()->role === 'gudang')
        <!-- Gudang Dashboard Cards -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('gudang.products') }}" class="text-decoration-none">
                <div class="glass-card text-center transition-all hover-card h-100">
                    <h3 class="mb-3">Update Stok Produk</h3>
                    <p class="text-muted mb-0">Lihat dan perbarui stok untuk produk-produk di gudang.</p>
                </div>
            </a>
        </div>
    @elseif(Auth::user()->role === 'owner')
        <!-- Owner Dashboard Cards -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('owner.products') }}" class="text-decoration-none">
                <div class="glass-card text-center transition-all hover-card h-100">
                    <h3 class="mb-3">Laporan Stok</h3>
                    <p class="text-muted mb-0">Pantau ketersediaan stok seluruh produk.</p>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('owner.transactions') }}" class="text-decoration-none">
                <div class="glass-card text-center transition-all hover-card h-100">
                    <h3 class="mb-3">Laporan Transaksi</h3>
                    <p class="text-muted mb-0">Lihat rekapitulasi pembayaran transaksi toko.</p>
                </div>
            </a>
        </div>
    @endif
</div>

<style>
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        border-color: var(--primary) !important;
    }
</style>
@endsection
