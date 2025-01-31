@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Back to Dashboard Button -->
    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary border-2 rounded-pill hover-lift px-4 py-2 transition-all">
            <i class="fas fa-arrow-left me-2 text-primary"></i>
            <span class="d-inline-block position-relative">
                Back to Dashboard
                <div class="position-absolute bottom-0 start-0 w-100 h-1 bg-primary opacity-75 transition-all"></div>
            </span>
        </a>
    </div>

    <!-- Main Card -->
    <div class="card shadow-lg rounded-4 border-0 transform-hover transition-all">
        <!-- Enhanced Header -->
        <div class="card-header bg-gradient-primary text-blue d-flex align-items-center justify-content-between py-4 px-4 rounded-top-4 position-relative overflow-hidden">
            <!-- Decorative Background -->
            
            <div class="d-flex align-items-center">
                <div class="bg-blue bg-opacity-20 p-2 rounded-circle me-3">
                    <i class="fas fa-history fa-lg text-warning"></i>
                </div>
                <h4 class="mb-0 fw-bold">Submission History</h4>
            </div>
            
            <div class="d-flex align-items-center">
                <div class="badge bg-warning text-dark me-3 px-3 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-list-alt me-2"></i>
                    {{ $submissions->count() }} Entries
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-circle">
                    <i class="fas fa-clipboard-list fa-lg text-success"></i>
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
                            <th class="py-3"><i class="fas fa-user me-2 text-success"></i>User</th>
                            <th class="py-3"><i class="fas fa-tag me-2 text-info"></i>Form Type</th>
                            <th class="py-3"><i class="fas fa-file-signature me-2 text-warning"></i>Submission</th>
                            <th class="py-3"><i class="fas fa-tasks me-2 text-danger"></i>Status</th>
                            <th class="py-3 text-center"><i class="fas fa-file-alt me-2 text-secondary"></i>Document</th>
                            <th class="text-center pe-4"><i class="fas fa-cogs me-2 text-dark"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr class="border-bottom transition-all hover-bg-light">
                                <td class="text-center fw-bold text-primary ps-4">{{ $loop->iteration }}</td>
                                <td class="text-muted">{{ $submission->created_at->format('d M Y, H:i') }}</td>
                                <td class="d-flex align-items-center">
                                    <div class="avatar-sm bg-success text-white rounded-circle me-2 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                    <span class="text-dark">{{ $submission->user->name }}</span>
                                </td>
                                <td>
                                    @switch($submission->jenis_form)
                                        @case('form1')
                                            <span class="badge bg-info text-white px-3 py-2 rounded-pill">Letter Request</span>
                                            @break
                                        @case('form2')
                                            <span class="badge bg-success text-white px-3 py-2 rounded-pill">ID Application</span>
                                            @break
                                        @default
                                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Complaint</span>
                                    @endswitch
                                </td>
                                <td class="text-truncate text-muted" style="max-width: 200px;">{{ $submission->nama }}</td>
                                <td>
                                    <form action="{{ route('admin.submissions.status', $submission) }}" 
                                        method="POST" 
                                        class="status-form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="d-flex flex-column gap-2">
                                            <select name="status" class="form-select form-select-sm border-0 shadow-sm transition-all text-white 
                                                @if($submission->status == 'pending') bg-warning 
                                                @elseif($submission->status == 'approved') bg-success 
                                                @else bg-danger @endif" 
                                                    data-previous-value="{{ $submission->status }}">
                                                @foreach(['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label)
                                                    <option value="{{ $value }}" 
                                                        {{ $submission->status == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <input type="file" name="admin_document" 
                                                class="form-control form-control-sm transition-all border-primary" 
                                                accept=".pdf">
                                                
                                            <button type="submit" class="btn btn-sm btn-primary mt-1 transition-all">
                                                <i class="fas fa-paper-plane me-1"></i> Update & Send
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-column gap-2">
                                        @if($submission->document_path)
                                            <a href="{{ Storage::url('documents/'.$submission->document_path) }}"
                                            class="btn btn-sm btn-outline-info rounded-pill transition-all"
                                            target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i>User PDF
                                            </a>
                                        @endif
                                        @if($submission->admin_document_path)
                                            <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}"
                                            class="btn btn-sm btn-outline-success rounded-pill transition-all"
                                            target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i>Admin PDF
                                            </a>
                                        @endif
                                        @if($submission->jenis_form == 'form1')
                                            <a href="{{ route('admin.submissions.view', $submission) }}"
                                            class="btn btn-sm btn-outline-primary rounded-pill transition-all" 
                                            target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i>Form Details
                                            </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary transition-all" data-bs-toggle="modal" 
                                                data-bs-target="#detail-{{ $submission->id }}">
                                            <i class="fas fa-expand"></i>
                                        </button>
                                        @if($submission->document_path || $submission->jenis_form == 'form1')
                                            <a href="{{ $submission->jenis_form == 'form1' ? route('admin.submissions.pdf', $submission) : route('admin.submissions.download', $submission) }}" 
                                            class="btn btn-sm btn-outline-success transition-all">
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
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-4 text-primary">Applicant Name</dt>
                                                <dd class="col-sm-8 text-dark">{{ $submission->nama }}</dd>

                                                <dt class="col-sm-4 text-primary">Submission Date</dt>
                                                <dd class="col-sm-8 text-muted">{{ $submission->created_at->format('d M Y, H:i') }}</dd>

                                                <dt class="col-sm-4 text-primary">Form Type</dt>
                                                <dd class="col-sm-8">
                                                    @switch($submission->jenis_form)
                                                        @case('form1')
                                                            <span class="badge bg-info text-white">Letter Request</span>
                                                            @break
                                                        @case('form2')
                                                            <span class="badge bg-success text-white">ID Application</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-danger text-white">Complaint</span>
                                                    @endswitch
                                                </dd>

                                                <dt class="col-sm-4 text-primary">Address</dt>
                                                <dd class="col-sm-8 text-muted">{{ $submission->alamat }}</dd>

                                                @if($submission->jenis_form == 'form3')
                                                    <dt class="col-sm-4 text-primary">Documents</dt>
                                                    <dd class="col-sm-8">
                                                        @if($submission->document_path)
                                                            <a href="{{ Storage::url('documents/'.$submission->document_path) }}"
                                                            class="btn btn-sm btn-outline-info me-2 transition-all"
                                                            target="_blank">
                                                                <i class="fas fa-file-pdf me-1"></i>User Document
                                                            </a>
                                                        @endif
                                                        @if($submission->admin_document_path)
                                                            <a href="{{ Storage::url('documents/'.$submission->admin_document_path) }}"
                                                            class="btn btn-sm btn-outline-success transition-all"
                                                            target="_blank">
                                                                <i class="fas fa-file-pdf me-1"></i>Admin Response
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-form').forEach(form => {
        const select = form.querySelector('select');
        const fileInput = form.querySelector('input[type="file"]');
        const submitButton = form.querySelector('button[type="submit"]');
        
        // Initially hide submit button
        if (submitButton) {
            submitButton.style.display = 'none';
        }

        // Show/hide submit button based on file input
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (submitButton) {
                    submitButton.style.display = this.files.length > 0 ? 'block' : 'none';
                }
            });
        }

        // Default status change behavior
        select.addEventListener('change', function() {
            if (fileInput && !fileInput.files.length) {
                if (confirm(`Change status to "${this.value}"?`)) {
                    form.submit();
                } else {
                    this.value = this.dataset.previousValue;
                }
            }
        });

        // Store initial value
        select.dataset.previousValue = select.value;
    });
});
</script>
@endsection