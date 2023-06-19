<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use Illuminate\Http\Request;

class DashboardCutiPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
        
        return view('dashboard.cuti.pegawai.index', [
            'cutis' => Cuti::where('user_id', auth()->user()->id)
                ->latest()
                ->get()->map(function ($cuti) {
                    $cuti->tanggal = Carbon::parse($cuti->tanggal)->translatedFormat('d F Y');
                    return $cuti;
                }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cuti.pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'keperluan' => 'required|string|max:255',
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Cuti::create($validatedData);

        return redirect('/dashboard/cuti/pegawai')->with('success', 'Pengajuan cuti berhasil dikirim!');
    }

    public function approve(Cuti $cuti)
    {
        $cuti->update(['status' => true]);

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil disetujui');
    }

    public function reject(Cuti $cuti)
    {
        $cuti->update(['status' => false]);

        return redirect()->route('cuti.index')->with('success', 'Pengajuan cuti berhasil ditolak');
    }
    
}
