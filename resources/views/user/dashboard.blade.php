@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section -->
    <div class="bg-gradient-primary text-white position-relative overflow-hidden py-5 px-4">
        <div class="position-absolute top-0 end-0 opacity-10">
            <svg width="450" height="400" viewBox="0 0 200 200">
                <path fill="currentColor" d="M45,-78.1C58.3,-71.2,69.1,-57.7,73.3,-42.7C77.5,-27.7,75.1,-11.2,73.7,5.3C72.3,21.8,71.9,38.2,64.4,50.8C56.9,63.4,42.4,72.1,26.9,75.7C11.4,79.2,-5.1,77.6,-20.2,72.5C-35.3,67.4,-49,58.8,-57.7,46.7C-66.4,34.7,-70.1,19.1,-70.9,3.8C-71.7,-11.5,-69.5,-26.5,-62.3,-38.7C-55,-50.9,-42.7,-60.3,-29.7,-67.5C-16.7,-74.7,-3.1,-79.7,10.9,-79.7C24.8,-79.7,31.7,-85,45,-78.1Z" transform="translate(100 100)" />
            </svg>
        </div>
        
        <div class="row align-items-center position-relative">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4">
                    <div class="bps-logo-wrapper me-4">
                        <img src="{{ asset('images/logo-bps.png') }}" alt="Logo BPS" class="bps-logo">
                    </div>
                    <div class="border-start border-white border-opacity-25 ps-4">
                        <h2 class="display-6 fw-bold mb-1">Selamat datang kembali!</h2>
                        <p class="lead mb-0 opacity-75">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-lg-end">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-lg rounded-pill px-4 shadow-sm hover-lift">
                        <i class="fas fa-sign-out-alt me-2"></i>Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid px-4 py-5">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Form Pengajuan Surat</h4>
                        <p class="text-muted mb-4">Ajukan dokumen resmi dengan mudah dan cepat melalui sistem kami.</p>
                        <a href="{{ route('submissions.createForm1') }}" class="btn btn-primary rounded-pill w-100 py-3">
                            <i class="fas fa-plus me-2"></i>Buat Pengajuan
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-id-card fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Permohonan SPPD</h4>
                        <p class="text-muted mb-4">Proses pengajuan perjalanan dinas yang efisien dan terorganisir.</p>
                        <a href="{{ route('submissions.createForm2') }}" class="btn btn-success rounded-pill w-100 py-3">
                            <i class="fas fa-plus me-2"></i>Buat Permohonan
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 rounded-4 shadow-hover transform-hover">
                    <div class="card-body p-4">
                        <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle p-3 mb-4 d-inline-block">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-3">Form Kuitansi</h4>
                        <p class="text-muted mb-4">Kelola dan ajukan bukti pembayaran dengan sistem yang terintegrasi.</p>
                        <a href="{{ route('submissions.createForm3') }}" class="btn btn-danger rounded-pill w-100 py-3">
                            <i class="fas fa-plus me-2"></i>Buat Kuitansi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Submissions -->
        <div class="card border-0 rounded-4 shadow">
            <div class="card-header bg-transparent border-0 p-4">
                <h4 class="fw-bold mb-0">
                    <i class="fas fa-history me-2 text-primary"></i>Riwayat Pengajuan Terakhir
                </h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th class="rounded-start">No</th>
                                <th>Jenis Form</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Tujuan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="rounded-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(Auth::user()->submissions()->latest()->take(5)->get() as $submission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary rounded-pill">
                                        {{ ucfirst($submission->jenis_form) }}
                                    </span>
                                </td>
                                <td>{{ $submission->nama }}</td>
                                <td>{{ $submission->alamat }}</td>
                                <td>{{ $submission->tujuan }}</td>
                                <td>{{ $submission->created_at->format('d M Y') }}</td>
                                <td>
                                    @php
                                        $statusClass = match($submission->status) {
                                            'approved' => 'success',
                                            'pending' => 'warning',
                                            default => 'danger'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($submission->status == 'approved')
                                        <a href="{{ route('submissions.pdf', $submission->id) }}" 
                                           class="btn btn-sm btn-primary rounded-pill px-3">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    @else
                                        <button class="btn btn-sm btn-secondary rounded-pill px-3"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detail-{{ $submission->id }}">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada pengajuan</h5>
                                        <p class="text-muted small">Mulai dengan membuat pengajuan baru</p>
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

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.bps-logo {
    height: 64px;
    width: auto;
}

.bps-logo-wrapper {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 1rem;
    backdrop-filter: blur(10px);
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

.icon-box {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.table thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 1rem;
}

.badge {
    font-weight: 600;
    padding: 0.5rem 1rem;
}

.empty-state {
    padding: 2rem;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.02);
}

.rounded-4 {
    border-radius: 1rem !important;
}
</style>
@endsection