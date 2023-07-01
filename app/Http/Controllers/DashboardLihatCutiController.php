<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardLihatCutiController extends Controller
{
    public function index()
    {

        Carbon::setLocale('id');

        return view('dashboard.lihat-cuti.index', [
            'cutis' => Cuti::with('user')
                ->orderBy('tgl_mulai', 'desc')  
                ->get()->map(function ($cuti) {
                    $cuti->tgl_mulai = Carbon::parse($cuti->tgl_mulai)->translatedFormat('d F Y');
                    $cuti->tgl_selesai = Carbon::parse($cuti->tgl_selesai)->translatedFormat('d F Y');
                    return $cuti;
                }),
        ]);
    }
}
