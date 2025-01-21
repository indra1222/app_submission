<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use App\Http\Controllers\Auth\LoginController;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes untuk Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Routes untuk User
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Submissions
    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/submissions/create', [SubmissionController::class, 'create'])->name('submissions.create');
    Route::get('/submissions/create/form1', [SubmissionController::class, 'createForm1'])->name('submissions.createForm1');
    Route::get('/submissions/create/form2', [SubmissionController::class, 'createForm2'])->name('submissions.createForm2');
    Route::get('/submissions/create/form3', [SubmissionController::class, 'createForm3'])->name('submissions.createForm3');
    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
});

// Routes untuk Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Submissions Management
    Route::get('/submissions', [AdminSubmissionController::class, 'index'])->name('submissions.index');
    Route::patch('/submissions/{submission}/status', [AdminSubmissionController::class, 'updateStatus'])->name('submissions.status');
    Route::get('/submissions/{submission}/pdf', [AdminSubmissionController::class, 'generatePDF'])->name('submissions.pdf');
});