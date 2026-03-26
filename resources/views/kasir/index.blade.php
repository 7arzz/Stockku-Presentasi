@extends('layouts.app')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col">
        <h1 class="m-0" style="font-weight: 700;">Point of Sale</h1>
        <p class="text-muted">Proses transaksi belanja</p>
    </div>
</div>

<form method="POST" action="/kasir" id="posForm">
    @csrf

    <div class="row g-4">
        <!-- Products Section -->
        <div class="col-lg-8">
            <div class="glass-card">
                <h4 class="mb-4" style="color: var(--primary);">Pilih Produk</h4>
                
                <div class="row g-3">
                    @forelse($products as $p)
                        <div class="col-md-6 col-lg-4">
                            <label class="d-block w-100 h-100" style="cursor: pointer;">
                                <div class="glass-card product-card p-3 h-100 d-flex flex-column" style="background: rgba(15, 23, 42, 0.4); border: 1px solid var(--surface-border); transition: all 0.3s ease;">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input product-check" type="checkbox" name="items[{{ $loop->index }}][product_id]" value="{{ $p->id }}" data-price="{{ $p->price }}" data-index="{{ $loop->index }}" id="prod-{{ $p->id }}">
                                        <label class="form-check-label fw-bold" for="prod-{{ $p->id }}">
                                            {{ $p->name }}
                                        </label>
                                    </div>
                                    <h5 class="text-accent mb-auto">Rp {{ number_format($p->price, 0, ',', '.') }}</h5>
                                    <div class="mt-3">
                                        <small class="text-muted d-block mb-1">Stok: {{ $p->stock }}</small>
                                        <input type="number" name="items[{{ $loop->index }}][qty]" class="form-control form-control-sm qty-input" placeholder="Qty" min="1" max="{{ $p->stock }}" disabled data-price="{{ $p->price }}">
                                    </div>
                                </div>
                            </label>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning" style="background: rgba(245, 158, 11, 0.2); border-color: rgba(245, 158, 11, 0.3); color: #fcd34d;">
                                Belum ada produk tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Order Summary Section -->
        <div class="col-lg-4">
            <div class="glass-card sticky-top" style="top: 100px;">
                <h4 class="mb-4" style="color: var(--accent);">Ringkasan Transaksi</h4>
                
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Belanja</span>
                    <h3 class="m-0 text-white" id="totalAmount">Rp 0</h3>
                </div>
                
                <hr style="border-color: var(--surface-border);">
                
                <div class="mb-3">
                    <label class="form-label text-muted">Uang Bayar</label>
                    <div class="input-group">
                        <span class="input-group-text" style="background: rgba(15,23,42,0.8); border: 1px solid var(--surface-border); color:var(--text-main);">Rp</span>
                        <input type="number" name="paid" id="paidAmount" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <span class="text-muted">Kembalian</span>
                    <h4 class="m-0 text-success" id="changeAmount">Rp 0</h4>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow-lg" id="submitBtn" disabled>
                    PROSES TRANSAKSI
                </button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<style>
    .product-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary) !important;
        box-shadow: 0 5px 15px rgba(99, 102, 241, 0.2);
    }
    .text-accent {
        color: var(--accent);
    }
    input[type="number"]::-webkit-inner-spin-button, 
    input[type="number"]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.product-check');
    const qtyInputs = document.querySelectorAll('.qty-input');
    const totalAmountEl = document.getElementById('totalAmount');
    const changeAmountEl = document.getElementById('changeAmount');
    const paidAmountInput = document.getElementById('paidAmount');
    const submitBtn = document.getElementById('submitBtn');
    
    let total = 0;

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    function calculateTotal() {
        total = 0;
        let hasChecked = false;

        checkboxes.forEach((cb, index) => {
            const qtyInput = qtyInputs[index];
            if (cb.checked) {
                hasChecked = true;
                qtyInput.disabled = false;
                if (!qtyInput.value) qtyInput.value = 1;

                const price = parseFloat(cb.dataset.price);
                const qty = parseInt(qtyInput.value) || 0;
                total += price * qty;
            } else {
                qtyInput.disabled = true;
                qtyInput.value = '';
            }
        });

        totalAmountEl.textContent = formatRupiah(total);
        calculateChange();
        
        // Enable submit only if there's at least one item checked and paid >= total
        const paid = parseFloat(paidAmountInput.value) || 0;
        submitBtn.disabled = !hasChecked || paid < total || total === 0;
    }

    function calculateChange() {
        const paid = parseFloat(paidAmountInput.value) || 0;
        const change = paid - total;
        
        if (change >= 0) {
            changeAmountEl.textContent = formatRupiah(change);
            changeAmountEl.classList.remove('text-danger');
            changeAmountEl.classList.add('text-success');
        } else {
            changeAmountEl.textContent = formatRupiah(0);
            changeAmountEl.classList.remove('text-success');
            changeAmountEl.classList.add('text-danger');
        }

        // Check again for button disabled state
        const hasChecked = Array.from(checkboxes).some(cb => cb.checked);
        submitBtn.disabled = !hasChecked || paid < total || total === 0;
    }

    checkboxes.forEach(cb => cb.addEventListener('change', calculateTotal));
    qtyInputs.forEach(input => input.addEventListener('input', calculateTotal));
    paidAmountInput.addEventListener('input', calculateChange);
});
</script>
@endsection