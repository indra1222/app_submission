<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubmissionController as AdminSubmissionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DocumentController;

// Halaman Utama
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes untuk Authentication
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Routes untuk User
Route::middleware(['auth'])->group(function () {
    // Dashboard User
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

    // Documents
    Route::get('/documents/surat-tugas/{id}', [DocumentController::class, 'suratTugas'])->name('documents.surat-tugas');
    Route::get('/documents/surat-tugas/{id}/pdf', [DocumentController::class, 'suratTugasPdf'])->name('documents.surat-tugas.pdf');
    Route::get('/documents/sppd/{id}', [DocumentController::class, 'sppd'])->name('documents.sppd');
    Route::get('/documents/sppd/{id}/pdf', [DocumentController::class, 'sppdPdf'])->name('documents.sppd.pdf');
    Route::get('/documents/kuitansi/{id}', [DocumentController::class, 'kuitansi'])->name('documents.kuitansi');
    Route::get('/documents/kuitansi/{id}/pdf', [DocumentController::class, 'kuitansiPdf'])->name('documents.kuitansi.pdf');
});