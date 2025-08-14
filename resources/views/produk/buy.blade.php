@extends('app')

@section('title', 'Beli Produk')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0 fw-bold text-dark">Beli Produk</h4>
                            <p class="text-muted mb-0">Lengkapi detail pembelian produk</p>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger text-center">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success text-center">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <h5 class="fw-bold">{{ $produk->nama }}</h5>
                    <p class="mb-1">Harga: <strong>Rp{{ number_format($produk->harga, 0, ',', '.') }}</strong></p>
                    <p class="mb-1">Stok tersedia: <strong>{{ $produk->stok }}</strong></p>
                    <p class="text-muted">{{ $produk->deskripsi }}</p>

                    <form method="POST" action="{{ route('produk.purchase', $produk->id) }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="quantity" class="form-label fw-medium">Jumlah yang ingin dibeli</label>
                            <input type="number" 
                                   name="quantity" 
                                   id="quantity" 
                                   class="form-control form-control-lg" 
                                   min="1" 
                                   max="{{ $produk->stok }}" 
                                   placeholder="Masukkan jumlah"
                                   required>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-cart-check me-1"></i>Beli Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
