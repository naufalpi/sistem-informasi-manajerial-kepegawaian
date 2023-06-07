@extends('dashboard.layouts.main')

@section('container')

<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Diri</h1>
      </div>

      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
            <p class="card-text">Nama: {{ $user->name }}</p>
            <p class="card-text">Jabatan: {{ $user->jabatan->name }}</p>
            <p class="card-text">Pendidikan: {{ $user->pendidikan->name }}</p>
        </div>
      </div>

    </div>

  </div>
</section>


@endsection