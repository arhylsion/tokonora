@extends('app')

@section('title', 'My Purchases')

@section('content')
<div class="container mt-4">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h2 class="fw-bold text-dark mb-0">Purchase History</h2>
            <p class="text-muted mb-0">Track your orders and purchase history</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    @if ($purchases->isEmpty())
        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-bag-x" style="font-size: 4rem; color: #dee2e6;"></i>
            </div>
            <h4 class="text-muted mb-3">No purchases yet</h4>
            <p class="text-muted mb-4">Start shopping to see your purchase history here</p>
            <a href="{{ route('produk.index') }}" class="btn btn-primary">
                <i class="bi bi-shop me-1"></i>Browse Products
            </a>
        </div>
    @else
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="px-4 py-3">#</th>
                                <th class="py-3">Product</th>
                                <th class="py-3">Unit Price</th>
                                <th class="py-3 text-center">Qty</th>
                                <th class="py-3 text-end">Total</th>
                                <th class="py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalAmount = 0; @endphp
                            @foreach ($purchases as $index => $purchase)
                                @php 
                                    $itemTotal = $purchase->produk->harga * $purchase->quantity;
                                    $totalAmount += $itemTotal;
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 fw-medium">{{ $index + 1 }}</td>
                                    <td class="py-3">
                                        <div>
                                            <div class="fw-medium text-dark">{{ $purchase->produk->nama }}</div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-muted">Rp{{ number_format($purchase->produk->harga, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge bg-light text-dark border">{{ $purchase->quantity }}</span>
                                    </td>
                                    <td class="py-3 text-end">
                                        <span class="fw-bold text-success">
                                            Rp{{ number_format($itemTotal, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-3">
                                        <div class="text-muted small">
                                            <div>{{ $purchase->created_at->format('M d, Y') }}</div>
                                            <div>{{ $purchase->created_at->format('H:i') }}</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="px-4 py-3 fw-bold text-end">Total Spent:</td>
                                <td class="py-3 text-end">
                                    <span class="fw-bold text-primary h5 mb-0">
                                        Rp{{ number_format($totalAmount, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="py-3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('produk.index') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-1"></i>Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection