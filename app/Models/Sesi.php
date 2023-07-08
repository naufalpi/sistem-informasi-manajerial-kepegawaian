<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Sesi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
