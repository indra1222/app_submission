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
        <div class="row g-4">
            <!-- Surat Tugas History -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow h-100">
                    <div class="card-header bg-transparent border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle p-3 me-3">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Riwayat Surat Tugas</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="submission-list">
                            @forelse(Auth::user()->submissions()->where('jenis_form', 'form1')->latest()->take(5)->get() as $submission)
                            <div class="submission-item mb-3 p-3 border rounded-3 bg-white shadow-sm hover-lift">
                                <!-- Status Badge and Actions -->
                                @php
                                    $statusClass = match($submission->status) {
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        default => 'danger'
                                    };
                                @endphp
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $submission->created_at->format('d M Y') }}
                                        </small>
                                        <div class="dropdown">
                                            <button class="btn btn-link btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt me-2"></i>Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content -->
                                <h6 class="fw-bold mb-2">{{ $submission->nama }}</h6>
                                <p class="small text-muted mb-3">{{ Str::limit($submission->tujuan, 50) }}</p>
                                <!-- Action -->
                                @if($submission->status == 'approved')
                                    <a href="{{ route('submissions.pdf', $submission->id) }}" 
                                       class="btn btn-primary btn-sm rounded-pill w-100">
                                        <i class="fas fa-download me-1"></i>Download
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm rounded-pill w-100"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </button>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pengajuan surat tugas</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- SPPD History -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow h-100">
                    <div class="card-header bg-transparent border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle p-3 me-3">
                                <i class="fas fa-id-card fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Riwayat SPPD</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="submission-list">
                            @forelse(Auth::user()->submissions()->where('jenis_form', 'form2')->latest()->take(5)->get() as $submission)
                            <div class="submission-item mb-3 p-3 border rounded-3 bg-white shadow-sm hover-lift">
                                <!-- Status Badge and Actions -->
                                @php
                                    $statusClass = match($submission->status) {
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        default => 'danger'
                                    };
                                @endphp
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $submission->created_at->format('d M Y') }}
                                        </small>
                                        <div class="dropdown">
                                            <button class="btn btn-link btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt me-2"></i>Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content -->
                                <h6 class="fw-bold mb-2">{{ $submission->nama }}</h6>
                                <p class="small text-muted mb-3">{{ Str::limit($submission->tujuan, 50) }}</p>
                                <!-- Action -->
                                @if($submission->status == 'approved')
                                    <a href="{{ route('submissions.pdf', $submission->id) }}" 
                                       class="btn btn-success btn-sm rounded-pill w-100">
                                        <i class="fas fa-download me-1"></i>Download
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm rounded-pill w-100"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </button>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pengajuan SPPD</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kuitansi History -->
            <div class="col-md-4">
                <div class="card border-0 rounded-4 shadow h-100">
                    <div class="card-header bg-transparent border-0 p-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-danger bg-opacity-10 text-danger rounded-circle p-3 me-3">
                                <i class="fas fa-receipt fa-lg"></i>
                            </div>
                            <h5 class="fw-bold mb-0">Riwayat Kuitansi</h5>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="submission-list">
                            @forelse(Auth::user()->submissions()->where('jenis_form', 'form3')->latest()->take(5)->get() as $submission)
                            <div class="submission-item mb-3 p-3 border rounded-3 bg-white shadow-sm hover-lift">
                                <!-- Status Badge and Actions -->
                                @php
                                    $statusClass = match($submission->status) {
                                        'approved' => 'success',
                                        'pending' => 'warning',
                                        default => 'danger'
                                    };
                                @endphp
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <span class="badge bg-{{ $statusClass }}-subtle text-{{ $statusClass }} rounded-pill">
                                        {{ ucfirst($submission->status) }}
                                    </span>
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $submission->created_at->format('d M Y') }}
                                        </small>
                                        <div class="dropdown">
                                            <button class="btn btn-link btn-sm text-muted p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash-alt me-2"></i>Hapus
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- Content -->
                                <h6 class="fw-bold mb-2">{{ $submission->nama }}</h6>
                                <p class="small text-muted mb-3">{{ Str::limit($submission->tujuan, 50) }}</p>
                                <!-- Action -->
                                @if($submission->status == 'approved')
                                    @if($submission->admin_document_path)
                                        <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
                                           class="btn btn-danger btn-sm rounded-pill w-100"
                                           target="_blank">
                                            <i class="fas fa-download me-1"></i>Download
                                        </a>
                                    @endif
                                @else
                                    <button class="btn btn-secondary btn-sm rounded-pill w-100"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </button>
                                @endif
                            </div>
                            @empty
                            <div class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pengajuan kuitansi</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Modals -->
@foreach(Auth::user()->submissions()->latest()->take(15)->get() as $submission)
<div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <dl class="row g-3 mb-0">
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
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

                    @if($submission->jenis_form == 'form3')
                        <dt class="col-sm-4">NIK</dt>
                        <dd class="col-sm-8">{{ $submission->alamat }}</dd>
                    @else
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8">{{ $submission->alamat }}</dd>
                    @endif

                    <dt class="col-sm-4">Tujuan</dt>
                    <dd class="col-sm-8">{{ $submission->tujuan }}</dd>

                    @if($submission->document_path || $submission->admin_document_path)
                        <dt class="col-sm-4">Dokumen</dt>
                        <dd class="col-sm-8">
                            <div class="d-flex flex-column gap-2">
                                @if($submission->document_path)
                                    <a href="{{ Storage::url('documents/'.$submission->document_path) }}" 
                                       class="btn btn-sm btn-outline-primary rounded-pill"
                                       target="_blank">
                                        <i class="fas fa-file-pdf me-1"></i>Lihat Dokumen
                                    </a>
                                @endif
                                @if($submission->admin_document_path)
                                    <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}" 
                                       class="btn btn-sm btn-outline-success rounded-pill"
                                       target="_blank">
                                        <i class="fas fa-file-pdf me-1"></i>Lihat Balasan
                                    </a>
                                @endif
                            </div>
                        </dd>
                    @endif
                </dl>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Styles -->
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
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-primary-subtle { background-color: rgba(78, 115, 223, 0.1); }
.bg-success-subtle { background-color: rgba(40, 167, 69, 0.1); }
.bg-danger-subtle { background-color: rgba(220, 53, 69, 0.1); }
.bg-warning-subtle { background-color: rgba(255, 193, 7, 0.1); }

.submission-list {
    max-height: 600px;
    overflow-y: auto;
    scrollbar-width: thin;
    scrollbar-color: rgba(0,0,0,0.2) transparent;
}

.submission-list::-webkit-scrollbar {
    width: 6px;
}

.submission-list::-webkit-scrollbar-track {
    background: transparent;
}

.submission-list::-webkit-scrollbar-thumb {
    background-color: rgba(0,0,0,0.2);
    border-radius: 3px;
}

.dropdown-menu {
    min-width: 120px;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: none;
    border-radius: 0.5rem;
}

.dropdown-item {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
}

.dropdown-item.text-danger:hover {
    background-color: #dc3545;
    color: white !important;
}
</style>

<!-- Scripts -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    // Initialize dropdowns
    var dropdowns = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    dropdowns.map(function (dropdown) {
        return new bootstrap.Dropdown(dropdown)
    });

    // Handle delete form submissions with SweetAlert2
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Pengajuan yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});
</script>
@endpush
@endsection