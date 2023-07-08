@extends('dashboard.layouts.main')

@section('container')


<section class="section">
  <div class="row">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Edit Laporan</h5>
          <form method="post" action="/dashboard/reports/{{ $report->slug }}" class="mb-5" enctype="multipart/form-data">
              @method('put')
              @csrf
              <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <input type="text" class="form-control  @error('kegiatan') is-invalid @enderror" id="kegiatan" name="kegiatan" required autofocus value="{{ old('kegiatan', $report->kegiatan) }}">
                @error('kegiatan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{ old('slug', $report->slug) }}">
                @error('slug')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                    <option value="Administrasi" {{ $report->kategori == 'Administrasi' ? 'selected' : '' }}>Administrasi</option>
                    <option value="Pelayanan Masyarakat" {{ $report->kategori == 'Pelayanan Masyarakat' ? 'selected' : '' }}>Pelayanan Masyarakat</option>
                    <option value="Pengembangan Desa" {{ $report->kategori == 'Pengembangan Desa' ? 'selected' : '' }}>Pengembangan Desa</option>
                    <option value="Koordinasi" {{ $report->kategori == 'Koordinasi' ? 'selected' : '' }}>Koordinasi</option>
                    <option value="Pengawasan" {{ $report->kategori == 'Pengawasan' ? 'selected' : '' }}>Pengawasan</option>
                    <option value="Komunikasi dan Informasi" {{ $report->kategori == 'Komunikasi dan Informasi' ? 'selected' : '' }}>Komunikasi dan Informasi</option>
                    <option value="Pembinaan Masyarakat" {{ $report->kategori == 'Pembinaan Masyarakat' ? 'selected' : '' }}>Pembinaan Masyarakat</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required value="{{ old('tanggal', $report->tanggal) }}">
                @error('tanggal')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="durasi" class="form-label">Durasi</label>
                <input type="time" class="form-control @error('durasi') is-invalid @enderror" id="durasi" name="durasi" required value="{{ old('durasi', $report->durasi) }}">
                @error('durasi')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" required>
                  <option value="Selesai" {{ $report->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                  <option value="Sedang berlangsung" {{ $report->status == 'Sedang berlangsung' ? 'selected' : '' }}>Sedang berlangsung</option>
                  <option value="Tertunda" {{ $report->status == 'Tertunda' ? 'selected' : '' }}>Tertunda</option>
                </select>
                @error('status')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              
              <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control  @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" required autofocus value="{{ old('lokasi', $report->lokasi) }}">
                @error('lokasi')
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
                <input id="keterangan" type="hidden" name="keterangan" value="{{ old('keterangan', $report->keterangan) }}">
                <trix-editor input="keterangan"></trix-editor>
              </div>
              <button type="submit" class="btn btn-primary">Update Laporan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

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
        $breadcrumbItem = 'Kelola Laporan Kerja / Ubah Laporan Kerja';
    @endphp
@endpush
