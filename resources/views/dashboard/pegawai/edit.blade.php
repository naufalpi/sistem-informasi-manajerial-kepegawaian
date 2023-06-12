@extends('dashboard.layouts.main')

@section('container')


<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Data Pegawai</h5>
                
                    <form method="post" action="/dashboard/pegawai/{{ $user->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username" name="username" required autofocus value="{{ old('username', $user->username) }}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nrp" class="form-label">NRP</label>
                            <input type="number" class="form-control  @error('nrp') is-invalid @enderror" id="nrp" name="nrp" required autofocus value="{{ old('nrp', $user->nrp) }}">
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
                                @if(old('jabatan_id', $user->jabatan_id) == $jabatan->id)
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
                                @if(old('pendidikan_id', $user->pendidikan_id) == $pendidikan->id)
                                <option value="{{ $pendidikan->id }}" selected>{{ $pendidikan->name }}</option>
                                @else
                                <option value="{{ $pendidikan->id }}">{{ $pendidikan->name }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tpt_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control  @error('tpt_lahir') is-invalid @enderror" id="tpt_lahir" name="tpt_lahir" required autofocus value="{{ old('tpt_lahir', $user->tpt_lahir) }}">
                            @error('tpt_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control  @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" required autofocus value="{{ old('tgl_lahir', $user->tgl_lahir) }}">
                            @error('tgl_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="string" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required autofocus value="{{ old('alamat', $user->alamat) }}">
                            @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Foto</label>
                            <input class="form-control  @error('foto') is-invalid @enderror" type="file" id="foto" name="foto">
                            @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <img id="preview" src="#" alt="Preview" style="max-width: 200px; height: auto;">
                        </div>
                        <button type="button" class="btn btn-primary" id="cropBtn">Crop Foto</button>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" required autofocus value="{{ old('email', $user->email) }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus value="{{ old('password') }}">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div> --}}
                        
                        <button type="submit" class="btn btn-primary">Ubah Data Pegawai</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.getElementById("foto");
        const image = document.getElementById("preview");
        const cropBtn = document.getElementById("cropBtn");
        const submitBtn = document.getElementById("submitBtn");
        let cropper;
  
        input.addEventListener("change", function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
  
            reader.onload = function(event) {
                image.src = event.target.result;
  
                cropper = new Cropper(image, {
                    aspectRatio: 2 / 3, // Sesuaikan dengan rasio aspek yang Anda inginkan
                    viewMode: 1, // Sesuaikan mode tampilan yang Anda inginkan
                    autoCropArea: 0.8 // Sesuaikan ukuran area crop yang Anda inginkan
                });
  
                cropBtn.style.display = "block";
            };
  
            reader.readAsDataURL(file);
        });
  
        cropBtn.addEventListener("click", function() {
            const canvas = cropper.getCroppedCanvas();
            const croppedImage = canvas.toDataURL();
  
            image.src = croppedImage;
            cropper.destroy();
  
            cropBtn.style.display = "none";
            submitBtn.style.display = "block";
        });
    });
  </script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Data Pegawai';
        $breadcrumbItem = 'Kelola Data Pegawai';
    @endphp
@endpush