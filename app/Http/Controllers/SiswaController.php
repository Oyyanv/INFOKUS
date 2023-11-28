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
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required|numeric',
            'nik' => 'required|numeric',
        ]);

        $orangtua = Ortu::where('NIK', $request->nik)->first();
        //ini buat variabel baru buat nge cek ada gk siswa yg nis sama kelas nya itu sama
        $siswasama = Siswa::Where('NIS', $request->nis)->where('kelas', $request->kelas)->first();
        // Jika orang tua tidak ditemukan, berikan respon atau lakukan penanganan yang sesuai
        if (!$orangtua) {
            return redirect()->back()
                ->with('error', 'Orang Tua dengan NIK yang diinput tidak ditemukan.');
        }
        //jika gak ada maka buat baru
        if(!$siswasama){
        Siswa::create([
            'NIS_Kelas' => $request->nis . "_" . $request->kelas,
            'NIS' => $request->nis,
            'Nama' => $request->nama,
            'kelas' => $request->kelas,
            'Jurusan' => $request->jurusan,
            'Angkatan' => $request->angkatan,
            'NIK_Orangtua' => $orangtua->NIK_Orangtua, // Ambil nilai NIK_Orangtua dari orang tua yang ditemukan
        ]);

        return redirect()->route('/admin/datasiswa/index')
            ->with('success', 'Data Berhasil Ditambahkan');
            //jika ada error
        }else{
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
            'NIS' => $datasiswa->NIS,
            'NIK' => optional($ortusiswa)->NIK, // Pastikan NIK diambil dari tabel orang tua
            'Nama' => $datasiswa->Nama,
            'kelas' => $datasiswa->kelas,
            'Jurusan' => $datasiswa->Jurusan,
            'Angkatan' => $datasiswa->Angkatan,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, Siswa $siswa, $NIS_Kelas)
    {
        // Ambil data siswa
        $siswa = Siswa::find($NIS_Kelas);
        $orangtua = Ortu::where('NIK', $request->nik)->first();
        if (!$orangtua) {
            return redirect()->back()
                ->with('error', 'NIK yang diinput tidak ditemukan.');
        }

        $siswa->NIS = $request->nis;
        $siswa->NIK_Orangtua = $orangtua->NIK_Orangtua;
        $siswa->Nama = $request->nama;
        $siswa->kelas = $request->kelas;
        $siswa->Angkatan = $request->angkatan;
        $siswa->Jurusan = $request->jurusan;
        $siswa->save();

        return redirect('/admin/datasiswa/index')->with('success', 'Data Siswa Berhasil Di Update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Siswa Berhasil Di Hapus');
    }
}
