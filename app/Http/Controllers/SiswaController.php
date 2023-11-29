<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Ortu;
use App\Models\Siswa;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return view('admin.datasiswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {

        $orangtua = Ortu::where('NIK', $request->nik)->first();
        //ini buat variabel baru buat nge cek ada gk siswa yg nis sama kelas nya itu sama
        $siswasama = Siswa::Where('NIS', $request->nis)->where('kelas', $request->kelas)->first();

        // Jika orang tua tidak ditemukan, berikan respon atau lakukan penanganan yang sesuai
        // if (!$orangtua) {
        //     return redirect()->back()
        //         ->with('error', 'Orang Tua dengan NIK yang diinput tidak ditemukan.');
        // }

        //jika gak ada maka buat baru
        if (!$siswasama) {
            $siswaData = [
                'NIS_Kelas' => $request->nis . "_" . $request->kelas,
                'NIS' => $request->nis,
                'Nama' => $request->nama,
                'kelas' => $request->kelas,
                'Jurusan' => $request->jurusan,
                'Angkatan' => $request->angkatan,
            ];

            // cek niknya ada atau engak
            if ($orangtua) {
                $siswaData['NIK_Orangtua'] = $orangtua->NIK_Orangtua;
            } else {
                $siswaData['NIK_Orangtua'] = null; // misal kalo nik nya ga ada skip
            }

            // buat data siswanya
            Siswa::create($siswaData);

            return redirect()->route('/admin/datasiswa/index')
                ->with('success', 'Data Berhasil Ditambahkan');
        } else {
            //kalo misalnya ada data siswa dengan nis dan kelas yg sama itu error karena pk kita itu gabungan dari nis+kelas
            return redirect()->back()
                ->with('error', 'Siswa dengan NIS dan kelas yang sama sudah ada.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa, $NIS_Kelas)
    {
        $datasiswa = $siswa->find($NIS_Kelas);
        $ortusiswa = Ortu::where('NIK_Orangtua', $datasiswa->NIK_Orangtua)->first();

        return view('/admin/datasiswa/editsiswa')->with([
            'NIS_Kelas' => $datasiswa->NIS . "_" . $datasiswa->kelas,
            'nis' => $datasiswa->NIS,
            'nik' => optional($ortusiswa)->NIK, // Pastikan NIK diambil dari tabel orang tua
            'nama' => $datasiswa->Nama,
            'kelas' => $datasiswa->kelas,
            'jurusan' => $datasiswa->Jurusan,
            'angkatan' => $datasiswa->Angkatan,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa, $NIS_Kelas)
    {
        // Ambil data siswa berdasarkan NIS_Kelas
        $siswa = Siswa::where('NIS_Kelas', $NIS_Kelas)->first();

        // ini gatau fungsinya buat apa
        // if (!$siswa) {
        //     return redirect()->back()->with('error', 'Data siswa tidak ditemukan.');
        // }

        // Ambil data orang tua berdasarkan NIK
        $orangtua = Ortu::where('NIK', $request->nik)->first();

        //cek dulu apakah orang tua ditemukan
        if (!$orangtua) {
            return redirect()->back()->with('error', 'NIK yang diinput tidak ditemukan.');
        }

        // Update nilai NIS dan kelas
        $siswa->NIS = $request->nis;
        $siswa->NIK_Orangtua = $orangtua->NIK_Orangtua;
        $siswa->Nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->Angkatan = $request->angkatan;
        $siswa->Jurusan = $request->jurusan;

        // update datanya
        $siswa->save();

        return redirect('/admin/datasiswa/index')->with('success', 'Data siswa berhasil diupdate.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Siswa $siswa, $NIS_Kelas)
    {
        $siswahapus = $siswa->find($NIS_Kelas);
        $siswahapus->delete();

        return redirect()->route('/admin/datasiswa/index')
            ->with('success', 'Data Siswa Berhasil Di Hapus');
    }
}
