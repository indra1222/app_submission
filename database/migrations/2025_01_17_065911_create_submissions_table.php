<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nama');
            $table->text('alamat');
            $table->text('tujuan');
            $table->text('menimbang');  // Added 'menimbang' field
            $table->json('kepada');  // Added 'kepada' field as a JSON type
            $table->text('untuk');  // Added 'untuk' field
            $table->string('jangka_waktu');  // Added 'jangka_waktu' field
            $table->enum('jenis_form', ['form1', 'form2', 'form3']);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
};