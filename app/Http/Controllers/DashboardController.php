<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    function index(Request $request){


       
        Carbon::setLocale('id');

        // $logs = Activity::latest()->get();
        // return view('dashboard.index', compact('logs'));

        return view('dashboard.index', [
            'activities' => Activity::latest()
                ->get()
                ->map(function ($activity) {
                    $activity->created_at_formatted = Carbon::parse($activity->created_at)->diffForHumans();
                    return $activity;
                }),
        ]);
        
    }

}
