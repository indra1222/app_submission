<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;

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
       // Template dan nama file berdasarkan jenis form
       $view = match($submission->jenis_form) {
           'form1' => 'admin.submissions.pdf.pdf_form1',
           'form2' => 'admin.submissions.pdf.pdf_form2',
           'form3' => 'admin.submissions.pdf.pdf_form3',
           default => 'admin.submissions.pdf.pdf_default'
       };

       $filename = match($submission->jenis_form) {
           'form1' => 'Surat_Tugas',
           'form2' => 'Permohonan_KTP',
           'form3' => 'Form_Pengaduan',
           default => 'Dokumen'
       };

       // Data untuk view
       $data = [
           'submission' => $submission
       ];

       // Tambahkan data khusus untuk form1
       if ($submission->jenis_form === 'form1') {
           $data['kepada'] = json_decode($submission->kepada, true);
       }

       // Generate PDF
       $pdf = PDF::loadView($view, $data);
       return $pdf->stream($filename . '_' . $submission->id . '.pdf');
   }

   public function downloadDocument(Submission $submission)
   {
       if (!$submission->document_path) {
           return back()->with('error', 'Dokumen tidak ditemukan');
       }

       $path = storage_path('app/public/documents/' . $submission->document_path);
       
       if (!file_exists($path)) {
           return back()->with('error', 'File tidak ditemukan');
       }

       return response()->download($path);
   }

   public function viewDocument(Submission $submission)
   {
       if ($submission->jenis_form === 'form1') {
           $data = [
               'submission' => $submission,
               'kepada' => json_decode($submission->kepada, true)
           ];
           
           $pdf = PDF::loadView('admin.submissions.pdf.pdf_form1', $data);
           return $pdf->stream('Surat_Tugas_' . $submission->id . '.pdf');
       }

       if (!$submission->document_path) {
           return back()->with('error', 'Dokumen tidak ditemukan');
       }

       $path = storage_path('app/public/documents/' . $submission->document_path);
       
       if (!file_exists($path)) {
           return back()->with('error', 'File tidak ditemukan');
       }

       return response()->file($path);
   }
}