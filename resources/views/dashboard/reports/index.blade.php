@extends('dashboard.layouts.main')

@section('container')

<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laporan Kerja</h1>
      </div>

      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    
      <a href="/dashboard/reports/create" class="btn btn-primary mb-3">Buat Laporan Baru</a>
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
    
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Tanggal</th>
                <th scope="col">File</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($reports as $report)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $report->kegiatan }}</td>
                  <td>{{ $report->tanggal }}</td>
                  <td>{{ $report->file }}</td>
                  <td>
                    <a href="/dashboard/reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                    <a href="/dashboard/reports/{{ $report->slug }}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></span></a>
                    <form action="/dashboard/reports/{{ $report->slug }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      {{-- <button id="btnConfirm" class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle"></i></button> --}}
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