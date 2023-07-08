<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('id');


        return view('dashboard.reports.index', [
            'reports' => Report::where('user_id', auth()->user()->id)
                ->orderBy('tanggal', 'desc')
                ->get()
                ->map(function ($report) {
                    $report->tanggal = Carbon::parse($report->tanggal)->translatedFormat('d F Y');
                    $report->durasi = CarbonInterval::hours($report->durasi)->cascade()->forHumans(['join' => true, 'shortUnit' => false]);
                    return $report;
                }),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kegiatan' => 'required|max:255',
            'slug' => 'required|unique:reports',
            'kategori' => 'required|max:255',
            'tanggal' => 'required',
            'durasi' => 'required',
            'status' => 'required',
            'lokasi' => 'required|max:255',
            'file' => 'file|max:1024|mimes:pdf',
            'keterangan' => 'required'
        ]);

        if($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('report-file');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Report::create($validatedData);

        return redirect('/dashboard/reports')->with('success', 'Laporan berhasil ditambahkan!');
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
        $formattedDurasi = CarbonInterval::hours($report->durasi)->cascade()->forHumans(['join' => true, 'shortUnit' => false]);
    
        // Format data yang akan dikirimkan
        $data = [
            'tanggal' => $formattedTanggal,
            'kegiatan' => $report->kegiatan,
            'kategori' => $report->kategori,
            'status' => $report->status,
            'durasi' => $formattedDurasi,
            'lokasi' => $report->lokasi,
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
        return view('dashboard.reports.edit', [
            'report' => $report
        ]);
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
        $rules = [
            'kegiatan' => 'required|max:255',
            'kategori' => 'required|max:255',
            'tanggal' => 'required',
            'durasi' => 'required',
            'status' => 'required',
            'lokasi' => 'required|max:255',
            'file' => 'file|max:1024|mimes:pdf',
            'keterangan' => 'required'
        ];

        if($request->slug != $report->slug) {
            $rules['slug'] = 'required|unique:reports';
        }

        $validatedData = $request->validate($rules);

        if($request->file('file')) {
            if($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file'] = $request->file('file')->store('report-file');
        }
     
        $validatedData['user_id'] = auth()->user()->id;

        Report::where('id', $report->id)
            ->update($validatedData);

        return redirect('/dashboard/reports')->with('success', 'Laporan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        if($report->file) {
            Storage::delete($report->file);
        }
        Report::destroy($report->id);

        return redirect('/dashboard/reports')->with('success', 'Laporan berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Report::class, 'slug', $request->kegiatan);
        return response()->json(['slug' => $slug]);
    }
}
