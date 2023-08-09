<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cuti;
use Illuminate\Http\Request;

class DashboardCutiAdminController extends Controller
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

        return view('dashboard.cuti.admin.index', [
            'cutis' => Cuti::with('user')
                ->orderBy('tgl_mulai', 'desc')
                ->get()->map(function ($cuti) {
                    $cuti->total_hari = Carbon::parse($cuti->tgl_selesai)->diffInDays($cuti->tgl_mulai) + 1;
                    $cuti->tgl_mulai = Carbon::parse($cuti->tgl_mulai)->translatedFormat('d F Y');
                    $cuti->tgl_selesai = Carbon::parse($cuti->tgl_selesai)->translatedFormat('d F Y');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function show(Cuti $cuti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuti $cuti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuti $cuti)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuti  $cuti
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuti $cuti)
    {
        //
    }

    public function approve(Cuti $cuti)
    {
        $cuti->update(['status' => true]);

        return redirect('/dashboard/cuti/admin')->with('success', 'Pengajuan cuti berhasil disetujui');
    }

    public function reject(Request $request, Cuti $cuti)
    {
        $cuti->update([
            'status' => false,
            'pesan' => $request->input('pesan') // Ambil pesan dari form
        ]);

        return redirect('/dashboard/cuti/admin')->with('success', 'Pengajuan cuti berhasil ditolak');
    }
}
