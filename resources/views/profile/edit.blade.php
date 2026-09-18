@extends('layouts.app')

@section('title', 'Pengaturan Profil - Ekosistem Halal')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bi bi-person-gear text-primary me-2"></i>Pengaturan Profil
                </h3>
                <p class="text-muted mb-0">Kelola informasi akun dan perbarui kata sandi Anda.</p>
            </div>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>

        <div class="row g-4">
            <!-- Card 1: Informasi Pengguna -->
            <div class="col-md-6">
                <div class="card card-custom h-100 bg-white">
                    <div class="card-header bg-transparent border-bottom pt-4 pb-3 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-vcard fs-4 text-primary"></i>
                            <h5 class="fw-bold mb-0">Informasi Pengguna</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <!-- User Badging Summary -->
                        <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-flex align-items-center justify-content-center" style="width: 54px; height: 54px;">
                                <i class="bi bi-person-fill fs-3"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
                                <div class="mb-1">
                                    @if($user->isAdmin())
                                        <span class="badge badge-admin px-2 py-1"><i class="bi bi-shield-check me-1"></i>Administrator</span>
                                    @elseif($user->isTeacher())
                                        <span class="badge badge-teacher px-2 py-1"><i class="bi bi-person-badge me-1"></i>Teacher (Pengajar)</span>
                                    @else
                                        <span class="badge badge-student px-2 py-1"><i class="bi bi-mortarboard me-1"></i>Student (Siswa)</span>
                                    @endif
                                </div>
                                <small class="text-muted"><i class="bi bi-calendar-event me-1"></i>Terdaftar sejak {{ $user->created_at->format('d M Y') }}</small>
                            </div>
                        </div>

                        <!-- Form Profile Update -->
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-check-lg me-1"></i> Simpan Perubahan Profil
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Card 2: Ubah Kata Sandi -->
            <div class="col-md-6">
                <div class="card card-custom h-100 bg-white">
                    <div class="card-header bg-transparent border-bottom pt-4 pb-3 px-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-key-fill fs-4 text-warning"></i>
                            <h5 class="fw-bold mb-0">Ubah Kata Sandi</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted small mb-4">
                            Untuk keamanan akun Anda, pastikan menggunakan kata sandi minimal 8 karakter dengan kombinasi huruf dan angka.
                        </p>

                        <!-- Form Password Update -->
                        <form action="{{ route('profile.updatePassword') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">Kata Sandi Saat Ini <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Masukkan kata sandi saat ini" required>
                                </div>
                                @error('current_password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Kata Sandi Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-shield-lock"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi Baru <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-shield-check"></i></span>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi baru" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-warning text-dark fw-semibold px-4">
                                    <i class="bi bi-shield-lock me-1"></i> Update Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
