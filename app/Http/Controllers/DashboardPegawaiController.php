<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class DashboardPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pegawai.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pegawai.create', [
            'jabatans' => Jabatan::all(),
            'pendidikans' => Pendidikan::all()
        ]);

        
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
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'nrp' => 'required|min:6|max:255',
            'jabatan_id' => 'required',
            'pendidikan_id' => 'required',
            'tpt_lahir' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'alamat' => 'required|max:255',
            'foto' => 'image|file|max:1024',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if($request->file('foto')) {
            $validatedData['foto'] = $request->file('foto')->store('user-foto');
        }

      

        $validatedData['user_id'] = auth()->user()->id;

        User::create($validatedData);

        return redirect('/dashboard/pegawai')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
    
        return view('dashboard.pegawai.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.pegawai.edit', [
            'user' => $user,
            'jabatans' => Jabatan::all(),
            'pendidikans' => Pendidikan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi inputan form
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . $id,
            'nrp' => 'required|numeric|unique:users,nrp,' . $id,
            'jabatan_id' => 'required',
            'pendidikan_id' => 'required',
            'tpt_lahir' => 'required|max:255',
            'tgl_lahir' => 'required|max:255',
            'alamat' => 'required|max:255',
            'foto' => 'image|file|max:1024',
            'email' => 'required|email|unique:users,email,' . $id
        ]);

        // Cek apakah ada file foto yang diunggah
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $fotoPath = $foto->store('user-foto');
            $validatedData['foto'] = $fotoPath;
        }

        // Update data pegawai
        $user = User::findOrFail($id);
        $user->update($validatedData);

        return redirect('/dashboard/pegawai')->with('success', 'Data pegawai berhasil diubah.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->foto) {
            Storage::delete($user->foto);
        }

        User::destroy($user->id);

        return redirect('/dashboard/pegawai')->with('success', 'Data Pegawai berhasil dihapus!');
    }
}
