<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SubmissionController extends Controller 
{
    public function index()
    {
        // Menambahkan pemuatan relasi user untuk performa yang lebih baik.
        $submissions = Submission::with('user')->latest()->get();
        return view('admin.submissions.index', compact('submissions'));
    }

    public function updateStatus(Request $request, Submission $submission)
    {
        // Validasi input untuk status
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Update status dan kirimkan pesan sukses
        $submission->update(['status' => $request->status]);

        // Menggunakan Flash message untuk feedback sukses
        return back()->with('success', 'Status berhasil diupdate!');
    }

    // Generate PDF berdasarkan jenis form
    public function generatePDF(Submission $submission)
    {
        // Gunakan helper untuk memilih view dan nama file
        $view = $this->getSubmissionView($submission);
        $filename = $this->getFilename($submission);

        // Data untuk view
        $data = [
            'submission' => $submission
        ];

        // Tambahkan data untuk form1 jika diperlukan
        if ($submission->jenis_form === 'form1') {
            $data['kepada'] = json_decode($submission->kepada, true);
        }

        // Generate PDF dan stream ke browser
        $pdf = PDF::loadView($view, $data);
        return $pdf->stream($filename . '_' . $submission->id . '.pdf');
    }

    // Unduh dokumen yang disimpan di storage
    public function downloadDocument(Submission $submission)
    {
        if (!$submission->document_path) {
            return back()->with('error', 'Dokumen tidak ditemukan');
        }

        $path = storage_path('app/public/documents/' . $submission->document_path);
        
        // Pastikan file ada sebelum diunduh
        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        return response()->download($path);
    }

    // Tampilkan dokumen jika ada
    public function viewDocument(Submission $submission)
    {
        if ($submission->jenis_form === 'form1') {
            $data = [
                'submission' => $submission,
                'kepada' => json_decode($submission->kepada, true)
            ];
            
            // Generate PDF dan stream ke browser
            $pdf = PDF::loadView('admin.submissions.pdf.pdf_form1', $data);
            return $pdf->stream('Surat_Tugas_' . $submission->id . '.pdf');
        }

        if (!$submission->document_path) {
            return back()->with('error', 'Dokumen tidak ditemukan');
        }

        // Pengecekan file untuk jenis form selain form1
        $path = storage_path('app/public/documents/' . $submission->document_path);
        
        if (!file_exists($path)) {
            return back()->with('error', 'File tidak ditemukan');
        }

        return response()->file($path);
    }

    // Helper function untuk menentukan view berdasarkan jenis form
    private function getSubmissionView(Submission $submission)
    {
        return match($submission->jenis_form) {
            'form1' => 'admin.submissions.pdf.pdf_form1',
            'form2' => 'admin.submissions.pdf.pdf_form2',
            'form3' => 'admin.submissions.pdf.pdf_form3',
            default => 'admin.submissions.pdf.pdf_default',
        };
    }

    // Helper function untuk menentukan nama file PDF berdasarkan jenis form
    private function getFilename(Submission $submission)
    {
        return match($submission->jenis_form) {
            'form1' => 'Surat_Tugas',
            'form2' => 'Permohonan_KTP',
            'form3' => 'Form_Pengaduan',
            default => 'Dokumen',
        };
    }
}
