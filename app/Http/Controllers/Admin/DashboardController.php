<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_submissions' => Submission::count(),
            'pending_submissions' => Submission::where('status', 'pending')->count(),
            'approved_submissions' => Submission::where('status', 'approved')->count(),
            'surat_keluar' => Submission::whereIn('jenis_form', ['form1', 'form2', 'form3'])->count(),
            'surat_masuk' => 0 // Set to 0 for now as it's empty/not implemented
        ];
    
        return view('admin.dashboard', compact('stats'));
    }
    public function suratMasuk()
    {
        $submissions = Submission::whereIn('jenis_form', ['form2', 'form3'])
                                ->with('user')
                                ->latest()
                                ->get();
        return view('admin.surat-masuk', compact('submissions'));
    }

    public function suratKeluar() 
    {
        $submissions = Submission::where('jenis_form', 'form1')
                                ->with('user')
                                ->latest()
                                ->get();
        return view('admin.surat-keluar', compact('submissions'));
    }
}