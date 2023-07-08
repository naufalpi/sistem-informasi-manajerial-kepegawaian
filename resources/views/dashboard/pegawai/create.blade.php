@extends('dashboard.layouts.main')

@section('container')

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Buat Data Perangkat Desa</h5>
          <form method="post" action="/dashboard/pegawai" class="mb-5" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
                @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username" name="username" required autofocus value="{{ old('username') }}">
                @error('username')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="nrp" class="form-label">NRP</label>
                <input type="number" class="form-control  @error('nrp') is-invalid @enderror" id="nrp" name="nrp" required autofocus value="{{ old('nrp') }}">
                @error('nrp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select class="form-select" name="jabatan_id">
                  @foreach($jabatans as $jabatan)
                    @if(old('jabatan_id') == $jabatan->id)
                    <option value="{{ $jabatan->id }}" selected>{{ $jabatan->name }}</option>
                    @else
                    <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="pendidikan" class="form-label">Pendidikan</label>
                <select class="form-select" name="pendidikan_id">
                  @foreach($pendidikans as $pendidikan)
                    @if(old('pendidikan_id') == $pendidikan->id)
                    <option value="{{ $pendidikan->id }}" selected>{{ $pendidikan->name }}</option>
                    @else
                    <option value="{{ $pendidikan->id }}">{{ $pendidikan->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="tpt_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control  @error('tpt_lahir') is-invalid @enderror" id="tpt_lahir" name="tpt_lahir" required autofocus value="{{ old('tpt_lahir') }}">
                @error('tpt_lahir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control  @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" required autofocus value="{{ old('tgl_lahir') }}">
                @error('tgl_lahir')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="string" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat') }}">
                @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="foto" class="form-label">Tambah Foto</label>
                <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                @error('foto')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>


              <div class="mb-3">
                <label for="email" class="form-label">Email (opsional)</label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="no_hp" class="form-label">No. HP</label>
                <input type="number" class="form-control  @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" required autofocus value="{{ old('no_hp') }}">
                @error('no_hp')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="form-group">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus value="{{ old('password') }}">
                  <span id="togglePassword" toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                </div>
                @error('password')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <input type="hidden" name="cropped_image" id="cropped-image">
              <button type="submit" class="btn btn-primary">Buat Data Pegawai</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function() {
    $('#togglePassword').click(function() {
      $(this).toggleClass("fa-eye-slash fa-eye");
      var passwordInput = $('#password');
      var passwordFieldType = passwordInput.attr('type');
      var passwordFieldTypeUpdated = passwordFieldType === 'password' ? 'text' : 'password';
      passwordInput.attr('type', passwordFieldTypeUpdated);
    });
  });

</script>




@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Data Pegawai';
        $breadcrumbItem = 'Kelola Data Pegawai / Buat Data Pegawai';
    @endphp
@endpush