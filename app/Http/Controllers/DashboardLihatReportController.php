<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        // Mengambil data jumlah report per bulan
        $monthlyData = $this->getMonthlyData();
        $employeeData = $this->getEmployeeData();
        $locationData = $this->getMostUsedLocationsData();

        // Mengambil data jumlah report berdasarkan status
        $statusData = $this->getStatusData();
        
        return view('dashboard.lihat-reports.index', compact('reports', 'filter', 'monthlyData', 'statusData', 'employeeData', 'locationData'));
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
        
        return $query->orderByDesc('tanggal')->get();
    }

    private function getMonthlyData()
    {
        $monthOrder = [
            'January' => 1,
            'February' => 2,
            'March' => 3,
            'April' => 4,
            'May' => 5,
            'June' => 6,
            'July' => 7,
            'August' => 8,
            'September' => 9,
            'October' => 10,
            'November' => 11,
            'December' => 12,
        ];

        return Report::select(
            DB::raw('DATE_FORMAT(tanggal, "%M") AS month'),
            DB::raw('COUNT(*) AS total')
        )
            ->groupBy('month')
            ->orderByRaw('FIELD(month, "'.implode('","', array_keys($monthOrder)).'")')
            ->get();
    }

    private function getStatusData()
    {
        return Report::select('status', DB::raw('COUNT(*) AS total'))
            ->groupBy('status')
            ->get();
    }

    private function getEmployeeData()
    {
        $employees = User::all();
    
        $employeeData = [];
    
        foreach ($employees as $employee) {
            $durations = Report::where('user_id', $employee->id)->pluck('durasi')->toArray();
    
            // Fungsi untuk menghitung total durasi dalam detik
            $totalDurationInSeconds = $this->calculateTotalDurationInSeconds($durations);
            $numReports = count($durations);
    
            $employeeData[] = [
                'name' => $employee->name,
                'total_duration' => $totalDurationInSeconds,
                'num_reports' => $numReports
            ];
        }
    
        return $employeeData;
    }
    
    private function calculateTotalDurationInSeconds($durations)
    {
        $totalSeconds = 0;
    
        foreach ($durations as $duration) {
            list($hours, $minutes, $seconds) = explode(':', $duration);
            $totalSeconds += ($hours * 3600) + ($minutes * 60) + $seconds;
        }
    
        return $totalSeconds;
    }

    private function getMostUsedLocationsData()
    {
        $locations = Report::select('lokasi', DB::raw('COUNT(*) as usage_count'))
                            ->groupBy('lokasi')
                            ->orderByDesc('usage_count')
                            ->take(12)
                            ->get();

        $locationData = [];

        foreach ($locations as $location) {
            $locationData[] = [
            'label' => $location->lokasi,
            'usage_count' => $location->usage_count,
            ];
        }

        return $locationData;
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
