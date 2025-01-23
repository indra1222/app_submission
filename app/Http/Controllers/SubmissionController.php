<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {
        // Get the submissions of the authenticated user, ordered by the latest.
        $submissions = auth()->user()->submissions()->latest()->get();
        return view('submissions.index', compact('submissions'));
    }

    public function create()
    {
        return view('submissions.create');
    }

    public function createForm1()
    {
        return view('submissions.form1');
    }

    public function store(Request $request)
    {
        // Validate the form submission
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'menimbang' => 'required|string',
            'tujuan' => 'required|string',
            'kepada' => 'required|array',
            'kepada.*.nama' => 'required|string|max:255',
            'kepada.*.nip_nik' => 'required|string|max:20',
            'kepada.*.jabatan' => 'required|string|max:255',
            'untuk' => 'required|string',
            'jangka_waktu' => 'required|string',
            'jenis_form' => 'required|in:form1,form2,form3', // Adjust if more forms are needed
        ]);

        // Convert the 'kepada' array to a JSON string for storage
        $validated['kepada'] = json_encode($validated['kepada']);

        // Create a new submission for the authenticated user
        auth()->user()->submissions()->create($validated);

        // Redirect with a success message
        return redirect()->route('submissions.index')
            ->with('success', 'Form berhasil dikirim!');
    }
}