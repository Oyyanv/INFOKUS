<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    use HasFactory;
    protected $table = 'orangtua';
    protected $primaryKey = 'NIK_Orangtua';
    public $incrementing = false;

    protected $fillable = [
         'NIK_Orangtua', 'NIK', 'Nama', 'jk', 'Alamat', 'No_Telp'
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'NIK_Orangtua', 'NIK_Orangtua');
    }
}
