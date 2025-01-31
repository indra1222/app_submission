@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Header Section -->
    <div class="bg-gradient-primary text-white position-relative overflow-hidden py-4 px-4 mb-4">
        <div class="position-absolute top-0 end-0 opacity-10">
            <svg width="450" height="400" viewBox="0 0 200 200">
                <path fill="currentColor" d="M45,-78.1C58.3,-71.2,69.1,-57.7,73.3,-42.7C77.5,-27.7,75.1,-11.2,73.7,5.3C72.3,21.8,71.9,38.2,64.4,50.8C56.9,63.4,42.4,72.1,26.9,75.7C11.4,79.2,-5.1,77.6,-20.2,72.5C-35.3,67.4,-49,58.8,-57.7,46.7C-66.4,34.7,-70.1,19.1,-70.9,3.8C-71.7,-11.5,-69.5,-26.5,-62.3,-38.7C-55,-50.9,-42.7,-60.3,-29.7,-67.5C-16.7,-74.7,-3.1,-79.7,10.9,-79.7C24.8,-79.7,31.7,-85,45,-78.1Z" transform="translate(100 100)" />
            </svg>
        </div>
        
        <div class="row align-items-center position-relative">
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="bps-logo-wrapper me-4">
                        <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="bps-logo">
                    </div>
                    <div class="border-start border-white border-opacity-25 ps-4">
                        <h4 class="fw-bold mb-1">Dashboard Admin</h4>
                        <p class="mb-0 opacity-75">Sistem Informasi Form</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-lg-end mt-3 mt-lg-0">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light btn-sm me-2 rounded-pill shadow-sm hover-lift">
                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                </a>
                <a href="{{ route('admin.submissions.index') }}" class="btn btn-light btn-sm me-2 rounded-pill shadow-sm hover-lift">
                    <i class="fas fa-list me-1"></i> Submissions
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm rounded-pill shadow-sm hover-lift">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card border0 bg-gradient-purple text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Total Users</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['total_users'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-users fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border0 bg-gradient-blue text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Pending</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['pending_submissions'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 bg-gradient-green text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Approved</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['approved_submissions'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card border-0 bg-gradient-blue text-white rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2 opacity-75">Total Submissions</p>
                                <h3 class="mb-0 fw-bold">{{ $stats['total_submissions'] }}</h3>
                            </div>
                            <div class="icon-box rounded-circle">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Surat Stats -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <a href="{{ route('admin.surat-keluar') }}" class="text-decoration-none">
                    <div class="card border-0 bg-gradient-indigo text-white rounded-4 shadow-hover transform-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-2 opacity-75">Surat Keluar (Form 1)</p>
                                    <h3 class="mb-0 fw-bold">{{ $stats['surat_keluar'] }}</h3>
                                </div>
                                <div class="icon-box rounded-circle">
                                    <i class="fas fa-paper-plane fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <a href="{{ route('admin.surat-masuk') }}" class="text-decoration-none">
                    <div class="card border-0 bg-gradient-cyan text-white rounded-4 shadow-hover transform-hover">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-2 opacity-75">Surat Masuk (Form 2 & 3)</p>
                                    <h3 class="mb-0 fw-bold">{{ $stats['surat_masuk'] }}</h3>
                                </div>
                                <div class="icon-box rounded-circle">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-0 rounded-4 shadow">
            <div class="card-header bg-white border-0 py-4">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-bolt me-2 text-primary"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="{{ route('admin.submissions.index') }}" class="btn btn-primary w-100 rounded-pill py-3 shadow-sm hover-lift">
                            <i class="fas fa-list me-2"></i> Manage Submissions
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success w-100 rounded-pill py-3 shadow-sm hover-lift" disabled>
                            <i class="fas fa-user-plus me-2"></i> Add New User
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-info w-100 rounded-pill py-3 shadow-sm hover-lift text-white" disabled>
                            <i class="fas fa-cog me-2"></i> Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.bg-gradient-purple {
    background: linear-gradient(45deg, #6a11cb, #2575fc);
}

.bg-gradient-orange {
    background: linear-gradient(45deg, #ff9a9e, #fad0c4);
}

.bg-gradient-green {
    background: linear-gradient(45deg, #00b09b, #96c93d);
}

.bg-gradient-blue {
    background: linear-gradient(45deg, #4facfe, #00f2fe);
}

.bg-gradient-indigo {
    background: linear-gradient(45deg, #6366f1, #a855f7);
}

.bg-gradient-cyan {
    background: linear-gradient(45deg, #0ea5e9, #22d3ee);
}

.bps-logo {
    height: 48px;
    width: auto;
}

.bps-logo-wrapper {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem;
    border-radius: 0.75rem;
    backdrop-filter: blur(10px);
}

.icon-box {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.shadow-hover {
    transition: all 0.3s ease;
}

.shadow-hover:hover {
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.transform-hover {
    transition: transform 0.3s ease;
}

.transform-hover:hover {
    transform: translateY(-5px);
}

.hover-lift {
    transition: transform 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-2px);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.card {
    overflow: hidden;
}
</style>
@endsection