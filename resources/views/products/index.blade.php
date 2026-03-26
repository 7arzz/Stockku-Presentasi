@extends('layouts.app')

@section('content')

@php
    $role = Auth::user()->role;
    $prefix = $role === 'admin' ? '/admin' : "/$role";
@endphp

<div class="row mb-4 align-items-center">
    <div class="col">
        <h1 class="m-0" style="font-weight: 700;">Manajemen Produk</h1>
        <p class="text-muted">Laporan dan daftar produk Anda</p>
    </div>
    @if($role === 'admin')
    <div class="col-auto">
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            + Tambah Produk
        </a>
    </div>
    @endif
</div>

<div class="glass-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    @if($role !== 'owner')
                    <th scope="col" class="text-end">Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                <tr>
                    <td class="fw-bold">{{ $p->name }}</td>
                    <td class="text-accent">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                    <td>
                        @if($p->stock > 10)
                            <span class="badge rounded-pill text-white" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.5em 0.8em; font-weight: 600; letter-spacing: 0.5px;">
                                {{ $p->stock }} Pcs
                            </span>
                        @else
                            <span class="badge rounded-pill text-white" style="background: rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.3); padding: 0.5em 0.8em; font-weight: 600; letter-spacing: 0.5px;">
                                {{ $p->stock }} Pcs
                            </span>
                        @endif
                    </td>
                    @if($role !== 'owner')
                    <td>
                        <div class="d-flex gap-2 justify-content-end">
                            @if($role === 'admin' || $role === 'gudang')
                                <a href="{{ $prefix }}/products/{{ $p->id }}/edit" class="btn btn-outline-light btn-sm" style="border-color: var(--surface-border);">Edit</a>
                            @endif

                            @if($role === 'admin')
                                <form method="POST" action="{{ $prefix }}/products/{{ $p->id }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="background: rgba(239, 68, 68, 0.8); border: none;">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="{{ $role === 'owner' ? 3 : 4 }}" class="text-center text-muted py-4 fw-bold text-white">Belum ada produk yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection