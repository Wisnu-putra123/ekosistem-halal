<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ekosistem Halal LMS')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .card-custom {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
        }

        .badge-student {
            background-color: #e0f2fe;
            color: #0369a1;
            font-weight: 600;
        }

        .badge-teacher {
            background-color: #fef3c7;
            color: #b45309;
            font-weight: 600;
        }

        .badge-admin {
            background-color: #fee2e2;
            color: #b91c1c;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.6rem 1.25rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }

        .btn-admin {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
        }

        .btn-admin:hover {
            background: linear-gradient(135deg, #b91c1c, #991b1b);
            color: #fff;
        }

        .footer {
            margin-top: auto;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
        }
    </style>
</head>
<body>

    <!-- Navbar Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <i class="bi bi-patch-check-fill text-success fs-4"></i>
                <span>Ekosistem Halal</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i> Home
                        </a>
                    </li>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active fw-bold text-warning' : 'text-warning' }}" href="{{ route('admin.users.index') }}">
                                    <i class="bi bi-shield-lock me-1"></i> Kelola User (Admin)
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle fs-5"></i>
                                <span>{{ Auth::user()->name }}</span>
                                @if(Auth::user()->role === 'admin')
                                    <span class="badge badge-admin px-2 py-1">Admin</span>
                                @elseif(Auth::user()->role === 'teacher')
                                    <span class="badge badge-teacher px-2 py-1">Teacher</span>
                                @else
                                    <span class="badge badge-student px-2 py-1">Student</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li>
                                    <div class="dropdown-header">
                                        <small class="text-muted">Signed in as</small><br>
                                        <strong>{{ Auth::user()->email }}</strong>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item {{ request()->routeIs('profile.*') ? 'active fw-bold' : '' }}" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-gear me-2"></i> Pengaturan Profil
                                    </a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('admin.users.index') }}">
                                            <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                                        </a>
                                    </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i> Keluar (Logout)
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-light btn-sm me-1 px-3" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm me-1 px-3" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i> Daftar
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-outline-warning btn-sm px-3" href="{{ route('admin.login') }}">
                                <i class="bi bi-shield-lock-fill me-1"></i> Login Admin
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="py-4">
        <div class="container">
            <!-- Flash Notification Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer py-3 text-center text-muted">
        <div class="container">
            <small>&copy; {{ date('Y') }} Ekosistem Halal LMS - Sistem Manajemen Autentikasi & Pengguna.</small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
