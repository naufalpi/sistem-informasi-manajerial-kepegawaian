@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Daftar Perangkat Desa Wanakarsa</h1>
        </div>
  
        @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      
        <a href="/dashboard/pegawai/create" class="btn btn-primary mb-3">Buat Data Perangkat Desa</a>
      
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></h5>
      
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">NRP</th>
                  <th scope="col">Alamat</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $pegawai)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->jabatan->name }}</td>
                    <td>{{ $pegawai->nrp }}</td>
                    <td>{{ $pegawai->alamat }}</td>
                    <td>
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></span></a>
                      <form action="/dashboard/pegawai/{{ $pegawai->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle"></i></button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
      
          </div>
        </div>
  
      </div>
  
    </div>
  </section>


@endsection