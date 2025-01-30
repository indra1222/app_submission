@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Back to Dashboard Button -->
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-light border-0 shadow-sm rounded-pill hover-lift px-4 py-2">
            <i class="fas fa-arrow-left me-2"></i>
            <span class="d-inline-block position-relative">
                Back to Dashboard
                <div class="position-absolute bottom-0 start-0 w-100 h-1 bg-primary opacity-25"></div>
            </span>
        </a>
    </div>

    <!-- Main Card -->
    <div class="card shadow-lg rounded-4 border-0 transform-hover">
        <!-- Enhanced Header -->
        <div class="card-header bg-gradient-primary text-white d-flex align-items-center justify-content-between py-4 px-4 rounded-top-4 position-relative overflow-hidden">
            <!-- Decorative Background -->
            <div class="position-absolute top-0 end-0 opacity-10">
                <svg width="200" height="200" viewBox="0 0 100 100">
                    <path fill="currentColor" d="M65.5,20.2C68.3,31.3,71,42.4,66.6,49.8C62.2,57.2,50.7,60.8,39.7,61.9C28.7,63,18.2,61.6,12.6,54.9C7,48.2,6.3,36.3,10.2,27.7C14.1,19.1,22.7,13.8,31.7,11.2C40.7,8.6,50.2,8.7,57.7,11.5C65.2,14.3,70.8,19.8,71.5,25.9" />
                </svg>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="bg-white bg-opacity-10 p-2 rounded-circle me-3">
                    <i class="fas fa-history fa-lg"></i>
                </div>
                <h4 class="mb-0 fw-bold">Submission History</h4>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="badge bg-white text-primary me-3 px-3 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-list-alt me-2"></i>
                    {{ $submissions->count() }} Entries
                </div>
                <div class="bg-white bg-opacity-10 p-3 rounded-circle">
                    <i class="fas fa-clipboard-list fa-lg"></i>
                </div>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive rounded-3">
                <table class="table table-hover align-middle custom-table">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center ps-4 py-3">#</th>
                            <th class="py-3"><i class="fas fa-calendar me-2 text-primary"></i>Date</th>
                            <th class="py-3"><i class="fas fa-user me-2 text-primary"></i>User</th>
                            <th class="py-3"><i class="fas fa-tag me-2 text-primary"></i>Form Type</th>
                            <th class="py-3"><i class="fas fa-file-signature me-2 text-primary"></i>Submission</th>
                            <th class="py-3"><i class="fas fa-tasks me-2 text-primary"></i>Status</th>
                            <th class="py-3 text-center"><i class="fas fa-file-alt me-2 text-primary"></i>Document</th>
                            <th class="text-center pe-4"><i class="fas fa-cogs me-2 text-primary"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr class="border-bottom">
                                <td class="text-center fw-bold text-primary ps-4">{{ $loop->iteration }}</td>
                                <td>{{ $submission->created_at->format('d M Y, H:i') }}</td>
                                <td class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    {{ $submission->user->name }}
                                </td>
                                <td>
                                    @switch($submission->jenis_form)
                                        @case('form1')
                                            <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Letter Request</span>
                                            @break
                                        @case('form2')
                                            <span class="badge bg-success text-white px-3 py-2 rounded-pill">ID Application</span>
                                            @break
                                        @default
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Complaint</span>
                                    @endswitch
                                </td>
                                <td class="text-truncate" style="max-width: 200px;">{{ $submission->nama }}</td>
                                <td>
                                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST" class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm border-0 shadow-sm" 
                                                data-previous-value="{{ $submission->status }}">
                                            @foreach(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
                                                <option value="{{ $value }}" 
                                                    {{ $submission->status == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="text-center">
                                    @if($submission->document_path || $submission->jenis_form == 'form1')
                                        <a href="{{ $submission->jenis_form == 'form1' ? route('admin.submissions.view', $submission) : Storage::url('documents/'.$submission->document_path) }}" 
                                           class="btn btn-sm btn-outline-info rounded-pill" target="_blank">
                                            <i class="fas fa-file-pdf"></i> View
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" 
                                                data-bs-target="#detail-{{ $submission->id }}">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        @if($submission->document_path || $submission->jenis_form == 'form1')
                                            <a href="{{ $submission->jenis_form == 'form1' ? route('admin.submissions.pdf', $submission) : route('admin.submissions.download', $submission) }}" 
                                               class="btn btn-sm btn-outline-success">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Detail Modal -->
                            <div class="modal fade" id="detail-{{ $submission->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title">Submission Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-4">Applicant Name</dt>
                                                <dd class="col-sm-8">{{ $submission->nama }}</dd>

                                                <dt class="col-sm-4">Submission Date</dt>
                                                <dd class="col-sm-8">{{ $submission->created_at->format('d M Y, H:i') }}</dd>

                                                <dt class="col-sm-4">Form Type</dt>
                                                <dd class="col-sm-8">{{ $submission->jenis_form }}</dd>

                                                <dt class="col-sm-4">Address</dt>
                                                <dd class="col-sm-8">{{ $submission->alamat }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon bg-light rounded-circle p-4 mb-3">
                                            <i class="fas fa-inbox fa-3x text-primary opacity-50"></i>
                                        </div>
                                        <h5 class="text-muted">No Submissions Found</h5>
                                        <p class="text-muted small">Start by creating a new submission</p>
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

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
}

.hover-lift {
    transition: all 0.2s ease;
}

.hover-lift:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
}

.transform-hover {
    transition: all 0.3s ease;
}

.transform-hover:hover {
    transform: translateY(-5px);
}

.custom-table th {
    font-weight: 600;
    border-bottom: 2px solid #e3e6f0;
}

.custom-table td {
    border-bottom: 1px solid #e3e6f0;
}

.table-hover tbody tr {
    transition: all 0.2s ease;
}

.table-hover tbody tr:hover {
    background-color: rgba(78, 115, 223, 0.05);
}

.empty-state {
    padding: 2rem;
}

.empty-state-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.rounded-4 {
    border-radius: 1rem !important;
}

.h-1 {
    height: 2px !important;
}

.avatar-sm {
    width: 32px;
    height: 32px;
}

.form-select {
    transition: all 0.2s ease;
    cursor: pointer;
}

.form-select:hover {
    box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075)!important;
}

.btn-group .btn {
    transition: all 0.2s ease;
}

.btn-group .btn:hover {
    transform: translateY(-1px);
}

.modal-content {
    border: none;
    border-radius: 1rem;
}

.modal-header {
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-form select').forEach(select => {
        select.addEventListener('change', function() {
            if (confirm(`Change status to "${this.value}"?`)) {
                this.closest('form').submit();
            } else {
                this.value = this.dataset.previousValue;
            }
        });

        // Store initial value
        select.dataset.previousValue = select.value;
    });
});
</script>
@endsection