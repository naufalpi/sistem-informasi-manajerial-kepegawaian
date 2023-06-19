<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Sabberworm\CSS\Settings;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {

        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');

        $logs = Activity::latest()->get();
        return view('dashboard.log-activity.index', compact('logs'));

        // return view('dashboard.log-activity.index', [
        //     'activities' => Activity::latest()
        //         ->get()
        //         ->map(function ($activity) {
        //             $activity->tanggal = Carbon::parse($activity->created_at)->translatedFormat('d F Y');
        //             return $activity;
        //         }),
        // ]);

    }
}
