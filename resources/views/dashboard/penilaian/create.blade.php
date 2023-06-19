@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="row">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                            title: 'Success',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            timer: 3000, // Waktu dalam milidetik (3000ms = 3 detik)
                            showConfirmButton: false
                            });
                        });
                        </script>
                    @endif
                    <h5 class="card-title">Buat Laporan Penilaian Kinerja</h5>
                    <form method="post" action="/dashboard/penilaian" class="mb-5" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="title" class="form-label">Judul</label>
                          <input type="text" class="form-control  @error('title') is-invalid @enderror" id="title" name="title" required autofocus value="{{ old('title') }}">
                          @error('title')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="semester" class="form-label">Semester</label>
                          <input type="text" class="form-control  @error('semester') is-invalid @enderror" id="semester" name="semester" required autofocus value="{{ old('semester') }}">
                          @error('semester')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="tanggal" class="form-label">Tanggal</label>
                          <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required autofocus value="{{ old('tanggal') }}">
                          @error('tanggal')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="file" class="form-label">Upload Laporan Penilaian Kinerja</label>
                          <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file">
                          @error('file')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Buat Laporan Penilaian</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Penilaian Kinerja';
        $breadcrumbItem = 'Kelola Penilaian Kinerja / Buat Penilaian Kinerja';
    @endphp
@endpush