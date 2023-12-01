<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGurustaffRequest;
use App\Http\Requests\UpdateGurustaffRequest;
use App\Models\Gurustaff;
use App\Models\User;

class GurustaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guru = Gurustaff::all();
        return view('admin/gurustaff/index', compact('guru'));
    }

    public function store(StoreGurustaffRequest $request)
    {
        // Cek apakah NIP sudah ada
        $existingNIP = Gurustaff::where('NIP', $request->nip)->first();
        if ($existingNIP) {
            return redirect()->back()
                ->with('error', 'NIP sudah digunakan. Harap masukkan NIP yang berbeda.');
        }

        // Cek apakah nama guru sudah ada
        $existingName = Gurustaff::where('nama', $request->nama)->first();
        if ($existingName) {
            return redirect()->back()
                ->with('error', 'Nama guru sudah digunakan. Harap masukkan nama guru yang berbeda.');
        }

        // Jika NIP dan nama guru unik, lanjutkan proses penyimpanan
        $guru = Gurustaff::create([
            'NIP' => $request->nip,
            'nama' => $request->nama,
            'status' => $request->status,
            'jk' => $request->jk,
        ]);

        $guru->save();

        // hapusin spasi dari input nama di form guru
        $hapusspasi = str_replace(' ', '', $guru->nama);
        User::create([
            'email' => $hapusspasi . '@smktelkom-bjb.sch.id', // Email dari nama guru
            'password' => "wargaskatel",
            'status' => 'admin',
        ]);

        return redirect()->route('/admin/gurustaff/index')
            ->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gurustaff $guru, $id_nip)
    {
        $dataguru = $guru->find($id_nip);
        return view('/admin/gurustaff/editgurustaff')->with([
            'id_nip' => $dataguru->id_nip,
            'nip' => $dataguru->NIP,
            'nama' => $dataguru->nama,
            'jk' => $dataguru->jk,
            'status' => $dataguru->status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGurustaffRequest $request, Gurustaff $guru, $id_nip)
    {
        $dataguru = $guru->find($id_nip);

        $dataguru->nama = $request->nama;
        $dataguru->jk = $request->jk;
        $dataguru->status = $request->status;
        return redirect()->route('/admin/gurustaff/index')
            ->with('success', 'Guru/Staff Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Gurustaff $guru, $id_nip)
    {
        $hapusdata = $guru->find($id_nip);
        $hapusdata->delete();

        // buat ngecek ada nama guru/staff user gk di table user lewat email gabungan dari nama + @smktelkom-bjb.sch.id
        $user = User::where('email', $hapusdata->nama . '@smktelkom-bjb.sch.id')->first();
        if ($user) {
            $user->delete();
        }

        return redirect()->route('/admin/gurustaff/index')
            ->with('success', 'Guru/Staff Berhasil Di Hapus');
    }
}
