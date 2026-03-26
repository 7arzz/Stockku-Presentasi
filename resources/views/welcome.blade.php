@extends('layouts.app')

@section('content')
<div class="row align-items-center" style="min-height: 70vh;">
    <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
        <h1 class="display-4 fw-bold mb-4" style="background: linear-gradient(to right, var(--primary), var(--accent)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            Kelola Bisnis Anda <br /> Lebih Mudah & Cepat
        </h1>
        <p class="lead mb-5 text-white">
            Stockku adalah Point of Sale (POS) premium yang memudahkan Anda dalam mengelola produk dan melayani transaksi pelanggan secara efisien.
        </p>
        
        <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow-lg" style="border-radius: 50px;">
                Mulai Masuk &rarr;
            </a>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="glass-card text-center p-5 position-relative overflow-hidden" style="border-radius: 2rem;">
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top right, rgba(236, 72, 153, 0.2), transparent 50%); pointer-events: none;"></div>
            
            <svg class="mb-4" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="url(#gradient)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" stop-color="#6366f1" />
                        <stop offset="100%" stop-color="#ec4899" />
                    </linearGradient>
                </defs>
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            
            <h3 class="fw-bold mb-3">Transaksi Super Cepat</h3>
            <p class="text-muted mb-0">Antarmuka interaktif yang dirancang untuk meminimalisir waktu layanan kasir dan otomatisasi penghitungan kembalian.</p>
        </div>
    </div>
</div>
@endsection
