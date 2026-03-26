@extends('layouts.app')

@section('content')

@php
    $role = Auth::user()->role;
    $prefix = $role === 'admin' ? '/admin' : "/$role";
@endphp

<div class="row mb-4 align-items-center">
    <div class="col">
        <h1 class="m-0" style="font-weight: 700;">Edit Produk</h1>
        <p class="text-muted">Perbarui informasi produk: {{ $product->name }}</p>
    </div>
    <div class="col-auto">
        <a href="{{ $prefix }}/products" class="btn btn-outline-light" style="border-color: var(--surface-border);">Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="glass-card">
            <form method="POST" action="{{ $prefix }}/products/{{ $product->id }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label text-muted">Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}" min="0" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Stok Tersedia</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}" min="0" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2">Perbarui Produk</button>
            </form>
        </div>
    </div>
</div>

@endsection
