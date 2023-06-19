@extends('dashboard.layouts.main')

@section('container')

<section class="section">
  <div class="row">
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
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <a href="/dashboard/reports/create" class="btn btn-primary mb-3">Buat Laporan Baru</a>
      </div>
      
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
    
          <table class="table table-striped datatable small">
            <thead>
              <tr>
                <th scope="col" data-sortable="false">#</th>
                <th scope="col" data-sortable="false">Kegiatan</th>
                <th scope="col">Tanggal</th>
                <th scope="col" class="text-center" data-sortable="false">File</th>
                <th scope="col" class="text-center" data-sortable="false">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($reports as $report)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $report->kegiatan }}</td>
                  <td>{{ $report->tanggal }}</td>
                  <td class="text-center">
                    @if ($report->file)
                      <a href="{{ asset('storage/'.$report->file) }}" target="_blank">
                        <img src="/image/pdf.png" alt="" style="width: 20px">
                      </a>
                    @else
                      N/A
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="/dashboard/reports/{{ $report->slug }}" class="badge bg-info text-dark" title="Lihat"><i class="bi bi-eye"></i></span></a>
                    <a href="/dashboard/reports/{{ $report->slug }}/edit" class="badge bg-warning text-dark"  title="Edit"><i class="bi bi-pencil"></i></span></a>
                    <form action="/dashboard/reports/{{ $report->slug }}" method="post" class="d-inline" id="delete-form-{{ $report->slug }}">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0 text-dark" onclick="confirmDelete(event, '{{ $report->slug }}')"  title="Hapus"><i class="bi bi-x-circle"></i></button>
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
      text: "Anda akan menghapus laporan ini!",
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
        $pageTitle = 'Kelola Laporan Kerja';
        $breadcrumbItem = 'Kelola Laporan Kerja';
    @endphp
@endpush