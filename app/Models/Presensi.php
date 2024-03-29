<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Presensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logUnguarded()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
