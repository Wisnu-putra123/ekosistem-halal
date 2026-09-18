@extends('layouts.app')

@section('title', 'Kelola User (Admin) - Ekosistem Halal')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-custom p-4">
            <!-- Header section -->
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4 pb-3 border-bottom">
                <div>
                    <h4 class="fw-bold mb-1 text-danger">
                        <i class="bi bi-people-fill me-2"></i> Pengelolaan Data User
                    </h4>
                    <p class="text-muted small mb-0">Kelola pengguna dan ubah role default (<strong>Student</strong>) ke <strong>Teacher</strong> atau <strong>Admin</strong>.</p>
                </div>
                <div>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm px-3">
                        <i class="bi bi-person-plus-fill me-1"></i> Tambah User Baru
                    </a>
                </div>
            </div>

            <!-- Filter & Search Bar -->
            <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3 mb-4">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="role" class="form-select">
                        <option value="">-- Semua Role --</option>
                        <option value="student" {{ request('role') == 'student' ? 'selected' : '' }}>Student (Siswa)</option>
                        <option value="teacher" {{ request('role') == 'teacher' ? 'selected' : '' }}>Teacher (Guru)</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-dark btn-sm px-3">
                        <i class="bi bi-filter me-1"></i> Filter
                    </button>
                    @if(request('search') || request('role'))
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                            <i class="bi bi-x-circle me-1"></i> Reset
                        </a>
                    @endif
                </div>
            </form>

            <!-- Table of Users -->
            <div class="table-responsive">
                <table class="table table-hover align-middle border">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col" style="width: 25%">Nama Lengkap</th>
                            <th scope="col" style="width: 25%">Email</th>
                            <th scope="col" style="width: 15%">Role Saat Ini</th>
                            <th scope="col" style="width: 18%">Ubah Role Cepat</th>
                            <th scope="col" class="text-center" style="width: 12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <div class="fw-bold">{{ $user->name }}</div>
                                    <small class="text-muted">ID: #{{ $user->id }}</small>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge badge-admin px-2 py-1"><i class="bi bi-shield-fill me-1"></i> Admin</span>
                                    @elseif($user->role === 'teacher')
                                        <span class="badge badge-teacher px-2 py-1"><i class="bi bi-person-badge me-1"></i> Teacher</span>
                                    @else
                                        <span class="badge badge-student px-2 py-1"><i class="bi bi-mortarboard me-1"></i> Student</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Quick Role Change Form -->
                                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST" class="d-flex align-items-center gap-1">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="form-select form-select-sm py-1 px-2" onchange="this.form.submit()">
                                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                            <option value="teacher" {{ $user->role === 'teacher' ? 'selected' : '' }}>Teacher</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-warning btn-sm py-1 px-2" title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @if(Auth::id() !== $user->id)
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna {{ $user->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm py-1 px-2" title="Hapus User">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm py-1 px-2" disabled title="Anda tidak dapat menghapus akun sendiri">
                                                <i class="bi bi-lock"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                    Tidak ada data pengguna yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="small text-muted">
                    Menampilkan {{ $users->firstItem() ?? 0 }} hingga {{ $users->lastItem() ?? 0 }} dari total {{ $users->total() }} user
                </div>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
