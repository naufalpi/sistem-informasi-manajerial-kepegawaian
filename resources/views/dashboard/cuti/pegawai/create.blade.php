@extends('dashboard.layouts.main')

@section('container')


<section class="section">
    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Ajukan Cuti</h5>
    
                  <!-- Horizontal Form -->
                  <form method="post" action="/dashboard/cuti/pegawai" class="mb-5">
                    @csrf
                    <div class="row mb-3">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required autofocus value="{{ old('tanggal') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="keperluan" class="col-sm-2 col-form-label">Keperluan</label>
                        <div class="col-sm-10">
                            <input type="String" class="form-control  @error('keperluan') is-invalid @enderror" id="keperluan" name="keperluan" required autofocus value="{{ old('keperluan') }}">
                            @error('keperluan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>
                      
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                  </form>
    
                </div>
              </div>

        </div>
    </div>
</section>


@endsection

@push('scripts')
    @php
        $pageTitle = 'Cuti Pegawai';
        $breadcrumbItem = 'Cuti Pegawai';
    @endphp
@endpush
