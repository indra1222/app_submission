@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Preview PDF</h3>
            <div>
                @if($submission->status === 'pending')
                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-1"></i>Setujui
                        </button>
                    </form>

                    <form action="{{ route('admin.submissions.status', $submission) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times me-1"></i>Tolak
                        </button>
                    </form>
                @elseif($submission->status === 'approved')
                    <a href="{{ route('admin.submissions.pdf', $submission) }}" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i>Download PDF
                    </a>
                @endif
            </div>
        </div>
        <div class="card-body">
            @include($pdfView, ['submission' => $submission])
        </div>
    </div>
</div>
@endsection