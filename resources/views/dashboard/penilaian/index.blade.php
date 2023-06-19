@extends('dashboard.layouts.main')

@section('container')

<section class="section">
  <div class="row">
    <div class="col-lg-10">
     
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
        <a href="/dashboard/penilaian/create" class="btn btn-primary mb-3">Buat Laporan Penilaian Kinerja</a>
      </div>
      
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
    
          <table class="table table-striped datatable small">
            <thead>
              <tr>
                <th class="text-center" scope="col" data-sortable="false">No.</th>
                <th scope="col" data-sortable="false">Judul</th>
                <th class="text-center" scope="col">Semester</th>
                <th scope="col">Tanggal</th>
                <th scope="col" class="text-center" data-sortable="false">File</th>
                <th scope="col" class="text-center" data-sortable="false">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($penilaians as $penilaian)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $penilaian->title }}</td>
                  <td class="text-center">{{ $penilaian->semester }}</td>
                  <td>{{ $penilaian->tanggal }}</td>
                  <td class="text-center">
                    @if ($penilaian->file)
                      <a href="{{ asset('storage/'.$penilaian->file) }}" target="_blank">
                        <img src="/image/pdf.png" alt="" style="width: 20px">
                      </a>
                    @else
                      N/A
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="/dashboard/penilaian/{{ $penilaian->id }}/edit" class="badge bg-warning text-dark"  title="Edit"><i class="bx bx-edit"></i></span></a>
                    <form action="/dashboard/penilaian/{{ $penilaian->id }}" method="post" class="d-inline" id="delete-form-{{ $penilaian->id }}">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0 text-dark" onclick="confirmDelete(event, '{{ $penilaian->id }}')"  title="Hapus"><i class="bx bx-trash"></i></button>
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
      text: "Anda akan menghapus laporan penilaian kinerja ini!",
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
        $pageTitle = 'Kelola Penilaian Kinerja';
        $breadcrumbItem = 'Kelola Penilaian Kinerja';
    @endphp
@endpush