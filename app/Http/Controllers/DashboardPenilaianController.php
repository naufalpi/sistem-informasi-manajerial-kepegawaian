<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DashboardPenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('id');


        return view('dashboard.penilaian.index', [
            'penilaians' => Penilaian::orderBy('tanggal', 'desc')
                ->get()
                ->map(function ($penilaian) {
                    $penilaian->tanggal = Carbon::parse($penilaian->tanggal)->translatedFormat('F Y');
                    return $penilaian;
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
        return view('dashboard.penilaian.create');
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
            'title' => 'required|max:255',
            'semester' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'file' => 'required|file|max:7168|mimes:pdf'
        ]);
    
        $title = $validatedData['title'];
        $semester = $validatedData['semester'];
        $tanggal = $validatedData['tanggal'];

        $newTitle = $title . ' Semester ' . $semester . ' Tahun ' . Carbon::parse($tanggal)->format('Y');
        $validatedData['title'] = $newTitle;

    
        if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('penilaian-file');
        }
    
        Penilaian::create($validatedData);
    
        return redirect('/dashboard/penilaian')->with('success', 'Laporan penilaian kinerja berhasil ditambahkan!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function show(Penilaian $penilaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Penilaian $penilaian)
    {
        return view('dashboard.penilaian.edit', [
            'penilaian' => $penilaian
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penilaian $penilaian)
    {
        $rules = [
            'title' => 'required|max:255',
            'semester' => 'required|max:255',
            'tanggal' => 'required|max:255',
            'file' => 'file|max:7168|mimes:pdf'
        ];

        $validatedData = $request->validate($rules);

        $title = $validatedData['title'];
        $semester = $validatedData['semester'];
        $tanggal = $validatedData['tanggal'];

        $newTitle = $title . ' Semester ' . $semester . ' Tahun ' . Carbon::parse($tanggal)->format('Y');
        $validatedData['title'] = $newTitle;

        if ($request->file('file')) {
            if ($request->oldFile) {
                Storage::delete($request->oldFile);
            }
            $validatedData['file'] = $request->file('file')->store('penilaian-file');
        }

        $penilaian->update($validatedData);

        return redirect('/dashboard/penilaian')->with('success', 'Laporan penilaian kinerja berhasil diubah!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penilaian  $penilaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penilaian $penilaian)
    {
        if($penilaian->file) {
            Storage::delete($penilaian->file);
        }
        Penilaian::destroy($penilaian->id);

        return redirect('/dashboard/penilaian')->with('success', 'Laporan penilaian kinerja berhasil dihapus!');
    }
}
