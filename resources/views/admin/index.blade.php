@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Kelola Submissions</h4>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Section -->
            <form action="{{ route('admin.submissions.index') }}" method="GET" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="jenis_form" class="form-select">
                            <option value="">Semua Jenis Form</option>
                            <option value="form1" {{ request('jenis_form') == 'form1' ? 'selected' : '' }}>Pengajuan Surat</option>
                            <option value="form2" {{ request('jenis_form') == 'form2' ? 'selected' : '' }}>Permohonan KTP</option>
                            <option value="form3" {{ request('jenis_form') == 'form3' ? 'selected' : '' }}>Pengaduan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Jenis Form</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Tujuan</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $submission->id }}</td>
                                <td>{{ $submission->user->name }}</td>
                                <td>
                                    @if($submission->jenis_form == 'form1')
                                        Pengajuan Surat
                                    @elseif($submission->jenis_form == 'form2')
                                        Permohonan KTP
                                    @else
                                        Pengaduan
                                    @endif
                                </td>
                                <td>{{ $submission->nama }}</td>
                                <td>{{ Str::limit($submission->alamat, 30) }}</td>
                                <td>{{ Str::limit($submission->tujuan, 30) }}</td>
                                <td>
                                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                            <option value="pending" {{ $submission->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ $submission->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ $submission->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.submissions.pdf', $submission) }}" class="btn btn-sm btn-primary">
                                        PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data submission.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $submissions->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection