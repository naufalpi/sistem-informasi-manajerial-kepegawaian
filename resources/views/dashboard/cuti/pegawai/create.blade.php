@extends('dashboard.layouts.main')

@section('container')


<section class="section">
    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Ajukan Cuti</h5>
    
                  <!-- Horizontal Form -->
                  <form method="post" action="/dashboard/cuti/pegawai" class="mb-5">
                    @csrf
                    <div class="row mb-3">
                        <label for="tgl_mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control  @error('tgl_mulai') is-invalid @enderror" id="tgl_mulai" name="tgl_mulai" required autofocus value="{{ old('tgl_mulai') }}">
                            @error('tanggal')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tgl_selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control  @error('tgl_selesai') is-invalid @enderror" id="tgl_selesai" name="tgl_selesai" required autofocus value="{{ old('tgl_selesai') }}">
                            @error('tgl_selesai')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="jenis_cuti" class="col-sm-2 col-form-label">Jenis Cuti</label>
                        <div class="col-sm-10">
                            <select class="form-select @error('jenis_cuti') is-invalid @enderror" id="jenis_cuti" name="jenis_cuti" required>
                                <option value="">Pilih Jenis Cuti</option>
                                <option value="Cuti Tahunan">Cuti Tahunan</option>
                                <option value="Cuti Sakit">Cuti Sakit</option>
                                <option value="Cuti Melahirkan">Cuti Melahirkan</option>
                                
                            </select>
                            @error('jenis_cuti')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="alasan" class="col-sm-2 col-form-label">Alasan</label>
                        <div class="col-sm-10">
                            <input type="String" class="form-control  @error('alasan') is-invalid @enderror" id="alasan" name="alasan" required autofocus value="{{ old('alasan') }}">
                            @error('alasan')
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
