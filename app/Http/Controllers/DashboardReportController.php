<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return view('dashboard.reports.index', [
            'reports' => Report::where('user_id', auth()->user()->id)->get()
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
            'tanggal' => 'required',
            'file' => 'file|max:1024',
            'keterangan' => 'required'
        ]);

        if($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('report-file');
        }

        $validatedData['user_id'] = auth()->user()->id;

        Report::create($validatedData);

        return redirect('/dashboard/reports')->with('success', 'New report has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view('dashboard.reports.show', [
            'report' => $report
        ]);
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
            'slug' => 'required|unique:reports',
            'tanggal' => 'required',
            'file' => 'file|max:1024',
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

        return redirect('/dashboard/reports')->with('success', 'Report has been updated!');
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

        return redirect('/dashboard/reports')->with('success', 'Report has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Report::class, 'slug', $request->kegiatan);
        return response()->json(['slug' => $slug]);
    }
}
