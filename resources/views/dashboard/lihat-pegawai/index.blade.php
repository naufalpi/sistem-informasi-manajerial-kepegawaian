@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="row">
      <div class="col-lg-12">
 
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
  
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Perangkat Desa Wanakarsa</h5>
      
            <table class="table table-default table-sm" id="tabelku">
              <thead>
                <tr class="table-success">
                  <th scope="col" class="text-center" data-sortable="false">No.</th>
                  <th scope="col" data-sortable="false">Nama</th>
                  <th scope="col" data-sortable="false">Jabatan</th>
                  <th scope="col" data-sortable="false">NRP</th>
                  <th scope="col" data-sortable="false">Alamat</th>
                  <th scope="col" data-sortable="false">No. HP</th>
                  <th scope="col" class="text-center" data-sortable="false">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $pegawai)
                  <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td >{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->jabatan_name }}</td>
                    <td>{{ $pegawai->nrp }}</td>
                    <td>{{ $pegawai->alamat }}</td>
                    <td>{{ $pegawai->no_hp }}</td>
                    <td class="text-center">
                      <a href="/dashboard/lihat-pegawai/{{ $pegawai->id }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                    </td>
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
        perPageSelect: false,
        perPage: 15
      });
    });
  </script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Lihat Data Pegawai';
        $breadcrumbItem = 'Lihat Data Pegawai';
    @endphp
@endpush