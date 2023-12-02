<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateKonfirmasiRequest;
use App\Models\Gurustaff;
use App\Models\Pembayaran;
use App\Models\Siswa;

class PembayaranController extends Controller
{

    public function index()
    {
        $pembayaranspp = Pembayaran::with('siswa' ,'Gurustaff')->paginate(5);
        return view('admin/dataspp/index', compact('pembayaranspp'));
    }

    public function show(Pembayaran $pembayaran, $id_pembayaran)
    {
        $pembayaran = $pembayaran->find($id_pembayaran);
        // Ini buat mencari nip
        $guru = Gurustaff::where('id_nip', $pembayaran->id_nip)->first();
        // Ini buat mencari nis
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

    public function update(UpdateKonfirmasiRequest $request, Pembayaran $pembayaran, $id_pembayaran)
    {
        $konfirmasi = Pembayaran::findOrFail($id_pembayaran);

        $guru = null;

        if ($request->filled('nip')) {
            // cari nip
            $guru = Gurustaff::where('NIP', $request->nip)->first();

            if (!$guru) { //klo gk ada hapus
                return redirect()->back()->with('error', 'Guru/Staff Dengan NIP Yang Diinputkan Tidak Ditemukan.');
            }
        }

        $konfirmasi->status = $request->input('status'); // Update status

        if ($guru) {
            $konfirmasi->NIP = $guru->NIP; // kalo ada di cek balik ke atas
        } else {
            $konfirmasi->NIP = null; //kalo gk ada null
        }

        $konfirmasi->save();

        return redirect('/admin/dataspp/index')->with('success', 'Pembayaran Berhasil Dikonfirmasi');

    }
}
