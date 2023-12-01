<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Ortu;
use App\Models\Siswa;
use App\Models\User;

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
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {

        // Ini untuk variabel baru untuk mengecek apakah ada siswa dengan nis kelas angkatan yang sama
        $siswasama = Siswa::where('NIS', $request->nis)
            ->where('kelas', $request->kelas)
            ->where('Angkatan', $request->angkatan)
            ->first();

        // Jika orang tua tidak ditemukan, berikan respons atau lakukan penanganan yang sesuai
        $orangtua = null;
        if ($request->nik) {
            $orangtua = Ortu::where('NIK', $request->nik)->first();

            // Jika NIK diisi tetapi tidak valid (tidak ada di tabel ortu), tampilkan error
            if (!$orangtua) {
                return redirect()->back()
                    ->with('error', 'Orang Tua Dengan NIK Yang Diinput Tidak Ditemukan.');
            }
        }

            // Jika siswa dengan NIS, kelas, dan angkatan yang sama tidak ditemukan, buat baru
        if (!$siswasama) {
            $siswaData = [
                'NIS_Angkatan' => $request->nis . "_" . $request->angkatan,
                'NIS_Kelas' => $request->nis . "_" . $request->kelas,
                'NIS' => $request->nis,
                'Nama' => $request->nama,
                'kelas' => $request->kelas,
                'Jurusan' => $request->jurusan,
                'Angkatan' => $request->angkatan,
                'jk' => $request->jk,
            ];

            // Cek apakah NIK orang tua ada atau tidak
            if ($orangtua) {
                $siswaData['NIK_Orangtua'] = $orangtua->NIK_Orangtua;
            } else {
                $siswaData['NIK_Orangtua'] = null; // Misalnya jika NIK tidak diisi, set null
            }

            // Buat data siswa
            $siswa = Siswa::create($siswaData);
            //dan buat akunnya
            User::create([
                'email' => $siswa->NIS . '@smktelkom-bjb.sch.id', // Email dari NIS siswa
                'password' => $siswa->NIS . $siswa->Angkatan,
                'status' => 'siswa', // Tambahkan status siswa
            ]);

            return redirect()->route('/admin/datasiswa/index')
                ->with('success', 'Data Siswa Berhasil Ditambahkan');
        } else {
            // Jika siswa dengan NIS, kelas, dan angkatan yang sama sudah ada, tampilkan error
            return redirect()->back()
                ->with('error', 'Siswa dengan NIS, Kelas Dan Angkatan Sudah Ada.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa, $NIS_Angkatan)
    {
        $datasiswa = $siswa->find($NIS_Angkatan);
        $ortusiswa = Ortu::where('NIK_Orangtua', $datasiswa->NIK_Orangtua)->first();
        return view('/admin/datasiswa/editsiswa')->with([
            'NIS_Angkatan' => $datasiswa->NIS . "_" . $datasiswa->Angkatan,
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
    public function update(UpdateSiswaRequest $request, Siswa $siswa, $NIS_Angkatan)
    {
        // Ambil data siswa berdasarkan NIS_Angkatan
        $siswa = Siswa::where('NIS_Angkatan', $NIS_Angkatan)->first();

        // Inisialisasi variabel orangtua
        $orangtua = null;

        if ($request->filled('nik')) {
            // Jika NIK disediakan, cari orang tua berdasarkan NIK
            $orangtua = Ortu::where('NIK', $request->nik)->first();

            if (!$orangtua) {
                return redirect()->back()->with('error', 'Orang Tua Dengan NIK Yang Diinput Tidak Ditemukan.');
            }
        }
        $siswa->NIS_Kelas = $request->nis ."_". $request->kelas;
        $siswa->Nama = $request->nama;
        $siswa->Jurusan = $request->jurusan;
        $siswa->kelas = $request->kelas;
        $siswa->NIK_Orangtua = $orangtua ? $orangtua->NIK_Orangtua : null;

        // Simpan perubahan
        $siswa->save();

        return redirect('/admin/datasiswa/index')->with('success', 'Data Siswa Berhasil Diupdate.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Siswa $siswa, $NIS_Angkatan)
    {
        $siswahapus = $siswa->find($NIS_Angkatan);
        $siswahapus->delete();

        // buat ngecek siswa ada user gk di table user lewat email gabungan dari NIS + @smktelkom-bjb.sch.id
        $user = User::where('email',$siswahapus->NIS.'@smktelkom-bjb.sch.id')->first();
        if($user){
            $user->delete();
        }

        return redirect()->route('/admin/datasiswa/index')
            ->with('success', 'Data Siswa Berhasil Di Hapus');
    }
}
