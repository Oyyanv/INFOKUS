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
         'NIK_Orangtua', 'NIK', 'Nama', 'Alamat', 'No_Telp'
    ];
}
