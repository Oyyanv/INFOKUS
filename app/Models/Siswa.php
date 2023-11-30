<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primaryKey = 'NIS_Kelas';
    public $incrementing = false;

    protected $fillable = [
        'NIS_Kelas', 'NIS', 'Nama', 'kelas','JK', 'Jurusan', 'Angkatan','NIK_Orangtua', 
    ];

    public function ortu()
    {
        return $this->belongsTo(Ortu::class, 'NIK_Orangtua', 'NIK_Orangtua');
    }
}


