@extends('app')

@section('title', 'Login')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0 fw-bold text-dark">🔐 Login</h4>
                    <p class="text-muted mb-0">Masuk ke akun Anda</p>
                </div>

                <div class="card-body p-4">
                    @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" 
                                   name="email" 
                                   id="email"
                                   class="form-control form-control-lg"
                                   value="{{ old('email') }}" 
                                   placeholder="Masukkan email"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">Password</label>
                            <input type="password" 
                                   name="password" 
                                   id="password"
                                   class="form-control form-control-lg"
                                   placeholder="Masukkan password"
                                   required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('register') }}">Belum punya akun? <strong>Daftar</strong></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
