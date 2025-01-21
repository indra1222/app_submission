@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Kelola Submissions</h5>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Jenis Form</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $submission->user->name }}</td>
                                <td>
                                    @if($submission->jenis_form == 'form1')
                                        <span class="badge bg-primary">Pengajuan Surat</span>
                                    @elseif($submission->jenis_form == 'form2')
                                        <span class="badge bg-success">Permohonan KTP</span>
                                    @else
                                        <span class="badge bg-danger">Pengaduan</span>
                                    @endif
                                </td>
                                <td>{{ $submission->nama }}</td>
                                <td>
                                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <option value="pending" {{ $submission->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ $submission->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                            <option value="rejected" {{ $submission->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detail-{{ $submission->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($submission->status == 'approved')
                                        <a href="{{ route('admin.submissions.pdf', $submission) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    @endif
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
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data submission</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection