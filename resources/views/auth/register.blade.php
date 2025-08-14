@extends('app')

@section('title', 'Register')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0 fw-bold text-dark">📝 Daftar Akun</h4>
                    <p class="text-muted mb-0">Buat akun baru untuk mulai berbelanja</p>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                <strong>Periksa kembali form Anda:</strong>
                            </div>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-medium">Nama</label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   class="form-control form-control-lg"
                                   value="{{ old('name') }}" 
                                   placeholder="Masukkan nama"
                                   required>
                        </div>

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

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-medium">Konfirmasi Password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation"
                                   class="form-control form-control-lg"
                                   placeholder="Ulangi password"
                                   required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-person-plus me-1"></i>Daftar
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('login') }}">Sudah punya akun? <strong>Login</strong></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
