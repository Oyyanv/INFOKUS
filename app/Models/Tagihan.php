<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $table = 'tagihans';
    protected $primaryKey = 'id_tagihan';
    public $incrementing = false;

    protected $fillable = [
        'id_tagihan', 'bulan', 'tagihan'
    ];
}
