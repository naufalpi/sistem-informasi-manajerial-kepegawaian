@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Data Pegawai Baru</h1>
</div>

<div class="col-lg-8">
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
          <label for="jabatan" class="form-label">Jabatan</label>
          <select class="form-select" name="jabatan_id">
            @foreach($jabatans as $jabatan)
            <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
              @if(old('jabatan_id') == $jabatan->id)
              <option value="{{ $jabatan->id }}" selected>{{ $jabatan->name }}</option>
              @else
              <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
              @endif
            @endforeach
          </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Buat Data Pegawai</button>
    </form>
</div>

<script>
//   const kegiatan = document.querySelector('#kegiatan');
//   const slug = document.querySelector('#slug');

//   kegiatan.addEventListener('change', function() {
//     fetch('/dashboard/pegawai/checkSlug?kegiatan=' + kegiatan.value)
//       .then(response => response.json())
//       .then(data => slug.value = data.slug)
//   });
  
</script>
@endsection