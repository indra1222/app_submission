@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Riwayat Submission</h4>
            <a href="{{ route('submissions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Buat Submission
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal</th>
                            <th>Jenis Form</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>#{{ $submission->id }}</td>
                                <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    @if($submission->jenis_form == 'form1')
                                        <span class="badge bg-primary">Pengajuan Surat</span>
                                    @elseif($submission->jenis_form == 'form2')
                                        <span class="badge bg-success">Permohonan KTP</span>
                                    @else
                                        <span class="badge bg-info">Pengaduan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($submission->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($submission->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Generate Dokumen (hanya muncul jika status approved) -->
                                    @if($submission->status == 'approved')
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fas fa-file me-1"></i> Dokumen
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('documents.surat-tugas', ['id' => $submission->id]) }}" target="_blank">
                                                        <i class="fas fa-eye me-1"></i> Lihat Surat Tugas
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('documents.surat-tugas', ['id' => $submission->id, 'type' => 'pdf']) }}">
                                                        <i class="fas fa-download me-1"></i> Download Surat Tugas
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('documents.sppd', ['id' => $submission->id]) }}" target="_blank">
                                                        <i class="fas fa-eye me-1"></i> Lihat SPPD
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('documents.sppd', ['id' => $submission->id, 'type' => 'pdf']) }}">
                                                        <i class="fas fa-download me-1"></i> Download SPPD
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('documents.kuitansi', ['id' => $submission->id]) }}" target="_blank">
                                                        <i class="fas fa-eye me-1"></i> Lihat Kuitansi
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('documents.kuitansi', ['id' => $submission->id, 'type' => 'pdf']) }}">
                                                        <i class="fas fa-download me-1"></i> Download Kuitansi
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data submission.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection