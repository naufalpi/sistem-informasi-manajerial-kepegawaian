<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;

class DashboardMutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.mutasi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.mutasi.create',[
            'jabatans' => Jabatan::where('id', '!=', 1)->get(),
            'kades' => User::where('jabatan_id', 1)->pluck('name')->first(),
            'users' => User::where('jabatan_id', '!=', 1)->pluck('name'),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tgl_surat' => 'required|max:255',
            'tgl_musyawarah' => 'required|max:255',
            'nomor' => 'required|max:255',
            'jml_lampiran' => 'required|max:255',
            'perihal' => 'required|max:255',
            'camat' => 'required|max:255',
            'kepala_desa' => 'required|max:255',
            'perangkat_desa' => 'required|max:255',
            'jabatan_lama' => 'required|max:255',
            'jabatan_baru' => 'required|max:255',
            'lampiran' => 'required'
            
        ]);


        $mutasi = new Mutasi;
        $mutasi->tgl_surat = $request->tgl_surat;
        $mutasi->nomor = $request->nomor;
        $mutasi->jml_lampiran = $request->jml_lampiran;
        $mutasi->perihal = $request->perihal;
        $mutasi->camat = $request->camat;
        $mutasi->tgl_musyawarah = $request->tgl_musyawarah;
        $mutasi->perangkat_desa = $request->perangkat_desa;
        $mutasi->kepala_desa = $request->kepala_desa;
        // Mengambil nama jabatan lama berdasarkan ID
        $jabatanLama = Jabatan::find($request->jabatan_lama);
        $mutasi->jabatan_lama = $jabatanLama ? $jabatanLama->name : null;
        
        // Mengambil nama jabatan baru berdasarkan ID
        $jabatanBaru = Jabatan::find($request->jabatan_baru);
        $mutasi->jabatan_baru = $jabatanBaru ? $jabatanBaru->name : null;

        $mutasi->lampiran = $request->lampiran;

        $mutasi->save();

        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');

        $mutasi = Mutasi::latest()->first();
        $mutasi->tgl_surat_formatted = Carbon::parse($mutasi->tgl_surat)->translatedFormat('d F Y');
        $mutasi->tgl_musyawarah_formatted = Carbon::parse($mutasi->tgl_musyawarah)->translatedFormat('d F Y');

        $pdf = PDF::loadView('dashboard.mutasi.pdf', compact('mutasi'));
        $pdf->setPaper('A4', 'portrait');

        // Simpan file PDF ke dalam storage
        $filename = 'surat-rekomendasi-' . time() . '.pdf';
        $pdf->save(storage_path('app/public/' . $filename));

        // Kembalikan file PDF yang dihasilkan sebagai respons download
        return response()->download(storage_path('app/public/' . $filename))->deleteFileAfterSend(true);

    

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function show(Mutasi $mutasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Mutasi $mutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mutasi  $mutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mutasi $mutasi)
    {
        //
    }
}
