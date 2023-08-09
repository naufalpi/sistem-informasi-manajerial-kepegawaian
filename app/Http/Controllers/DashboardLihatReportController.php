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
      
        $monthlyData = $this->getMonthlyData();
        $categoryData = $this->getCategoryData();
        $employeeData = $this->getEmployeeData();
        $locationData = $this->getMostUsedLocationsData();
        $categoryDurationData = $this->getCategoryDurationData();

    
      

        // Mengubah format tanggal pada laporan
        foreach ($reports as $report) {
            $report->tanggal = Carbon::parse($report->tanggal)->format('d-m-Y');
        }

    

        // Mengambil data jumlah report berdasarkan status
        $statusData = $this->getStatusData();
        
        return view('dashboard.lihat-reports.index', compact('reports', 'filter', 'monthlyData', 'categoryData', 'statusData', 'employeeData', 'locationData', 'categoryDurationData'));
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

    private function getCategoryData()
    {
        $categories = Report::select('kategori')
                            ->groupBy('kategori')
                            ->get();

        $categoryData = [];

        foreach ($categories as $category) {
            $total = Report::where('kategori', $category->kategori)
                           ->count();

            $categoryData[] = [
                'kategori' => $category->kategori,
                'total' => $total,
            ];
        }

        // Urutkan data kategori berdasarkan jumlah terkecil ke terbesar
        usort($categoryData, function($a, $b) {
            return $a['total'] <=> $b['total'];
        });

        $categories = [];
        $data = [];

        foreach ($categoryData as $dataItem) {
            $categories[] = $dataItem['kategori'];
            $data[] = $dataItem['total'];
        }

        return [
            'categories' => $categories,
            'data' => $data,
        ];
    }

    private function getCategoryDurationData()
    {
        $categories = Report::select('kategori')
            ->groupBy('kategori')
            ->get();

        $categoryData = [];
        $averageDurationData = [];

        foreach ($categories as $category) {
            $durations = Report::where('kategori', $category->kategori)
                ->pluck('durasi')
                ->toArray();

            $totalDurationInSeconds = $this->calculateTotalDurationInSeconds($durations);
            $totalReports = count($durations);
            
            if ($totalReports > 0) {
                $averageDurationInSeconds = $totalDurationInSeconds / $totalReports;
              

                // Mengonversi ke format 'Jam Menit'
            

                $categoryData[] = $category->kategori;
                $averageDurationData[] =  $averageDurationInSeconds;
            }
        }

        return [
            'categories' => $categoryData,
            'average_durations' => $averageDurationData,
        ];
    }


    
    


    private function getStatusData()
    {
        return Report::select('status', DB::raw('COUNT(*) AS total'))
            ->groupBy('status')
            ->get();
    }

    private function getEmployeeData()
    {
        $employees = User::where('jabatan_id', '!=', '1')->get();

        $employeeData = [];

        foreach ($employees as $employee) {
            $reports = Report::where('user_id', $employee->id)
                ->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get();

            $totalDurationInSeconds = $this->calculateTotalDurationInSeconds($reports->pluck('durasi')->toArray());
            $numReports = $reports->count();

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

        $iconColors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff', '#800080', '#ffa500', '#008000', '#ff69b4', '#000000'];

        foreach ($locations as $key => $location) {
            // Gantikan 'latitude' dan 'longitude' dengan nilai koordinat lokasi sesuai dengan database Anda
         

            $locationData[] = [
                'label' => $location->lokasi,
                'usage_count' => $location->usage_count,
                'iconColor' => $iconColors[$key % count($iconColors)]
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
