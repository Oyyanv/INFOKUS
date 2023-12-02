<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayarans';
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false;

    protected $fillable = [
        'id_pembayaran', 'tgl_pembayaran', 'total_tagihan', 'bulan',
        'bukti_pembayaran', 'total_pembayaran', 'status', 'NIS_Angkatan', 
        'id_nip', 'id_tagihan','NIS','email'
        ];

        public function siswa()
        {
            return $this->belongsTo(Siswa::class, 'NIS_Angkatan', 'NIS_Angkatan');
        }
    
        // Relasi gurustaffs
        public function guruStaff()
        {
            return $this->belongsTo(Gurustaff::class, 'id_nip', 'id_nip');
        }
    
        // Relasi tagihans
        public function tagihan()
        {
            return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
        }
        
        public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
