<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardLihatReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $queryAll = Report::with('user');
        $sort = $request->query('sort');
        
        switch ($sort) {
            case 'name':
                $queryAll->orderBy('name');
                break;
            case 'latest':
            default:
                $queryAll->latest();
                break;
        }
        
        $allReports = $queryAll->get();
        
        $today = Carbon::now()->format('Y-m-d');
        $queryToday = Report::with('user')->whereDate('created_at', $today);
        
        if ($sort === 'name') {
            $queryToday->orderBy('name');
        } else {
            $queryToday->latest();
        }
        
        $todayReports = $queryToday->get();
        
        $weekStart = Carbon::now()->startOfWeek()->format('Y-m-d');
        $weekEnd = Carbon::now()->endOfWeek()->format('Y-m-d');
        
        $queryWeek = Report::with(['user' => function ($query) use ($sort) {
            if ($sort === 'name') {
                $query->orderBy('name');
            }
        }])
        ->whereBetween('created_at', [$weekStart, $weekEnd])
        ->latest();
        
        $weekReports = $queryWeek->get();
        
        // Mendapatkan query string saat ini dari URL
        $queryString = $request->getQueryString();
        
        return view('dashboard.lihat-reports.index', compact('allReports', 'todayReports', 'weekReports', 'queryString'));
        
    }
    



    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
