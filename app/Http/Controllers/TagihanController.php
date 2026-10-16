<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use App\Models\Siswa;
use App\Models\Tagihan;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tagihan = Tagihan::paginate(7);
        return view('admin/datatagihan/index', compact('tagihan'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagihanRequest $request)
    {

        $tagihanBulanIni = Tagihan::where('bulan', $request->bulan)->first();

        if (!$tagihanBulanIni) {
            // Jika belum ada tagihan, buat tagihan baru
            $tagihanBulanIni = Tagihan::create([
                'tagihan' => $request->tagihan,
                'bulan' => $request->bulan,
            ]);
        }

        $siswas = Siswa::all();

        foreach ($siswas as $siswa) {
            // Periksa apakah siswa sudah membayar untuk tagihan ini
            $tagihanSudahBayar = $siswa->pembayaran()
                ->where('status', 'Lunas')
                ->where('bulan', $tagihanBulanIni->bulan)
                ->exists();
        
            if (!$tagihanSudahBayar) {
                // Pemeriksaan tambahan: Apakah tagihan sudah pernah ditambahkan untuk siswa ini?
                $tagihanSudahDitambahkan = $siswa->pembayaran()
                    ->where('bulan', $tagihanBulanIni->bulan)
                    ->exists();
        
                // Jika siswa belum membayar dan tagihan belum pernah ditambahkan
                if (!$tagihanSudahDitambahkan) {
                    // Jika siswa belum membayar, buat pembayaran untuk tagihan ini
                    $siswa->pembayaran()->create([
                        'tgl_pembayaran' => null,
                        'NIS' => $siswa->NIS,
                        'email' => $siswa->NIS."@smktelkom-bjb.sch.id",
                        'bukti_pembayaran' => null,
                        'total_pembayaran' => null,
                        'total_tagihan' => $tagihanBulanIni->tagihan,
                        'status' => 'Belum Bayar',
                        'bulan' => $tagihanBulanIni->bulan,
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

    public function search(Request $request)
    {
        $search = $request->search;
    
        $tagihanSearch = Tagihan::where('id_tagihan', 'like', "%" . $search . "%")
        ->orWhere('tagihan', 'like', "%" . $search . "%")
        ->orWhere('bulan', 'like', "%" . $search . "%")
        ->paginate(7);
        
        
        return view('admin.datatagihan.index', ['tagihan' => $tagihanSearch]);

    
    }
}
