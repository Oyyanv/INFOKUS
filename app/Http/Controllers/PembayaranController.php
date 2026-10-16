<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateKonfirmasiRequest;
use App\Models\Gurustaff;
use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{

    public function index()
    {
        $pembayaranspp = Pembayaran::with('siswa' ,'Gurustaff')->paginate(5);
        return view('admin/dataspp/index', compact('pembayaranspp'));
    }

    public function show(Pembayaran $pembayaran, $id_pembayaran)
    {
        $pembayaran = Pembayaran::find($id_pembayaran);

        // Ini untuk mencari nip
        $guru = Gurustaff::where('NIP', $pembayaran->NIP)->first();
        
        // Ini untuk mencari increment nis
        $incrementnis = Siswa::where('NIS_Angkatan', 'like', $pembayaran->NIS . '_%')
            ->max(DB::raw('CAST(SUBSTRING_INDEX(NIS_Angkatan, "_", -1) AS UNSIGNED)'));
        
        $increment = $incrementnis ? $incrementnis + 1 : 1;
        
        // Ini untuk mencari siswa berdasarkan NIS_Angkatan
        $siswa = Siswa::where('NIS_Angkatan', $pembayaran->NIS_Angkatan)->first();
        
        return view('/admin/dataspp/konfirmasi')->with([
            'id_pembayaran' => $pembayaran->id_pembayaran,
            'nis' => optional($siswa)->NIS,
            'nip' => optional($guru)->NIP,
            'nama' => optional($siswa)->nama,
            'kelas' => optional($siswa)->kelas,
            'bulan' => $pembayaran->bulan,
            'total_tagihan' => $pembayaran->total_tagihan,
            'tgl_pembayaran' => $pembayaran->tgl_pembayaran,
            'bukti_pembayaran' => $pembayaran->bukti_pembayaran,
            'total_pembayaran' => $pembayaran->total_pembayaran,
            'status' => $pembayaran->status,
        ]);

    }

    public function detail(Pembayaran $pembayaran, $id_pembayaran)
    {
    
        $pembayanDetail = Pembayaran::with('siswa' ,'Gurustaff')->where('id_pembayaran', $id_pembayaran)->first();
    
        return response()->json($pembayanDetail);
    }

    public function update(UpdateKonfirmasiRequest $request, Pembayaran $pembayaran, $id_pembayaran)
    {
        $request->validate([
            'nip' => 'nullable|numeric|digits:18',
            'status' => 'required',
        ], [
            'nip.numeric' => 'NIP harus berupa angka.',
            'nip.digits' => 'NIP harus memiliki 18 digit.',
            'status.required' => 'Status Tidak Boleh Kosong',
        ], [
            'nip' => 'NIP',
            'status'=>'Status'
        ]);
        
        $konfirmasi = Pembayaran::findOrFail($id_pembayaran);


        if ($request->nip) {

            $guru = Gurustaff::where('NIP', $request->nip)->first();

            if (!$guru) { 
                return redirect()->back()->with('error', 'Guru/Staff Dengan NIP Yang Diinputkan Tidak Ditemukan.');
            }
            $konfirmasi->nip = $guru->NIP;
        }

        $konfirmasi->status = $request->status;

        $konfirmasi->save();

        return redirect('/admin/dataspp/index')->with('success', 'Pembayaran Berhasil Dikonfirmasi');

    }

    public function search(Request $request)
    {
        $search = $request->search;
    
        $pembayaranSearch = Pembayaran::with('siswa', 'guruStaff')
            ->where('id_pembayaran', 'like', "%" . $search . "%")
            ->orWhere('NIP', 'like', "%" . $search . "%")
            ->orWhere('NIS', 'like', "%" . $search . "%")
            ->orWhere('bulan', 'like', "%" . $search . "%")
            ->orWhere('total_tagihan', 'like', "%" . $search . "%")
            ->orWhere('tgl_pembayaran', 'like', "%" . $search . "%")
            ->orWhere('total_pembayaran', 'like', "%" . $search . "%")
            ->orWhere('status', 'like', "%" . $search . "%")
            ->paginate(7);

            // dd($pembayaranSearch);
    
        return view('admin.dataspp.index', ['pembayaranspp' => $pembayaranSearch]);
    }
}
