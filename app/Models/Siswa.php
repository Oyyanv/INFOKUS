<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primaryKey = 'NIS_Angkatan';
    public $incrementing = false;

    protected $fillable = [
        'NIS_Angkatan','NIS_Kelas', 'NIS', 'Nama', 'kelas', 'jk', 'Jurusan', 'Angkatan','NIK_Orangtua', 
    ];

    public function ortu()
    {
        return $this->belongsTo(Ortu::class, 'NIK', 'NIK');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pembayaran(){
        return $this->hasMany(Pembayaran::class, 'NIS_Angkatan', 'NIS_Angkatan');
    }
    
}


