<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;

    protected $table = 'mutasi';
    protected $fillable = ['tgl_surat', 'nomor', 'jml_lampiran', 'perihal', 'camat', 'tgl_musyawarah', 'perangkat_desa', 'kepala_desa', 'jabatan_lama', 'jabatan_baru', 'lampiran'];


}
