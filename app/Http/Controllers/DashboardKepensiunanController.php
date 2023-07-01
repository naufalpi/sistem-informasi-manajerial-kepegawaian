<?php

namespace App\Http\Controllers;

use App\Models\Kepensiunan;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;

class DashboardKepensiunanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now(); // Get the current date and time

        $users = User::all()->map(function ($user) use ($now) {
            $tgl_lahir = Carbon::parse($user->tgl_lahir); // Convert the birthdate string to a Carbon object
            $umur = $now->diffInYears($tgl_lahir); // Calculate the age difference in years

            // Add a new "umur" property to the user object
            $user->umur = $umur;

            return $user;
        })->sortByDesc('umur'); // Sort the users by the "umur" property in descending order

        return view('dashboard.kepensiunan.index', compact('users'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kepensiunan.create',[
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
            'nomor' => 'required|max:255',
            'jml_lampiran' => 'required|max:255',
            'perihal' => 'required|max:255',
            'penyebab' => 'required|max:255',
            'camat' => 'required|max:255',
            'kepala_desa' => 'required|max:255',
            'nomor_kkd' => 'required|max:255',
            'tanggal_kkd' => 'required|max:255',
            'perangkat_desa' => 'required|max:255',
            'lampiran' => 'required'
            
        ]);


        $kepensiunan = new Kepensiunan;
        $kepensiunan->tgl_surat = $request->tgl_surat;
        $kepensiunan->nomor = $request->nomor;
        $kepensiunan->jml_lampiran = $request->jml_lampiran;
        $kepensiunan->perihal = $request->perihal;
        $kepensiunan->penyebab = $request->penyebab;
        $kepensiunan->camat = $request->camat;
        $kepensiunan->perangkat_desa = $request->perangkat_desa;
        $kepensiunan->kepala_desa = $request->kepala_desa;
        $kepensiunan->nomor_kkd = $request->nomor_kkd;
        $kepensiunan->tanggal_kkd = $request->tanggal_kkd;
        // Mengambil nama jabatan lama berdasarkan ID
        $jabatan = Jabatan::find($request->jabatan);
        $kepensiunan->jabatan = $jabatan ? $jabatan->name : null;
        

        $kepensiunan->lampiran = $request->lampiran;

        $kepensiunan->save();

        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');

        $kepensiunan = Kepensiunan::latest()->first();
        $kepensiunan->tgl_surat_formatted = Carbon::parse($kepensiunan->tgl_surat)->translatedFormat('d F Y');
        $kepensiunan->tanggal_kkd_formatted = Carbon::parse($kepensiunan->tanggal_kkd)->translatedFormat('d F Y');

        $pdf = PDF::loadView('dashboard.kepensiunan.pdf', compact('kepensiunan'));
        $pdf->setPaper('A4', 'portrait');

        // Simpan file PDF ke dalam storage
        $filename = 'surat-kepensiunan-' . time() . '.pdf';
        $pdf->save(storage_path('app/public/' . $filename));

        // Kembalikan file PDF yang dihasilkan sebagai respons download
        return response()->download(storage_path('app/public/' . $filename))->deleteFileAfterSend(true);

    

        
    }
}
