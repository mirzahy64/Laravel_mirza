<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $table = 'cv_2555301114';

   protected $fillable = [
    'nama',
    'nim',
    'kelas',
    'tempat_lahir',
    'tanggal_lahir',
    'posisi',
    'perusahaan',
    'periode',
    'deskripsi', // <-- TAMBAHKAN BARIS INI
    ];
}