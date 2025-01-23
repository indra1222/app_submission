@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Detail Submission</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4>Informasi Submission</h4>
                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td>{{ $submission->id }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
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
                            <th>Jenis Form</th>
                            <td>
                                @switch($submission->jenis_form)
                                    @case('form1')
                                        Surat Keluar
                                        @break
                                    @case('form2')
                                    @case('form3')
                                        Surat Masuk
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @switch($submission->status)
                                    @case('pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @break
                                    @case('approved')
                                        <span class="badge bg-success">Disetujui</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                        @if($submission->catatan)
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $submission->catatan }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                <div class="col-md-6">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.submissions.preview', $submission) }}" class="btn btn-primary">
                            <i class="fas fa-file-pdf me-1"></i>Lihat Preview PDF
                        </a>

                        @if($submission->status === 'pending')
                            <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-check me-1"></i>Setujui Submission
                                </button>
                            </form>

                            <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <div class="mb-3">
                                    <textarea name="catatan" class="form-control" rows="3" 
                                        placeholder="Berikan catatan penolakan (opsional)"></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-times me-1"></i>Tolak Submission
                                </button>
                            </form>
                        @elseif($submission->status === 'approved')
                            <a href="{{ route('admin.submissions.pdf', $submission) }}" class="btn btn-success">
                                <i class="fas fa-download me-1"></i>Download PDF
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection