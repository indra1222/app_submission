@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg rounded-4 border-0">
        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 rounded-top-4">
            <h4 class="mb-0 fw-bold"><i class="fas fa-history me-2"></i>Submission History</h4>
            <div class="d-flex align-items-center">
                <span class="badge bg-white text-primary me-2 p-2 rounded-pill">{{ $submissions->count() }} Entries</span>
                <i class="fas fa-clipboard-list fa-2x"></i>
            </div>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive rounded-3">
                <table class="table table-hover table-striped align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center ps-4">#</th>
                            <th class="py-3"><i class="fas fa-calendar me-2"></i>Date</th>
                            <th class="py-3"><i class="fas fa-user me-2"></i>User</th>
                            <th class="py-3"><i class="fas fa-tag me-2"></i>Form Type</th>
                            <th class="py-3"><i class="fas fa-file-signature me-2"></i>Submission</th>
                            <th class="py-3"><i class="fas fa-tasks me-2"></i>Status</th>
                            <th class="py-3 text-center"><i class="fas fa-file-alt me-2"></i>Document</th>
                            <th class="text-center pe-4"><i class="fas fa-cogs me-2"></i>Actions</th>
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
                                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm border-0 shadow-sm">
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
                                    <div class="text-muted">
                                        <i class="fas fa-inbox fa-3x"></i>
                                        <p class="mt-3">No Submissions Found</p>
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
    .rounded-4 {
        border-radius: 1rem;
    }
    .hover-scale {
        transition: transform 0.2s;
    }
    .hover-scale:hover {
        transform: scale(1.05);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.status-form select').forEach(select => {
            select.addEventListener('change', function() {
                if (confirm(`Change status to "${this.value}"?`)) this.closest('form').submit();
                else this.value = this.dataset.previousValue;
            });
        });
    });
</script>
@endsection
