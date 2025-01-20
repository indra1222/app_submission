@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin
                    </h3>
                    <span class="badge bg-light text-dark">{{ date('d M Y') }}</span>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title text-muted">Total Users</h5>
                                        <h2 class="text-primary">{{ $stats['total_users'] }}</h2>
                                    </div>
                                    <i class="fas fa-users fa-2x text-primary opacity-50"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title text-muted">Total Submissions</h5>
                                        <h2 class="text-success">{{ $stats['total_submissions'] }}</h2>
                                    </div>
                                    <i class="fas fa-file-alt fa-2x text-success opacity-50"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title text-muted">Pending</h5>
                                        <h2 class="text-warning">{{ $stats['pending_submissions'] }}</h2>
                                    </div>
                                    <i class="fas fa-hourglass-half fa-2x text-warning opacity-50"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title text-muted">Approved</h5>
                                        <h2 class="text-info">{{ $stats['approved_submissions'] }}</h2>
                                    </div>
                                    <i class="fas fa-check-circle fa-2x text-info opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-light">
                                    <h4 class="mb-0">
                                        <i class="fas fa-tasks me-2"></i>Menu Admin
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <a href="{{ route('admin.submissions.index') }}" class="btn btn-outline-primary w-100">
                                                <i class="fas fa-list-ul me-2"></i>Kelola Submissions
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <a href="#" class="btn btn-outline-success w-100">
                                                <i class="fas fa-users-cog me-2"></i>Manajemen User
                                            </a>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <a href="#" class="btn btn-outline-info w-100">
                                                <i class="fas fa-chart-bar me-2"></i>Laporan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection