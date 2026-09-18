@extends('layouts.app')

@section('title', 'Registrasi Pengguna Baru - Ekosistem Halal')

@section('content')
<div class="row justify-content-center my-4">
    <div class="col-md-6">
        <div class="card card-custom p-4">
            <div class="text-center mb-4">
                <div class="mb-2">
                    <span class="p-3 bg-success bg-opacity-10 text-success rounded-circle d-inline-block">
                        <i class="bi bi-person-plus-fill fs-2"></i>
                    </span>
                </div>
                <h4 class="fw-bold mb-1">Daftar Akun Baru</h4>
                <p class="text-muted small">Registrasi untuk mulai menggunakan aplikasi (Role default: <strong>Student</strong>)</p>
            </div>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label font-medium">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                        <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                    </div>
                    @error('name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label font-medium">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label font-medium">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                        <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label font-medium">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-check text-muted"></i></span>
                        <input type="password" class="form-control border-start-0" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
                    </div>
                </div>

                <div class="alert alert-info py-2 small d-flex align-items-center mb-4">
                    <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                    <div>Setelah registrasi selesai, akun Anda akan otomatis aktif &amp; Anda langsung otomatis masuk.</div>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                    <i class="bi bi-check-circle me-1"></i> Daftar Sekarang
                </button>

                <div class="text-center">
                    <p class="small text-muted mb-0">
                        Sudah memiliki akun? <a href="{{ route('login') }}" class="text-primary fw-semibold text-decoration-none">Login ke Akun Anda</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
