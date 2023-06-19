<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardPresensiController extends Controller
{

    public function showAdminView()
    {
        return view('dashboard.kelola-presensi.admin');
    }

    public function showPresensiView()
    {
        return view('dashboard.presensi.presensi');
    }

    public function bukaPresensi()
    {
        $expiryTime = Carbon::now()->addMinutes(10);
        $qrCode = QrCode::size(250)->generate($expiryTime);

        return response()->json([
            'expiry_time' => $expiryTime,
            'qr_code' => $qrCode
        ]);
    }


    public function presensi(Request $request)
    {
        $qrData = $request->input('qr_data');
        $currentTime = Carbon::now();

        if ($currentTime <= $qrData) {
            $today = Carbon::today();

            // Memeriksa apakah pengguna sudah melakukan presensi pada tanggal yang sama
            $presensi = Presensi::where('pegawai_id', 1)
                                ->whereDate('tanggal', $today)
                                ->first();

            if (!$presensi) {
                Presensi::create([
                    'pegawai_id' => 1,
                    'tanggal' => $today,
                    'status' => 'hadir',
                    'waktu_masuk' => $currentTime
                ]);

                return response()->json(['message' => 'Presensi berhasil.']);
            } else {
                return response()->json(['message' => 'Anda sudah melakukan presensi hari ini.']);
            }
        } else {
            return response()->json(['message' => 'QR code telah kadaluarsa.']);
        }
    }

}
