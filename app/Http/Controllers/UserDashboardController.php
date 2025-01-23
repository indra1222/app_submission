<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;

class UserDashboardController extends Controller 
{
   public function index()
   {
       $submissions = Auth::user()->submissions()->latest()->get();
       
       $stats = [
           'total_submissions' => $submissions->count(),
           'pending_submissions' => $submissions->where('status', 'pending')->count(),
           'approved_submissions' => $submissions->where('status', 'approved')->count(),
           'rejected_submissions' => $submissions->where('status', 'rejected')->count(),
       ];

       return view('user.dashboard', compact('stats', 'submissions'));
   }

   public function downloadPDF(Submission $submission)
   {
       if($submission->user_id !== auth()->id() || $submission->status !== 'approved') {
           abort(403); 
       }

       $view = match($submission->jenis_form) {
           'form1' => 'admin.submissions.pdf_form1',
           'form2' => 'admin.submissions.pdf_form2',
           'form3' => 'admin.submissions.pdf_form3',
       };

       $filename = match($submission->jenis_form) {
           'form1' => 'Surat_Tugas',
           'form2' => 'Surat_Masuk', 
           'form3' => 'Surat_Masuk',
       };

       $pdf = PDF::loadView($view, compact('submission'));
       return $pdf->download($filename . '_' . $submission->id . '.pdf');
   }
}