@extends('app')

@section('title', 'Add Product')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0 fw-bold text-dark">Add New Product</h4>
                            <p class="text-muted mb-0">Fill in the product details below</p>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                <strong>Please fix the following errors:</strong>
                            </div>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produk.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-medium">Product Name</label>
                            <input type="text" 
                                   name="nama" 
                                   class="form-control form-control-lg" 
                                   id="nama" 
                                   value="{{ old('nama') }}" 
                                   placeholder="Enter product name"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-medium">Description</label>
                            <textarea name="deskripsi" 
                                      class="form-control" 
                                      id="deskripsi" 
                                      rows="4" 
                                      placeholder="Describe your product (optional)">{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="harga" class="form-label fw-medium">Price</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light">Rp</span>
                                    <input type="number" 
                                           name="harga" 
                                           class="form-control" 
                                           id="harga" 
                                           value="{{ old('harga') }}" 
                                           placeholder="0"
                                           min="0"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="stok" class="form-label fw-medium">Stock</label>
                                <input type="number" 
                                       name="stok" 
                                       class="form-control form-control-lg" 
                                       id="stok" 
                                       value="{{ old('stok') }}" 
                                       placeholder="0"
                                       min="0"
                                       required>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection