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
        $submissions = Submission::with('user')->latest()->get();
        return view('admin.submissions.index', compact('submissions'));
    }

    public function updateStatus(Request $request, Submission $submission)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $submission->update(['status' => $request->status]);

        return back()->with('success', 'Status berhasil diupdate!');
    }

    public function generatePDF(Submission $submission)
    {
        // Pilih template berdasarkan jenis form
        $view = match($submission->jenis_form) {
            'form1' => 'admin.submissions.pdf_form1',
            'form2' => 'admin.submissions.pdf_form2',
            'form3' => 'admin.submissions.pdf_form3',
        };

        // Nama file yang berbeda untuk setiap jenis form
        $filename = match($submission->jenis_form) {
            'form1' => 'Surat_Pengajuan',
            'form2' => 'Permohonan_KTP',
            'form3' => 'Form_Pengaduan',
        };

        $pdf = PDF::loadView($view, compact('submission'));
        return $pdf->download($filename . '_' . $submission->id . '.pdf');
    }
}