@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-home me-2"></i>Dashboard User</h4>
                </div>
                <div class="card-body">
                    <h5>Selamat datang, {{ Auth::user()->name }}!</h5>
                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-file-alt fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Form Pengajuan Surat</h5>
                                    <p class="card-text">Ajukan surat-menyurat resmi untuk berbagai keperluan</p>
                                    <a href="{{ route('submissions.createForm1') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>Buat Pengajuan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-id-card fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Form KTP</h5>
                                    <p class="card-text">Ajukan permohonan pembuatan atau perpanjangan KTP</p>
                                    <a href="{{ route('submissions.createForm2') }}" class="btn btn-success">
                                        <i class="fas fa-plus me-1"></i>Buat Permohonan
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                    <h5 class="card-title">Form Pengaduan</h5>
                                    <p class="card-text">Sampaikan pengaduan atau keluhan Anda</p>
                                    <a href="{{ route('submissions.createForm3') }}" class="btn btn-danger">
                                        <i class="fas fa-plus me-1"></i>Buat Pengaduan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5><i class="fas fa-history me-2"></i>Riwayat Pengajuan</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Form</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->submissions()->latest()->take(5)->get() as $submission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($submission->jenis_form == 'form1')
                                                    <span class="badge bg-primary">Pengajuan Surat</span>
                                                @elseif($submission->jenis_form == 'form2')
                                                    <span class="badge bg-success">Permohonan KTP</span>
                                                @else
                                                    <span class="badge bg-danger">Pengaduan</span>
                                                @endif
                                            </td>
                                            <td>{{ $submission->created_at->format('d M Y') }}</td>
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
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detail-{{ $submission->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Submission</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th width="30%">Nama</th>
                                                                <td>{{ $submission->nama }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Alamat</th>
                                                                <td>{{ $submission->alamat }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Tujuan</th>
                                                                <td>{{ $submission->tujuan }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <td>{{ ucfirst($submission->status) }}</td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada pengajuan</td>
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
@endsection