@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Menu Bar -->
    <div class="mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-paper-plane me-2"></i> Sistem Form
                </div>
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm me-2">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard Admin
                    </a>
                    <a href="{{ route('admin.submissions.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-list me-1"></i> Kelola Submissions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Users</h6>
                            <h2 class="mb-0">{{ $stats['total_users'] }}</h2>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Submissions</h6>
                            <h2 class="mb-0">{{ $stats['total_submissions'] }}</h2>
                        </div>
                        <i class="fas fa-file-alt fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Pending</h6>
                            <h2 class="mb-0">{{ $stats['pending_submissions'] }}</h2>
                        </div>
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Approved</h6>
                            <h2 class="mb-0">{{ $stats['approved_submissions'] }}</h2>
                        </div>
                        <i class="fas fa-check-circle fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('admin.submissions.index') }}" class="btn btn-primary w-100">
                        <i class="fas fa-list me-2"></i>Manage Submissions
                    </a>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-success w-100" disabled>
                        <i class="fas fa-user-plus me-2"></i>Add New User
                    </button>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-info w-100" disabled>
                        <i class="fas fa-cog me-2"></i>Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection