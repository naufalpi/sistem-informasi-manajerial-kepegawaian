<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Presensi;
use App\Models\Sesi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardPresensiController extends Controller
{
    public function index()
    {
       

        Carbon::setLocale('id');
        $presensiUsers = Presensi::where('user_id', auth()->user()->id)
            ->orderByDesc('tanggal')
            ->get();

        foreach ($presensiUsers as $presensi) {
            $tanggal = Carbon::parse($presensi->tanggal)->isoFormat('DD MMMM YYYY');
            $presensi->tanggal = $tanggal;
            $hari = Carbon::parse($presensi->tanggal)->isoFormat('dddd');
            $presensi->hari = $hari;
        }
        
        return view('dashboard.presensi.index', compact('presensiUsers'));
    
    } 



    public function presensi(Request $request)
    {
        $kodePresensi = $request->input('kode_presensi');
        $user = Auth::user();

        // Periksa apakah sesi dengan kode presensi yang dimasukkan masih berlaku
        $sesi = Sesi::where('code', $kodePresensi)
            ->where('expire_at', '>=', Carbon::now())
            ->first();

        if ($sesi) {
            // Periksa apakah user sudah melakukan presensi pada sesi tersebut
            $presensi = Presensi::where('user_id', $user->id)
                ->where('sesi_id', $sesi->id)
                ->first();

            if ($presensi) {
                if ($presensi->status == 1) {
                    // Jika status presensi sudah 1 (sudah melakukan presensi sebelumnya), munculkan alert
                    return redirect()->back()->with('alert', 'Anda sudah melakukan presensi.');
                } else {
                    // Jika status presensi belum 1, update status menjadi 1
                    $presensi->status = 1;
                    $presensi->waktu_masuk = Carbon::now()->toTimeString();
                    $presensi->save();
                }
            } else {
                // Jika presensi belum ada, tambahkan presensi baru dengan status 1
                $presensiBaru = new Presensi();
                $presensiBaru->user_id = $user->id;
                $presensiBaru->sesi_id = $sesi->id;
                $presensiBaru->tanggal = Carbon::now()->toDateString();
                $presensiBaru->waktu_masuk = Carbon::now()->toTimeString();
                $presensiBaru->status = 1; // Status 1 menunjukkan presensi telah dilakukan
                $presensiBaru->save();
            }
        } else {
            // Jika sesi tidak ditemukan, munculkan alert
            return redirect()->back()->with('fail', 'Kode presensi tidak valid atau sudah kedaluwarsa.');
        }

        return redirect()->back()->with('success', 'Presensi berhasil.');
    }

    

    
}
