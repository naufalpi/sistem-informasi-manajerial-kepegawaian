<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardLihatPresensiController extends Controller
{
    public function index()
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

        $presensiData = $this->getPresensiData();

        return view('dashboard.lihat-presensi.index', compact('presensiUsers', 'presensiData'));
    }

    private function getPresensiData()
{
    // Ambil data presensi dari database sesuai kebutuhan
    $presensi = Presensi::where('tanggal', '>=', Carbon::now()->subDays(6))
        ->orderBy('tanggal')
        ->get();

    // Buat array kosong untuk menyimpan data tanggal, status hadir, dan status tidak hadir
    $tanggalData = [];
    $statusHadirData = [];
    $statusTidakHadirData = [];

    // Iterasi setiap data presensi
    foreach ($presensi as $item) {
        // Ubah format tanggal jika perlu
        $tanggal = Carbon::parse($item->tanggal)->format('d-m-Y');
        
        // Tambahkan tanggal ke array tanggalData jika belum ada
        if (!in_array($tanggal, $tanggalData)) {
            $tanggalData[] = $tanggal;
        }

        // Hitung jumlah presensi berdasarkan status hadir dan tidak hadir
        if ($item->status == 1) {
            // Jika status hadir, tambahkan 1 ke statusHadirData
            $statusHadirData[] = 1;
            $statusTidakHadirData[] = 0;
        } else {
            // Jika status tidak hadir, tambahkan 1 ke statusTidakHadirData
            $statusHadirData[] = 0;
            $statusTidakHadirData[] = 1;
        }
    }

    return [
        'tanggal' => $tanggalData,
        'status_hadir' => $statusHadirData,
        'status_tidak_hadir' => $statusTidakHadirData
    ];
}



}
