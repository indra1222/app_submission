<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    .navbar {
        padding: 1rem 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
    }

    .navbar-brand {
        font-weight: 600;
        font-size: 1.25rem;
    }

    .nav-link {
        position: relative;
        padding: 0.5rem 1rem !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        color: #fff !important;
        transform: translateY(-2px);
    }

    .nav-link.active {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: #fff;
        transition: all 0.3s ease;
    }

    .nav-link:hover::after {
        width: 80%;
        left: 10%;
    }

    .user-profile {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        margin-left: 1rem;
    }

    .user-profile img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 0.5rem;
    }

    .alert {
        border-radius: 10px;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, .05);
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, .1);
        border-radius: 8px;
    }

    .dropdown-item {
        padding: 0.7rem 1.5rem;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-paper-plane me-2"></i>Sistem Form
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    @else
                    @if(auth()->user()->isAdmin())
                    <!-- Admin Navigation -->
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="user-profile dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile">
                            <span class="text-white">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-cog me-2"></i>Settings
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <!-- User Navigation -->
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('user/dashboard') ? 'active' : '' }}"
                            href="{{ route('user.dashboard') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('*/form1') ? 'active' : '' }}"
                            href="{{ route('submissions.createForm1') }}">
                            <i class="fas fa-file-alt me-1"></i>Pengajuan Surat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('*/form2') ? 'active' : '' }}"
                            href="{{ route('submissions.createForm2') }}">
                            <i class="fas fa-id-card me-1"></i>Pengajuan KTP
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('*/form3') ? 'active' : '' }}"
                            href="{{ route('submissions.createForm3') }}">
                            <i class="fas fa-exclamation-triangle me-1"></i>Pengaduan
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="user-profile dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Profile">
                            <span class="text-white">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user me-2"></i>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-history me-2"></i>Riwayat
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>