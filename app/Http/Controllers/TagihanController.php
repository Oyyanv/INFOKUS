<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use App\Models\Siswa;
use App\Models\Tagihan;
use Carbon\Carbon;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihan = Tagihan::all();
        return view('admin/datatagihan/index', compact('tagihan'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagihanRequest $request)
    {

// Ambil semua siswa
        $siswas = Siswa::all();

        foreach ($siswas as $siswa) {
            // Ambil bulan saat ini
            $bulanSaatIni = Carbon::now()->format('F');

            // Periksa apakah siswa sudah membayar untuk bulan ini
            $tagihanSudahBayar = $siswa->pembayaran()
                ->where('status', 'Lunas')
                ->where('tgl_pembayaran', 'like', Carbon::now()->format('Y-m') . '%')
                ->exists();

            if (!$tagihanSudahBayar) {
                // Jika siswa belum membayar untuk bulan ini, cek apakah sudah ada tagihan bulan ini
                $tagihanBulanIni = $siswa->pembayaran()
                    ->where('bulan', $bulanSaatIni)
                    ->where('status', 'Belum Bayar')
                    ->first();

                if ($tagihanBulanIni) {
                    // Jika sudah ada tagihan untuk bulan ini, tambahkan tagihan tersebut
                    $tagihanBulanIni->update([
                        'tagihan' => $tagihanBulanIni->tagihan + $request->tagihan,
                    ]);
                } else {
                    // Jika belum ada tagihan untuk bulan ini, buat tagihan baru
                    $tagihan = Tagihan::create([
                        'tagihan' => $request->tagihan,
                        'bulan' => $bulanSaatIni,
                    ]);

                    // Simpan ID tagihan ke dalam tabel pembayarans untuk setiap siswa
                    $siswa->pembayaran()->create([
                        'id_tagihan' => $tagihan->id_tagihan,
                        'tgl_pembayaran' => null,
                        'bukti_pembayaran' => null,
                        'total_pembayaran' => $request->tagihan,
                        'status' => 'Belum Bayar',
                    ]);
                }
            }
        }

        return redirect()->route('/admin/datatagihan/index')
            ->with('success', 'Data Tagihan Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan, $id_tagihan)
    {
        $datatagihan = $tagihan->find($id_tagihan);
        return view('/admin/datatagihan/edittagihan')->with([
            'id_tagihan' => $datatagihan->id_tagihan,
            'tagihan' => $datatagihan->tagihan,
            'bulan' => $datatagihan->bulan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagihanRequest $request, Tagihan $tagihan, $id_tagihan)
    {
        $updatetagihan = $tagihan->find($id_tagihan);
        //yang kiri dari field data base
        //                          kanan field form editortu tadi ribet banget
        $updatetagihan->tagihan = $request->tagihan;
        $updatetagihan->bulan = $request->bulan;
        $updatetagihan->save();

        return redirect()->route('/admin/datatagihan/index')
            ->with('success', 'Data Tagihan Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Tagihan $tagihan, $id_tagihan)
    {
        $hapustagihan = $tagihan->find($id_tagihan);
        $hapustagihan->delete();

        return redirect()->route('/admin/datatagihan/index')
            ->with('success', 'Tagihan Berhasil Di Hapus');
    }
}
