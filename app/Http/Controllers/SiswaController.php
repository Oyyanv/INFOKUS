<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Models\Ortu;
use App\Models\Siswa;
use Illuminate\Http\Request;

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
        $siswaDenganOrangTuaIni = Siswa::where('NIK_Orangtua', $orangtua->NIK_Orangtua)->first();

        // Jika ditemukan siswa dengan orang tua yang sama, berikan respon atau lakukan penanganan yang sesuai
        if ($siswaDenganOrangTuaIni) {
            return redirect()->back()
                ->with('error', 'Orang Tua dengan NIK yang diinput sudah Ada.');
        }
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
    public function show(Siswa $siswa)
    {

        return view('admin/datasiswa/show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('admin/datasiswa/edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'NIK_Orangtua' => 'required|unique',
            'NIS' => 'required',
            'Nama' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
            'Angkatan' => 'required|numeric',
        ]);

        $siswa->update($request->all());
        return redirect()->route('admin/datasiswa/index')
            ->with('Success', 'Siswa Berhasil Di Update');
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
