<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Ortu;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{

    public function index()
    {
        $siswa = Siswa::paginate(100);
        return view('admin.datasiswa.index', compact('siswa'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSiswaRequest $request)
    {

        // cek siswa dengan NIS yang sama
        $siswasama = Siswa::where('NIS', $request->nis)
            ->where('kelas', $request->kelas)
            ->where('Angkatan', $request->angkatan)
            ->first();

        // cek email yang sama
        $emailSama = User::where('email', $request->nis . '@smktelkom-bjb.sch.id')->first();

        // Jika siswa dengan NIS atau email yang sama tidak ditemukan, buat baru
        if (!$siswasama) {
            // Jika NIK diisi tetapi tidak valid (tidak ada di tabel ortu), tampilkan error
            $orangtua = null;
            if ($request->nik) {
                $orangtua = Ortu::where('NIK', $request->nik)->first();

                if (!$orangtua) {
                    return redirect()->back()
                        ->with('error', 'Orang Tua Dengan NIK Yang Diinput Tidak Ditemukan.');
                }
            }

            $incrementnis = Siswa::where('NIS_Angkatan', 'like', $request->nis . "_" . $request->angkatan . '_%')
            ->max(DB::raw('CAST(SUBSTRING_INDEX(NIS_Angkatan, "_", -1) AS UNSIGNED)'));
        
            $increment = $incrementnis ? $incrementnis + 1 : 1;

            // Buat data siswa
            $siswaData = [
                'NIS_Angkatan' => $request->nis . "_" . $request->angkatan . "_" . $increment,
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
            $siswa = Siswa::create($siswaData);
            if ($emailSama) {

                return redirect()->route('/admin/datasiswa/index')
                    ->with('success', 'Data Siswa Berhasil Ditambahkan');
            }

            // dan buat akunnya
            User::create([
                'email' => $siswa->NIS . '@smktelkom-bjb.sch.id', // Email dari NIS siswa
                'password' => $siswa->NIS . $siswa->Angkatan,
                'status' => 'siswa', // Tambahkan status siswa
            ]);

            return redirect()->route('/admin/datasiswa/index')
                ->with('success', 'Data Siswa Berhasil Ditambahkan');
        } else {
            return redirect()->back()
                ->with('success', 'Siswa dengan NIS, Kelas, dan Angkatan sudah terdaftar.');
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
        $request->validate([
            'nik' => 'nullable|numeric|digits:16',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ]);

        
        // Ambil data siswa berdasarkan NIS_Angkatan
        // $siswas = Siswa::findOrFail('NIS_Angkatan', $NIS_Angkatan);
        // dd($siswa);
        $siswas = Siswa::where('NIS_Angkatan', 'like', $request->nis . "_" . $request->angkatan . '_%')
        ->orderBy(DB::raw('CAST(SUBSTRING_INDEX(NIS_Angkatan, "_", -1) AS UNSIGNED)'), 'desc')
        ->firstOrFail();
    
        $orangtua = null;
        if ($request->nik) {
            $orangtua = Ortu::where('NIK', $request->nik)->first();
            // dd($orangtua);
            // Jika NIK diisi tetapi tidak valid (tidak ada di tabel ortu), tampilkan error
            if (!$orangtua) {
                return redirect()->back()
                    ->with('error', 'Orang Tua Dengan NIK Yang Diinput Tidak Ditemukan.');
            }
            //kalo ada
            $siswas->NIK_Orangtua = $orangtua->NIK_Orangtua;
        }else{
            // kalo gk ada null
            $siswas->NIK_Orangtua = null;
        }

        $siswas->NIS_Kelas = $request->nis . "_" . $request->kelas;
        $siswas->Nama = $request->nama;
        $siswas->Jurusan = $request->jurusan;
        $siswas->kelas = $request->kelas;

        // Simpan perubahan
        $siswas->save();

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
        $user = User::where('email', $siswahapus->NIS . '@smktelkom-bjb.sch.id')->first();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('/admin/datasiswa/index')
            ->with('success', 'Data Siswa Berhasil Di Hapus');
    }

    public function detail(Siswa $siswa, $NIS_Angkatan)
    {
    
        $siswaDetail = Siswa::with('ortu')->where('NIS_Angkatan', $NIS_Angkatan)->first();
    
        return response()->json($siswaDetail);
    }

     public function search(Request $request)
    {
        $search = $request->search;
    
        $siswaSearch = Siswa::where('NIS_Angkatan', 'like', "%" . $search . "%")
        ->orWhere('NIS_Kelas', 'like', "%" . $search . "%")
        ->orWhere('NIS', 'like', "%" . $search . "%")
        ->orWhere('Nama', 'like', "%" . $search . "%")
        ->orWhere('kelas', 'like', "%" . $search . "%")
        ->orWhere('Jurusan', 'like', "%" . $search . "%")
        ->orWhere('Angkatan', 'like', "%" . $search . "%")
        ->orWhere('jk', 'like', "%" . $search . "%")
        ->paginate(7);
        
        
        return view('admin.datasiswa.index', ['siswa' => $siswaSearch]);

    
    }


}
