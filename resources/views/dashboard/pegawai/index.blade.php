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
      
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <a href="/dashboard/pegawai/create" class="btn btn-primary mb-3">Buat Data Pegawai</a>
        </div>
  
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Perangkat Desa Wanakarsa</h5>
      
            <table class="table table-default table-sm">
              <thead>
                <tr class="table-success">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">NRP</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">No. HP</th>
                  <th scope="col" class="text-center">Action</th>
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
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></span></a>
                      <form action="/dashboard/pegawai/{{ $pegawai->id }}" method="post" class="d-inline" id="delete-form-{{ $pegawai->id }}">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="confirmDelete(event, '{{ $pegawai->id }}')"><i class="bi bi-x-circle"></i></button>
                      </form>
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
    function confirmDelete(event, id) {
      event.preventDefault(); // Hentikan pengiriman form default
  
      // Tampilkan konfirmasi SweetAlert
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus data pegawai ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Jika pengguna mengklik "Ya, hapus", kirimkan form
          document.getElementById('delete-form-' + id).submit();
        }
      });
    }
  </script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Data Pegawai';
        $breadcrumbItem = 'Kelola Data Pegawai';
    @endphp
@endpush