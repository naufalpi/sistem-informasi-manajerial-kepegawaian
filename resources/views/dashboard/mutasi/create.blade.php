@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="row">
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Form Mutasi Pegawai</h5>
    
                  <form method="post" action="/dashboard/mutasi" class="mb-5">
                    @csrf
                    <div class="row mb-3">
                        <label for="tgl_surat" class="col-sm-2 col-form-label">Tanggal Surat</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control  @error('tgl_surat') is-invalid @enderror" id="tgl_surat" name="tgl_surat" required autofocus value="{{ old('tgl_surat') }}">
                            @error('tgl_surat')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nomor" class="col-sm-2 col-form-label">Nomor</label>
                        <div class="col-sm-10">
                            <input type="string" class="form-control  @error('nomor') is-invalid @enderror" id="nomor" name="nomor" required autofocus value="{{ old('nomor') }}">
                            @error('nomor')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jml_lampiran" class="col-sm-2 col-form-label">Lampiran</label>
                        <div class="col-sm-10">
                            <input type="string" class="form-control  @error('jml_lampiran') is-invalid @enderror" id="jml_lampiran" name="jml_lampiran" required autofocus value="{{ old('jml_lampiran') }}">
                            @error('jml_lampiran')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="perihal" class="col-sm-2 col-form-label">Perihal</label>
                        <div class="col-sm-10">
                            <input type="string" class="form-control  @error('perihal') is-invalid @enderror" id="perihal" name="perihal" required autofocus value="{{ old('perihal') }}">
                            @error('perihal')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="camat" class="col-sm-2 col-form-label">Camat</label>
                        <div class="col-sm-10">
                            <input type="string" class="form-control  @error('camat') is-invalid @enderror" id="camat" name="camat" required autofocus value="{{ old('camat') }}">
                            @error('camat')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div><div class="row mb-3">
                        <label for="tgl_musyawarah" class="col-sm-2 col-form-label">Tanggal Musyawarah</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control  @error('tgl_musyawarah') is-invalid @enderror" id="tgl_musyawarah" name="tgl_musyawarah" required autofocus value="{{ old('tgl_musyawarah') }}">
                            @error('tgl_musyawarah')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="perangkat_desa" class="col-sm-2 col-form-label">Perangkat Desa</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="perangkat_desa">
                                @foreach($users as $user)
                                    <option value="{{ $user }}">{{ $user }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jabatan_lama" class="col-sm-2 col-form-label">Jabatan Lama</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="jabatan_lama">
                                @foreach($jabatans as $jabatan)
                                  @if(old('jabatan_id') == $jabatan->id)
                                  <option value="{{ $jabatan->id }}" selected>{{ $jabatan->name }}</option>
                                  @else
                                  <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                                  @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jabatan_baru" class="col-sm-2 col-form-label">Jabatan Baru</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="jabatan_baru">
                                @foreach($jabatans as $jabatan)
                                  @if(old('jabatan_id') == $jabatan->id)
                                  <option value="{{ $jabatan->id }}" selected>{{ $jabatan->name }}</option>
                                  @else
                                  <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                                  @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kepala_desa" class="col-sm-2 col-form-label">Kepala Desa</label>
                        <div class="col-sm-10">
                            <input type="string" class="form-control" id="kepala_desa" name="kepala_desa" required autofocus value="{{ $kades }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="lampiran" class="col-sm-2 col-form-label">Isi Lampiran</label>
                        <div class="col-sm-10">
                            @error('lampiran')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <input id="lampiran" type="hidden" name="lampiran" value="{{ old('lampiran') }}">
                            <trix-editor input="lampiran"></trix-editor>
                        </div>
                    </div>
                    
                    
    
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                      </div>
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
        $pageTitle = 'Kelola Mutasi Pegawai';
        $breadcrumbItem = 'Kelola Mutasi Pegawai';
    @endphp
@endpush