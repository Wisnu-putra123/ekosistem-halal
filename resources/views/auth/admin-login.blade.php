@extends('layouts.app')

@section('title', 'Login Administrator - Ekosistem Halal')

@section('content')
<div class="row justify-content-center my-4">
    <div class="col-md-5">
        <div class="card card-custom border-top border-4 border-danger p-4">
            <div class="text-center mb-4">
                <div class="mb-2">
                    <span class="p-3 bg-danger bg-opacity-10 text-danger rounded-circle d-inline-block">
                        <i class="bi bi-shield-lock-fill fs-2"></i>
                    </span>
                </div>
                <h4 class="fw-bold mb-1 text-danger">Portal Login Admin</h4>
                <p class="text-muted small">Halaman masuk khusus untuk Administrator Sistem</p>
            </div>

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label font-medium">Email Administrator</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope-check text-danger"></i></span>
                        <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="admin@halal.com" required autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label font-medium">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-danger"></i></span>
                        <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label text-muted small" for="remember">
                        Ingat sesi admin di komputer ini
                    </label>
                </div>

                <button type="submit" class="btn btn-admin w-100 py-2 mb-3">
                    <i class="bi bi-shield-lock me-1"></i> Masuk Administrator
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-decoration-none small text-muted">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Login Pengguna Umum
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
