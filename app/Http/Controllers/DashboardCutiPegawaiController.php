<?php

namespace App\Http\Controllers;

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
        return view('dashboard.cuti.pegawai.index', [
            'cutis' => Cuti::where('user_id', auth()->user()->id)->get()
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
