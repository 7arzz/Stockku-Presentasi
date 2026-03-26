@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-8 col-lg-5">
        <div class="glass-card p-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">Daftar Akun Stockku</h2>
                <p class="text-white">Buat akun karyawan baru</p>
            </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label text-white">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label text-white">Email Address</label>
                    <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                </div>
                
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label text-white">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label text-white">Ulangi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white">Daftar sebagai (Role)</label>
                    <select name="role" class="form-select text-white" required style="background-color: rgba(15, 23, 42, 0.5);">
                        <option value="" disabled selected>Jabatan</option>
                        <option value="kasir">Kasir (Bisa akses transaksi)</option>
                        <option value="gudang">Petugas Gudang (Bisa akses stok)</option>
                        <option value="owner">Owner (Hanya lihat laporan)</option>
                        <option value="admin">Admin (Akses Penuh)</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold mb-3">DAFTAR</button>
                
                <div class="text-center text-white">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-accent text-decoration-none fw-bold">Masuk di sini</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
