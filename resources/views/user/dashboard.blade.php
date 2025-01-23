@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card shadow">
                <div class="card-header bg-primary bg-gradient text-white p-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-home fa-2x me-3"></i>
                        <div>
                            <h4 class="mb-0">Dashboard User</h4>
                            <small>Selamat datang, {{ Auth::user()->name }}!</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Service Cards -->
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                                <div class="card-body text-center p-4">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-file-alt fa-3x text-primary"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Form Pengajuan Surat</h5>
                                    <p class="card-text text-muted">Ajukan surat-menyurat resmi untuk berbagai keperluan
                                    </p>
                                    <a href="{{ route('submissions.createForm1') }}" class="btn btn-primary w-100">
                                        <i class="fas fa-plus me-2"></i>Buat Pengajuan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                                <div class="card-body text-center p-4">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-id-card fa-3x text-success"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Form KTP</h5>
                                    <p class="card-text text-muted">Ajukan permohonan pembuatan atau perpanjangan KTP
                                    </p>
                                    <a href="{{ route('submissions.createForm2') }}" class="btn btn-success w-100">
                                        <i class="fas fa-plus me-2"></i>Buat Permohonan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card h-100 shadow-sm border-0 hover-shadow transition">
                                <div class="card-body text-center p-4">
                                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                        <i class="fas fa-exclamation-triangle fa-3x text-danger"></i>
                                    </div>
                                    <h5 class="card-title fw-bold">Form Pengaduan</h5>
                                    <p class="card-text text-muted">Sampaikan pengaduan atau keluhan Anda</p>
                                    <a href="{{ route('submissions.createForm3') }}" class="btn btn-danger w-100">
                                        <i class="fas fa-plus me-2"></i>Buat Pengaduan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submission History -->
                    <div class="mt-4">
                        <h5 class="mb-4">
                            <i class="fas fa-history me-2"></i>
                            <span class="border-bottom border-2 border-primary pb-1">Riwayat Pengajuan</span>
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3">No</th>
                                        <th class="py-3">Jenis Form</th>
                                        <th class="py-3">Nama</th>
                                        <th class="py-3">Alamat</th>
                                        <th class="py-3">Tujuan</th>
                                        <th class="py-3">Tanggal</th>
                                        <th class="py-3">Status</th>
                                        <th class="py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->submissions()->latest()->take(5)->get() as $submission)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($submission->jenis_form == 'form1')
                                            <span class="badge bg-primary rounded-pill px-3">Pengajuan Surat</span>
                                            @elseif($submission->jenis_form == 'form2')
                                            <span class="badge bg-success rounded-pill px-3">Permohonan KTP</span>
                                            @else
                                            <span class="badge bg-danger rounded-pill px-3">Pengaduan</span>
                                            @endif
                                        </td>
                                        <td>{{ $submission->nama }}</td>
                                        <td>{{ $submission->alamat }}</td>
                                        <td>{{ $submission->tujuan }}</td>
                                        <td>{{ $submission->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if($submission->status == 'pending')
                                            <span class="badge bg-warning text-dark rounded-pill px-3">Pending</span>
                                            @elseif($submission->status == 'approved')
                                            <span class="badge bg-success rounded-pill px-3">Approved</span>
                                            @else
                                            <span class="badge bg-danger rounded-pill px-3">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-info text-white rounded-pill px-3"
                                                data-bs-toggle="modal" data-bs-target="#detail-{{ $submission->id }}">
                                                <i class="fas fa-eye me-1"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p class="mb-0">Belum ada pengajuan</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this to your CSS -->
<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
}

.transition {
    transition: all 0.3s ease;
}

.table> :not(caption)>*>* {
    padding: 1rem 0.75rem;
}

.badge {
    font-weight: 500;
}
</style>
@endsection