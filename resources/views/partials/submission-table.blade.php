{{-- resources/views/partials/submission-content.blade.php --}}
<div class="space-y-3">
    <div class="flex justify-between items-start">
        <span class="status-badge {{ $submission->status }}">
            {{ ucfirst($submission->status) }}
        </span>
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-500">
                <i class="fas fa-calendar-alt mr-1"></i>
                {{ $submission->created_at->format('d M Y') }}
            </span>
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-1 text-gray-400 hover:text-gray-600 focus:outline-none">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div x-show="open" @click.away="open = false" 
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 z-50">
                    <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-trash-alt mr-2"></i>Hapus
                        </button>
                    </form>
                </div>