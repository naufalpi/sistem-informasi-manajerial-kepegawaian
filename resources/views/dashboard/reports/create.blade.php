@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Laporan Baru</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/reports" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Kegiatan</label>
          <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name') }}">
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}">
          @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required value="{{ old('tanggal') }}">
            @error('tanggal')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            @error('keterangan')
              <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="keterangan" type="hidden" name="keterangan" value="{{ old('keterangan') }}">
            <trix-editor input="keterangan"></trix-editor>
          </div>
        <button type="submit" class="btn btn-primary">Buat Laporan</button>
    </form>
</div>

<script>
  const kegiatan = document.querySelector('#kegiatan');
  const slug = document.querySelector('#slug');

  title.addEventListener('change', function() {
    fetch('/dashboard/reports/checkSlug?kegiatan=' + kegiatan.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });
</script>
  
  
@endsection