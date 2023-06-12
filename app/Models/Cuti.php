<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';
    protected $fillable = ['user_id', 'tanggal', 'keperluan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
