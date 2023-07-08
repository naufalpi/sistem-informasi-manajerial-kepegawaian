<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DashboardKelolaPresensiController extends Controller
{

    public function index()
    {
        return view('dashboard.kelola-presensi.index');
    } 


    public function show()
    {
        Carbon::setLocale('id');
        $presensiUsers = Presensi::whereNotIn('user_id', [1])
            ->orderByDesc('tanggal')
            ->orderByDesc('waktu_masuk')
            ->get();

        foreach ($presensiUsers as $presensi) {
            $tanggal = Carbon::parse($presensi->tanggal)->isoFormat('DD MMMM YYYY');
            $presensi->tanggal = $tanggal;
            $hari = Carbon::parse($presensi->tanggal)->isoFormat('dddd');
            $presensi->hari = $hari;
        }

        return view('dashboard.kelola-presensi.show', compact('presensiUsers'));
    }

    


    public function buka(Request $request)
    {
        $sesiTerakhir = Sesi::latest()->first(); // Ambil sesi terakhir
    
        // Periksa apakah sesi terakhir masih berlaku
        if ($sesiTerakhir && Carbon::now()->lte($sesiTerakhir->expire_at)) {
            // Jika sesi terakhir masih berlaku, kembalikan response dengan kode dan waktu kedaluwarsa sesi yang sama
            return redirect()->route('dashboard.kelola-presensi.show')
                ->with('kodePresensi', $sesiTerakhir->code)
                ->with('expireTime', $sesiTerakhir->expire_at);
        }
    
        // Jika sesi terakhir tidak ada atau telah kedaluwarsa, buat sesi baru
        $kodePresensi = Str::random(6); // Generate kode presensi secara acak
        $expireTime = Carbon::now()->addMinutes(15); // Waktu kedaluwarsa sesi (15 menit)
    
        $sesi = new Sesi();
        $sesi->code = $kodePresensi;
        $sesi->expire_at = $expireTime;
        $sesi->save();
    
        $users = User::all();
    
        foreach ($users as $user) {
            // Periksa apakah presensi dengan tanggal yang sama sudah ada
            $presensiSama = Presensi::where('user_id', $user->id)
                ->where('tanggal', Carbon::now()->toDateString())
                ->first();
        
            if ($presensiSama) {
                // Jika presensi dengan tanggal yang sama sudah ada, update sesi_id menjadi sesi baru
                $presensiSama->sesi_id = $sesi->id;
                $presensiSama->save();
            } else {
                // Jika presensi dengan tanggal yang sama belum ada, tambahkan presensi baru
                $presensi = new Presensi();
                $presensi->user_id = $user->id;
                $presensi->sesi_id = $sesi->id;
                $presensi->tanggal = Carbon::now()->toDateString();
                $presensi->waktu_masuk = Carbon::now()->toTimeString();
                $presensi->status = 0; // Atur status awal sesuai kebutuhan
                $presensi->save();
            }
        }
        
    
        $this->hapusSesiKedaluwarsa();
        
        return redirect()->route('dashboard.kelola-presensi.show')
            ->with('kodePresensi', $kodePresensi)
            ->with('expireTime', $expireTime);
    }
    



    public function hapusSesiKedaluwarsa()
    {
        $now = Carbon::now();

        // Hapus sesi yang telah kedaluwarsa
        Sesi::where('expire_at', '<=', $now)->delete();
    }

}
