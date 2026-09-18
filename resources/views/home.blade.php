@extends('layouts.app')

@section('title', 'Beranda - Ekosistem Halal')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-custom p-4 mb-4 bg-white">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 pb-3 border-bottom">
                <div>
                    <h3 class="fw-bold mb-1">Selamat Datang di Ekosistem Halal!</h3>
                    <p class="text-muted mb-0">Platform Pembelajaran & Manajemen Ekosistem Halal</p>
                </div>
                <div>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <span class="badge badge-admin fs-6 px-3 py-2"><i class="bi bi-shield-fill-check me-1"></i> Role: Admin</span>
                        @elseif(Auth::user()->role === 'teacher')
                            <span class="badge badge-teacher fs-6 px-3 py-2"><i class="bi bi-person-badge-fill me-1"></i> Role: Teacher (Guru)</span>
                        @else
                            <span class="badge badge-student fs-6 px-3 py-2"><i class="bi bi-mortarboard-fill me-1"></i> Role: Student (Siswa)</span>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="mt-4">
                @auth
                    <div class="alert alert-light border d-flex align-items-center justify-content-between flex-wrap gap-3 p-3 rounded-3 mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-person-circle fs-1 text-primary"></i>
                            <div>
                                <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                                <div class="text-muted small">Email: <strong>{{ Auth::user()->email }}</strong> | Terdaftar sejak: {{ Auth::user()->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm px-3">
                            <i class="bi bi-person-gear me-1"></i> Edit Profil & Password
                        </a>
                    </div>

                    @if(Auth::user()->isAdmin())
                        <div class="p-4 bg-danger bg-opacity-10 border border-danger border-opacity-25 rounded-3 mb-4">
                            <h5 class="fw-bold text-danger"><i class="bi bi-shield-lock me-2"></i>Akses Administrator Dideteksi</h5>
                            <p class="mb-3 text-muted">Anda masuk sebagai Admin. Anda dapat mengelola data seluruh pengguna dan mengubah role siswa ke guru di Panel Admin.</p>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger">
                                <i class="bi bi-speedometer2 me-1"></i> Buka Panel Pengelolaan User Admin
                            </a>
                        </div>
                    @elseif(Auth::user()->isTeacher())
                        <div class="p-4 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-3 mb-4">
                            <h5 class="fw-bold text-dark"><i class="bi bi-person-video3 me-2"></i>Status Pengajar (Teacher)</h5>
                            <p class="mb-0 text-muted">Akun Anda telah di-upgrade menjadi Pengajar/Guru. Anda dapat membuat materi dan mengajar di ekosistem halal LMS.</p>
                        </div>
                    @else
                        <div class="p-4 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-3 mb-4">
                            <h5 class="fw-bold text-primary"><i class="bi bi-book me-2"></i>Status Pelajar (Student)</h5>
                            <p class="mb-0 text-muted">Role Anda secara default adalah <strong>Student</strong>. Jika Anda memerlukan hak akses Pengajar (Teacher), silakan hubungi Administrator untuk mengubah role Anda.</p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-box-arrow-in-right text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3 fw-bold">Anda Belum Masuk</h4>
                        <p class="text-muted">Silakan registrasi atau masuk terlebih dahulu untuk mengakses fitur lengkap.</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary px-4 py-2">Login Pengguna</a>
                            <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2">Daftar Akun Baru</a>
                            <a href="{{ route('admin.login') }}" class="btn btn-outline-danger px-4 py-2">Login Admin</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
