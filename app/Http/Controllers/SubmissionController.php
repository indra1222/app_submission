<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller 
{
   public function index()
   {
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
   
   public function createForm2() 
   {
       return view('submissions.form2');
   }

   public function createForm3()
   {
       return view('submissions.form3'); 
   }

   public function store(Request $request)
   {
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
           'jenis_form' => 'required|in:form1,form2,form3',
       ]);

       $validated['kepada'] = json_encode($validated['kepada']);

       auth()->user()->submissions()->create($validated);

       return redirect()->route('submissions.index')
           ->with('success', 'Form berhasil dikirim!');
   }
}