<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurustaff extends Model
{
    use HasFactory;
    protected $table = 'gurustaffs';
    protected $primaryKey = 'id_nip';
    public $incrementing = false;

    protected $fillable = [
        'id_nip', 'NIP', 'nama', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pembayaran(){
        return $this->hasMany(Pembayaran::class, 'id_nip', 'id_nip');
    }
}
