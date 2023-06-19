@extends('dashboard.layouts.main')

@section('container')


<section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                @if ($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                @else
                    <img src="/image/foto-null.jpeg" alt="{{ $user->name }}" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                @endif
                <h2>{{ $user->name }}</h2>
                <h3>{{ $user->jabatan->name }}</h3>
            </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
          
            <div class="tab-content pt-2">

                <div class="fade show profile-overview">

                    <h5 class="card-title">Detail Profil</h5>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Nama</div>
                        <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Username</div>
                        <div class="col-lg-9 col-md-8">{{ $user->username }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">NRP</div>
                        <div class="col-lg-9 col-md-8">{{ $user->nrp }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Tempat, Tanggal Lahir</div>
                        <div class="col-lg-9 col-md-8">{{ $user->tpt_lahir }}, {{ $user->tgl_lahir }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                        <div class="col-lg-9 col-md-8">{{ $user->alamat }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">No. HP</div>
                        <div class="col-lg-9 col-md-8">{{ $user->no_hp }}</div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                    </div>

                </div>

            </div>
        </div>

      </div>
    </div>
</section>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Data Pegawai';
        $breadcrumbItem = 'Kelola Data Pegawai / Lihat Data Pegawai';
    @endphp
@endpush