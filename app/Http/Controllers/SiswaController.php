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

        // Jika orang tua tidak ditemukan, berikan respon atau lakukan penanganan yang sesuai
        if (!$orangtua) {
            return redirect()->back()
                ->with('error', 'Orang Tua dengan NIK yang diinput tidak ditemukan.');
        }

        // Check apakah orang tua sudah menjadi orang tua dari siswa lain
        // $siswaDenganOrangTuaIni = Siswa::where('NIK_Orangtua', $orangtua->NIK_Orangtua)->first();

        // // Jika ditemukan siswa dengan orang tua yang sama, berikan respon atau lakukan penanganan yang sesuai
        // if ($siswaDenganOrangTuaIni) {
        //     return redirect()->back()
        //         ->with('error', 'Orang Tua dengan NIK yang diinput sudah Ada.');
        // }
        // Simpan data ke dalam database
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

        // Validasi data dari form
        $request->validate([
            'nis' => 'required|numeric',
            'nik' => 'required|numeric', // Sesuaikan dengan aturan validasi Anda
            'nama' => 'required', // Sesuaikan dengan aturan validasi Anda
            'kelas' => 'required', // Sesuaikan dengan aturan validasi Anda
            'jurusan' => 'required', // Sesuaikan dengan aturan validasi Anda
            'angkatan' => 'required|', // Sesuaikan dengan aturan validasi Anda
        ]);

        // Cek apakah NIK orang tua sudah ada di tabel ortu
        $orangtua = Ortu::where('NIK', $request->input('NIK'))->first();

        // Jika NIK orang tua tidak ditemukan
        return redirect()->route('/admin/datasiswa/update', ['NIS_Kelas' => $NIS_Kelas])
            ->withInput()
            ->withErrors(['NIK' => 'NIK orang tua tidak ditemukan di tabel orangtua.']);

        // Simpan data siswa
        $siswa->update([
            'NIK_Orangtua' => $orangtua->NIK_Orangtua,
            'nis' => $request->input('nis'),
            'nik' => $request->input('nik'),
            'nama' => $request->input('nama'),
            'kelas' => $request->input('kelas'),
            'jurusan' => $request->input('jurusan'),
            'angkatan' => $request->input('angkatan'),
        ]);

        return redirect()->route('/admin/datasiswa/index')->with('success', 'Data siswa berhasil diperbarui.');
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
