{{-- resources/views/partials/submission-table.blade.php --}}
<div class="overflow-hidden">
    <table class="min-w-full">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">No</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($submissions as $submission)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $submission->nama }}</td>
                    <td class="px-4 py-3 text-sm text-gray-900">{{ $submission->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'approved' => 'bg-emerald-100 text-emerald-800',
                                'rejected' => 'bg-red-100 text-red-800',
                                'default' => 'bg-gray-100 text-gray-800'
                            ];
                            $statusClass = $statusClasses[$submission->status] ?? $statusClasses['default'];
                        @endphp
                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full whitespace-nowrap {{ $statusClass }}">
                            {{ ucfirst($submission->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-sm text-gray-500 text-center border-b">
                        <div class="flex flex-col items-center justify-center">
                            <i class="fas fa-inbox text-gray-400 text-3xl mb-2"></i>
                            <p>Belum ada data submission</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>