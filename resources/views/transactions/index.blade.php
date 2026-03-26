@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h1 class="m-0" style="font-weight: 700;">Riwayat Transaksi</h1>
        <p class="text-muted">Daftar semua transaksi yang telah dilakukan</p>
    </div>
</div>

<div class="glass-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th scope="col">ID Transaksi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Uang Bayar</th>
                    <th scope="col">Kembalian</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
                    <td class="fw-bold">#TRX-{{ str_pad($t->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                    <td class="text-accent fw-bold">Rp {{ number_format($t->total_price, 0, ',', '.') }}</td>
                    <td class="text-white fw-bold">Rp {{ number_format($t->paid, 0, ',', '.') }}</td>
                    <td class="text-success fw-bold">Rp {{ number_format($t->change, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
