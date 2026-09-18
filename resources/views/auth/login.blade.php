@extends('layouts.app')

@section('title', 'Login - Ekosistem Halal')

@section('content')
<div class="row justify-content-center my-4">
    <div class="col-md-5">
        <div class="card card-custom p-4">
            <div class="text-center mb-4">
                <div class="mb-2">
                    <span class="p-3 bg-primary bg-opacity-10 text-primary rounded-circle d-inline-block">
                        <i class="bi bi-box-arrow-in-right fs-2"></i>
                    </span>
                </div>
                <h4 class="fw-bold mb-1">Masuk ke Akun Anda</h4>
                <p class="text-muted small">Silakan masukkan email dan kata sandi Anda</p>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label font-medium">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label font-medium">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-muted small" for="remember">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                </button>

                <div class="text-center">
                    <p class="small text-muted mb-2">
                        Belum memiliki akun? <a href="{{ route('register') }}" class="text-primary fw-semibold text-decoration-none">Daftar Akun Baru</a>
                    </p>
                    <hr class="my-3">
                    <a href="{{ route('admin.login') }}" class="btn btn-outline-danger btn-sm w-100">
                        <i class="bi bi-shield-lock-fill me-1"></i> Login Khusus Administrator
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
