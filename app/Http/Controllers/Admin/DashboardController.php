<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::where('role', 'user')->count(),
            'total_submissions' => Submission::count(),
            'pending_submissions' => Submission::where('status', 'pending')->count(),
            'approved_submissions' => Submission::where('status', 'approved')->count(),
        ];

        $latest_submissions = Submission::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_submissions'));
    }
}