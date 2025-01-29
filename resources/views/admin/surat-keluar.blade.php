@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Daftar Surat Keluar</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Tujuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $submission->created_at->format('d/m/Y') }}</td>
                            <td>{{ $submission->nama }}</td>
                            <td>{{ $submission->tujuan }}</td>
                            <td>
                                <span class="badge bg-{{ $submission->status == 'pending' ? 'warning' : ($submission->status == 'approved' ? 'success' : 'danger') }}">
                                    {{ ucfirst($submission->status) }}
                                </span>
                            </td>
                            <td>
                                @if($submission->status == 'approved')
                                <a href="{{ route('admin.submissions.pdf', $submission) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-download me-1"></i>Download
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada surat keluar</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection