@extends('app')

@section('title', 'Products')

@section('content')
<div class="container mt-4">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark mb-0">Product Catalog</h2>
            <p class="text-muted mb-0">Browse our collection of products</p>
        </div>
        @auth
            @if(auth()->user()->role === 'admin')
                <div class="col-auto">
                    <a href="{{ route('produk.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>Add Product
                    </a>
                </div>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($produk->isEmpty())
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-box-seam" style="font-size: 4rem; color: #dee2e6;"></i>
            </div>
            <h4 class="text-muted">No products available</h4>
            <p class="text-muted">Check back later for new products</p>
        </div>
    @else
        <div class="row g-4">
            @foreach ($produk as $p)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        
                        {{-- Gambar produk --}}
                        @if($p->image)
                            <img src="{{ asset('storage/produk/' . $p->image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $p->nama }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Image" 
                                 class="card-img-top" 
                                 alt="No Image"
                                 style="height: 200px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <h5 class="card-title fw-bold mb-2">{{ $p->nama }}</h5>
                                <p class="card-text text-muted small mb-0">
                                    {{ $p->deskripsi ?? 'No description available.' }}
                                </p>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <span class="h5 fw-bold text-primary mb-0">
                                        Rp{{ number_format($p->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center">
                                    @if($p->stok > 0)
                                        @if($p->stok <= 5)
                                            <span class="badge bg-warning text-dark">
                                                <i class="bi bi-exclamation-triangle me-1"></i>{{ $p->stok }} left
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i>In Stock ({{ $p->stok }})
                                            </span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-x-circle me-1"></i>Out of Stock
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-auto">
                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <div class="d-grid gap-2 d-md-flex">
                                            <a href="{{ route('produk.edit', $p->id) }}" 
                                               class="btn btn-warning flex-fill">
                                                <i class="bi bi-pencil me-1"></i>Edit
                                            </a>
                                            <form method="POST" action="{{ route('produk.destroy', $p->id) }}" 
                                                  class="flex-fill"
                                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">
                                                    <i class="bi bi-trash me-1"></i>Delete
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div class="d-grid">
                                            <a href="{{ route('produk.buy', $p->id) }}"
                                               class="btn btn-success {{ $p->stok == 0 ? 'disabled' : '' }}">
                                                <i class="bi bi-cart-plus me-1"></i>
                                                {{ $p->stok == 0 ? 'Out of Stock' : 'Add to Cart' }}
                                            </a>
                                        </div>
                                    @endif
                                @else
                                    <div class="d-grid">
                                        <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                            <i class="bi bi-box-arrow-in-right me-1"></i>Login to Purchase
                                        </a>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
