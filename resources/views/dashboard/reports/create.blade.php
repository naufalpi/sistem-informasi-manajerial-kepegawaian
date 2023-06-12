@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Buat Laporan Baru</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/reports" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="kegiatan" class="form-label">Kegiatan</label>
          <input type="text" class="form-control  @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" required autofocus value="{{ old('kegiatan') }}">
          @error('kegiatan')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug') }}" readonly>
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
          <label for="file" class="form-label  @error('file') is-invalid @enderror">Upload File PDF</label>
          <input class="form-control" type="file" id="file" name="file">
          @error('file')
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

  kegiatan.addEventListener('change', function() {
    fetch('/dashboard/reports/checkSlug?kegiatan=' + kegiatan.value)
      .then(response => response.json())
      .then(data => slug.value = data.slug)
  });

  // function previewImage() {
  //   const image = document.querySelector('#image');
  //   const imgPreview = document.querySelector('.img-preview');

  //   imgPreview.style.display = 'block';

  //   const oFReader = new FileReader();
  //   oFReader.readAsDataURL(image.files[0]);

  //   oFReader.onload = function(oFREvent) {
  //     imgPreview.src = oFREvent.target.result;
  //   }
  // }
  
</script>
@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Laporan Kerja';
        $breadcrumbItem = 'Kelola Laporan Kerja';
    @endphp
@endpush