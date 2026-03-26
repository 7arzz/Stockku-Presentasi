@extends('layouts.app')

@section('content')

<div class="row mb-4 align-items-center">
    <div class="col">
        <h1 class="m-0" style="font-weight: 700;">Tambah Produk Baru</h1>
        <p class="text-muted">Masukkan detail produk ke dalam sistem</p>
    </div>
    <div class="col-auto">
        <a href="{{ route('products.index') }}" class="btn btn-outline-light" style="border-color: var(--surface-border);">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="glass-card">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-muted">Nama Produk</label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Kopi Susu" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" placeholder="10000" min="0" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Stok Awal</label>
                    <input type="number" name="stock" class="form-control" placeholder="50" min="0" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Simpan Produk</button>
            </form>
        </div>
    </div>
</div>

@endsection