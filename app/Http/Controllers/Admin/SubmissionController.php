<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use PDF;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::with('user')
            ->latest()
            ->get();
            
        return view('admin.submissions.index', compact('submissions'));
    }

    public function updateStatus(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $submission->update($validated);

        return back()->with('success', 'Status submission berhasil diperbarui.');
    }

    public function generatePDF(Submission $submission)
    {
        // Pilih template berdasarkan jenis form
        $view = match($submission->jenis_form) {
            'form1' => 'admin.submissions.pdf_form1',
            'form2' => 'admin.submissions.pdf_form2',
            'form3' => 'admin.submissions.pdf_form3',
            default => 'admin.submissions.pdf'
        };
    
        // Nama file yang berbeda untuk setiap form
        $namaFile = match($submission->jenis_form) {
            'form1' => 'Surat_Pengajuan_',
            'form2' => 'Permohonan_KTP_',
            'form3' => 'Formulir_Pengaduan_',
            default => 'Submission_'
        };
    
        $pdf = PDF::loadView($view, compact('submission'));
        return $pdf->download($namaFile . $submission->id . '.pdf');
    }
}