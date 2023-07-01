@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="row">
      <div class="col-lg-10">
        
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <a href="/dashboard/mutasi/create" class="btn btn-primary mb-3">Buat Surat Kepensiunan</a>
       </div>
    
        <div class="col-lg-8">
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

            {{-- <div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <a href="/dashboard/kepensiunan/create" class="btn btn-primary mb-3 ml-2"><i class="bx bxs-plus-square"></i></a>
            </div> --}}
            
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Daftar Umur Perangkat Desa Wanakarsa</h5>
            
                  <table class="table table-borderless small" id="tabelku">
                    <thead>
                      <tr>
                        <th class="text-center" scope="col" data-sortable="false">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Umur</th>
                     
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $pegawai)
                        <tr>
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $pegawai->name }}</td>
                          <td>{{ $pegawai->jabatan->name }}</td>
                          <td>{{ $pegawai->umur }} Tahun</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
            
                </div>
              </div>

        </div>
    </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    new simpleDatatables.DataTable("#tabelku", {
      searchable: false,
      perPageSelect: false,
      perPage: 15
    });
  });
</script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Kepensiunan Pegawai';
        $breadcrumbItem = 'Kelola Kepensiunan Pegawai';
    @endphp
@endpush