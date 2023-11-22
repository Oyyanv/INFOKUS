<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurustaff extends Model
{
    use HasFactory;
    protected $table = 'gurustaffs';
    protected $primaryKey = 'NIP';
    public $incrementing = false;

    protected $fillable = [
        'NIP', 'nama', 'status'
    ];
}
