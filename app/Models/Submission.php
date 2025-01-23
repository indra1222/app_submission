<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'user_id',
        'nama', 
        'alamat',
        'menimbang',
        'tujuan',
        'jenis_form',
        'kepada', // Disimpan sebagai JSON
        'untuk',
        'jangka_waktu',
        'status'
    ];

    protected $casts = [
        'kepada' => 'array', // Untuk mendukung penyimpanan data JSON
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}