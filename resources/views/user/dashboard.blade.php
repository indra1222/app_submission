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
                                    @switch($submission->jenis_form)
                                        @case('form1')
                                            <span class="badge bg-primary-subtle text-primary rounded-pill">Surat Tugas</span>
                                            @break
                                        @case('form2')
                                            <span class="badge bg-success-subtle text-success rounded-pill">SPPD</span>
                                            @break
                                        @default
                                            <span class="badge bg-danger-subtle text-danger rounded-pill">Kuitansi</span>
                                    @endswitch
                                </td>
                                <td>{{ $submission->nama }}</td>
                                <td>{{ Str::limit($submission->alamat, 30) }}</td>
                                <td>{{ Str::limit($submission->tujuan, 30) }}</td>
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
                                        @if($submission->admin_document_path)
                                            <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
                                            class="btn btn-sm btn-success rounded-pill px-3"
                                            target="_blank">
                                                <i class="fas fa-download me-1"></i>Download Balasan
                                            </a>
                                        @elseif($submission->document_path || $submission->jenis_form == 'form1')
                                            <a href="{{ route('submissions.pdf', $submission->id) }}" 
                                            class="btn btn-sm btn-primary rounded-pill px-3">
                                                <i class="fas fa-download me-1"></i>Download
                                            </a>
                                        @endif
                                    @else
                                        <button class="btn btn-sm btn-secondary rounded-pill px-3"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detail-{{ $submission->id }}">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <!-- Detail Modal -->
                            <div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-4 border-0">
                                        <div class="modal-header bg-gradient-primary text-white">
                                            <h5 class="modal-title">Detail Pengajuan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body p-4">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-4">Status</dt>
                                                <dd class="col-sm-8">
                                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                                        {{ ucfirst($submission->status) }}
                                                    </span>
                                                </dd>

                                                <dt class="col-sm-4">Jenis Form</dt>
                                                <dd class="col-sm-8">
                                                    @switch($submission->jenis_form)
                                                        @case('form1')
                                                            Surat Tugas
                                                            @break
                                                        @case('form2')
                                                            SPPD
                                                            @break
                                                        @default
                                                            Kuitansi
                                                    @endswitch
                                                </dd>

                                                <dt class="col-sm-4">Tanggal</dt>
                                                <dd class="col-sm-8">{{ $submission->created_at->format('d M Y H:i') }}</dd>

                                                <dt class="col-sm-4">Nama</dt>
                                                <dd class="col-sm-8">{{ $submission->nama }}</dd>

                                                <dt class="col-sm-4">Alamat</dt>
                                                <dd class="col-sm-8">{{ $submission->alamat }}</dd>

                                                <dt class="col-sm-4">Tujuan</dt>
                                                <dd class="col-sm-8">{{ $submission->tujuan }}</dd>

                                                @if($submission->jenis_form == 'form3')
                                                    <dt class="col-sm-4">Dokumen</dt>
                                                    <dd class="col-sm-8">
                                                        @if($submission->document_path)
                                                            <a href="{{ Storage::url('documents/'.$submission->document_path) }}" 
                                                               class="btn btn-sm btn-outline-primary rounded-pill"
                                                               target="_blank">
                                                                <i class="fas fa-file-pdf me-1"></i>Lihat Dokumen
                                                            </a>
                                                        @endif
                                                        @if($submission->admin_document_path)
                                                            <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
                                                               class="btn btn-sm btn-outline-success rounded-pill mt-2 d-block"
                                                               target="_blank">
                                                                <i class="fas fa-file-pdf me-1"></i>Lihat Balasan
                                                            </a>
                                                        @endif
                                                    </dd>
                                                @endif
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<style>
/* ... style sebelumnya ... */

.badge {
    font-weight: 600;
    padding: 0.5rem 1rem;
}

.empty-state {
    padding: 2rem;
    text-align: center;
}

.empty-state i {
    display: block;
    margin-bottom: 1rem;
}

.table-hover tbody tr {
    transition: all 0.2s ease;
}

.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.02);
}

.rounded-4 {
    border-radius: 1rem !important;
}

.modal-content {
    border: none;
}

.modal-header {
    border-bottom: none;
}

.modal-body {
    padding: 1.5rem;
}

dl.row {
    margin-bottom: 0;
}

dt {
    font-weight: 600;
}

dd {
    margin-bottom: 0.5rem;
}

.btn-sm {
    padding: 0.4rem 1rem;
}

.text-truncate {
    max-width: 150px;
    display: inline-block;
    vertical-align: middle;
}

.bg-primary-subtle {
    background-color: rgba(78, 115, 223, 0.1);
}

.bg-success-subtle {
    background-color: rgba(40, 167, 69, 0.1);
}

.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1);
}

.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1);
}

.text-primary {
    color: #4e73df !important;
}

.text-success {
    color: #28a745 !important;
}

.text-danger {
    color: #dc3545 !important;
}

.text-warning {
    color: #ffc107 !important;
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltips.map(function (tooltip) {
        return new bootstrap.Tooltip(tooltip)
    });

    // Initialize modals
    var modals = [].slice.call(document.querySelectorAll('.modal'))
    modals.map(function (modal) {
        return new bootstrap.Modal(modal)
    });
});
</script>
@endpush
@endsection