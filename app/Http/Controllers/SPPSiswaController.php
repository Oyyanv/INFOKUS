<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Models\Gurustaff;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\User;

class SPPSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $email = auth()->user()->email;

// Ambil data pembayaran hanya untuk siswa dengan email yang sedang login
        $sppsiswa = Pembayaran::whereHas('siswa', function ($query) use ($email) {
            $query->where('email', $email);
        })->paginate(5);

        return view('siswa/sppsiswa/index', compact('sppsiswa'));
    }

    public function show(Pembayaran $sppsiswa, $id_pembayaran)
    {
        $pembayaran = $sppsiswa->find($id_pembayaran);
        // ini buat nyari nip
        $guru = Gurustaff::where('id_nip', $pembayaran->id_nip)->first();
        //ini buat buat  nyari nis
        $nis = Siswa::where('NIS_Angkatan', $pembayaran->NIS_Angkatan)->first();
        return view('/siswa/sppsiswa/pembayaran')->with([
            'id_pembayaran' => $pembayaran->id_pembayaran,
            'nis' => optional($nis)->NIS,
            'bulan' => $pembayaran->bulan,
            'total_tagihan' => $pembayaran->total_tagihan,
            'tgl_pembayaran' => $pembayaran->tgl_pembayaran,
            'bukti_pembayaran' => $pembayaran->bukti_pembayaran,
            'total_pembayaran' => $pembayaran->total_pembayaran,
        ]);
    }

    public function update(UpdatePembayaranRequest $request, Pembayaran $sppsiswa, $id_pembayaran)
    {
        // Ambil data pembayaran berdasarkan ID
        $pembayaran = Pembayaran::findOrFail($id_pembayaran);

        // Update data pembayaran
        $pembayaran->total_pembayaran = $request->total_pembayaran;
        $pembayaran->tgl_pembayaran = $request->tgl_pembayaran;
        $pembayaran->status = 'Menunggu Konfirmasi';

        // Upload dan update bukti pembayaran jika diunggah
        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti', 'public');
            $pembayaran->bukti_pembayaran = $buktiPembayaranPath;
        }

        // Simpan perubahan dan cek apakah simpan berhasil
        if ($pembayaran->save()) {
            return redirect()->route('/siswa/sppsiswa/index')->with('success', 'Pembayaran berhasil');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat pembayaran');
        }


    }

}
