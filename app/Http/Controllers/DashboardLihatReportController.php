<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardLihatReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $filter = $request->query('filter', 'today');
        $reports = $this->getFilteredReports($filter);
        
        return view('dashboard.lihat-reports.index', compact('reports', 'filter'));
    }
    
    private function getFilteredReports($filter)
    {
        $query = Report::query()->with('user');
        
        if ($filter == 'today') {
            $query->whereDate('tanggal', Carbon::today());
        } elseif ($filter == 'this_week') {
            $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'this_month') {
            $query->whereYear('tanggal', Carbon::now()->year)->whereMonth('tanggal', Carbon::now()->month);
        } elseif ($filter == 'this_year') {
            $query->whereYear('tanggal', Carbon::now()->year);
        }
        
        return $query->orderByDesc('created_at')->get();
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
    public function show($id)
    {
        // Ambil data yang sesuai dengan ID
        Carbon::setLocale('id');
        
        $report = Report::find($id);
        
    
        // Pastikan data ditemukan
        if (!$report) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $formattedTanggal = Carbon::parse($report->tanggal)->translatedFormat('d F Y');
    
        // Format data yang akan dikirimkan
        $data = [
            'tanggal' => $formattedTanggal,
            'kegiatan' => $report->kegiatan,
            'file' => asset('storage/' . $report->file),
            'keterangan' => $report->keterangan
        ];
    
        return response()->json($data);
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

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Report::class, 'slug', $request->kegiatan);
        return response()->json(['slug' => $slug]);
    }
}
