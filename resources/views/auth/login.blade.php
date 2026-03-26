@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-8 col-lg-5">
        <div class="glass-card p-5">
            <div class="text-center mb-4">
                <h2 class="fw-bold mb-1">Masuk ke Stockku</h2>
                <p class="text-muted">Masuk menggunakan kredensial Anda</p>
            </div>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg" required autofocus value="{{ old('email') }}">
                </div>
                
                <div class="mb-4">
                    <label class="form-label text-muted">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold mb-3">MASUK</button>
                
                <div class="text-center text-muted">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-accent text-decoration-none fw-bold">Daftar sekarang</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
