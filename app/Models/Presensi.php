<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Presensi extends Model
{
    use HasFactory, Sortable;
    protected $table = "presensi";
    protected $primaryKey = "id";
    protected $fillable = [
        'user_npp',
        'tugas',
        'tgl',
        'jamMasuk',
        'fotoMasuk',
        'latMasuk',
        'longMasuk',
        'jamKeluar',
        'fotoKeluar',
        'latKeluar',
        'longKeluar',
        'lamaLembur',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_npp');
    }
}
