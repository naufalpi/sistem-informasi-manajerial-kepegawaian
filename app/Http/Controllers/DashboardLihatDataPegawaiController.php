<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Jabatan;
use Carbon\Carbon;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DashboardLihatDataPegawaiController extends Controller
{
    public function index()
    {
     
        return view('dashboard.lihat-pegawai.index', [
            'users' => User::with('jabatan')
                ->leftJoin('jabatans', 'users.jabatan_id', '=', 'jabatans.id')
                ->selectRaw("users.*, jabatans.name AS jabatan_name")
                ->orderByRaw("CASE WHEN users.jabatan_id = 1 THEN 1 WHEN users.jabatan_id = 2 THEN 2 ELSE 3 END, 
                    CASE WHEN jabatans.name LIKE 'Kasi%' THEN 1 WHEN jabatans.name LIKE 'Kaur%' THEN 2 WHEN jabatans.name LIKE 'Kadus%' THEN 3 ELSE 4 END")
                ->get()
        ]);

    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        Carbon::setLocale('id');

        // Ubah format tanggal lahir pengguna
        $user->tgl_lahir = Carbon::parse($user->tgl_lahir)->translatedFormat('d F Y');

        return view('dashboard.lihat-pegawai.show', [
            'user' => $user
        ]);
    }
}
