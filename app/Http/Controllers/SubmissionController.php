<?php
namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller 
{
    public function index()
    {
        $submissions = auth()->user()->submissions()->latest()->get();
        $latestSubmission = $submissions->first();
        return view('submissions.index', compact('submissions', 'latestSubmission'));
    }

    public function create()
    {
        return view('submissions.create'); 
    }

    public function createForm1()
    {
        return view('submissions.form1');
    }
    
    public function createForm2()
    {
        return view('submissions.form2');
    }

    public function createForm3()
    {
        return view('submissions.form3'); 
    }

    public function store(Request $request)
    {
        // Aturan validasi dasar untuk semua form
        $dataValid = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tujuan' => 'required|string',
            'jenis_form' => 'required|in:form1,form2,form3',
            'document' => 'nullable|file|mimes:pdf|max:2048', // Validasi PDF max 2MB
        ]);

        // Set nilai default untuk field opsional
        $dataValid = array_merge($dataValid, [
            'menimbang' => null,
            'kepada' => null,
            'untuk' => null,
            'jangka_waktu' => null,
            'document_path' => null,
        ]);

        // Upload dan simpan PDF jika ada
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');
            $dataValid['document_path'] = $filename;
        }

        // Validasi dan set data khusus form1
        if ($request->jenis_form === 'form1') {
            $form1Data = $request->validate([
                'menimbang' => 'required|string',
                'kepada' => 'required|array',
                'kepada.*.nama' => 'required|string|max:255',
                'kepada.*.nip_nik' => 'required|string|max:20',
                'kepada.*.jabatan' => 'required|string|max:255',
                'untuk' => 'required|string',
                'jangka_waktu' => 'required|string',
            ]);

            $dataValid = array_merge($dataValid, $form1Data);
            $dataValid['kepada'] = json_encode($dataValid['kepada']);
        }

        // Tambah user_id dan status
        $dataValid['user_id'] = auth()->id();
        $dataValid['status'] = 'pending';

        // Buat pengajuan baru
        Submission::create($dataValid);

        // Pesan berdasarkan jenis form
        $pesan = match($request->jenis_form) {
            'form1' => 'Surat Tugas berhasil diajukan!',
            'form2' => 'Permohonan KTP berhasil dikirim!',
            'form3' => 'Form 3 berhasil dikirim!',
            default => 'Form berhasil dikirim!'
        };

        return redirect()->route('submissions.index')
            ->with('success', $pesan);
    }

    public function show(Submission $submission)
    {
        $this->authorize('view', $submission);
        return view('submissions.show', compact('submission'));
    }

    public function update(Request $request, Submission $submission)
    {
        $this->authorize('update', $submission);

        $dataValid = $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $submission->update($dataValid);

        return redirect()->back()
            ->with('success', 'Status pengajuan berhasil diperbarui!');
    }

    public function destroy(Submission $submission)
    {
        $this->authorize('delete', $submission);
        
        // Hapus file PDF jika ada
        if ($submission->document_path) {
            Storage::disk('public')->delete('documents/' . $submission->document_path);
        }
        
        $submission->delete();

        return redirect()->route('submissions.index')
            ->with('success', 'Pengajuan berhasil dihapus!');
    }

    public function adminIndex()
    {
        $this->authorize('viewAny', Submission::class);

        $submissions = Submission::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.submissions.index', compact('submissions'));
    }

    public function approve(Submission $submission)
    {
        $this->authorize('update', $submission);

        $submission->update(['status' => 'approved']);

        return response()->json([
            'message' => 'Pengajuan berhasil disetujui!'
        ]);
    }

    public function reject(Submission $submission)
    {
        $this->authorize('update', $submission);

        $submission->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Pengajuan berhasil ditolak!'
        ]); 
    }

    // Method untuk download dokumen PDF
    public function downloadDocument(Submission $submission)
    {
        $this->authorize('view', $submission);

        if (!$submission->document_path) {
            return back()->with('error', 'Dokumen tidak ditemukan');
        }

        $path = storage_path('app/public/documents/' . $submission->document_path);
        
        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }
}