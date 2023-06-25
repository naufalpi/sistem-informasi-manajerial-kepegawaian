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
        <a href="/dashboard/reports/create" class="btn btn-primary mb-3">Buat Laporan Baru</a>
      </div>
      
    
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
    
          <table class="table table-striped small" id="tabelku">
            <thead>
              <tr>
                <th scope="col" data-sortable="false" class="text-center">No.</th>
                <th scope="col" data-sortable="false">Kegiatan</th>
                <th scope="col">Tanggal</th>
                <th scope="col" data-sortable="false">Status</th>
                <th scope="col" data-sortable="false">Lokasi</th>
                <th scope="col" class="text-center" data-sortable="false">File</th>
                <th scope="col" class="text-center" data-sortable="false">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($reports as $report)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td>{{ $report->kegiatan }}</td>
                  <td>{{ $report->tanggal }}</td>
                  <td>{{ $report->status }}</td>
                  <td>{{ $report->lokasi }}</td>
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
                    <button class="badge bg-info text-dark border-0" title="lihat" onclick="showData('{{ $report->id }}')">
                      <i class="bi bi-eye"></i>
                    </button>                    
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

  function showData(id) {
    // Lakukan permintaan AJAX atau ambil data berdasarkan ID
    // Contoh permintaan AJAX menggunakan jQuery
    $.ajax({
      url: "/dashboard/reports/" + id,
      method: "GET",
      success: function(response) {
        // Tampilkan SweetAlert2 dengan data yang diperoleh
        Swal.fire({
          title: 'Detail Laporan',
          width: 800,
          showCloseButton: true,
          showCancelButton: false, // Menghilangkan tombol konfirmasi
          showConfirmButton: false, // Menghilangkan tombol konfirmasi
          html: `
            <div style="margin-bottom: 10px; overflow: hidden;">
              <div>
                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">Tanggal</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; color: black;">${response.tanggal}</div>
                </div>
                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">Kegiatan</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; color: black;">${response.kegiatan}</div>
                </div>
                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">Status</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; color: black;">${response.status}</div>
                </div>
                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">Durasi</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; color: black;">${response.durasi}</div>
                </div>
                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">Lokasi</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; color: black;">${response.lokasi}</div>
                </div>
                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">File</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; color: black; font-weight: bold; display: ${response.file ? 'inline-block' : 'none'};">${response.file ? `<a href="${response.file}" target="_blank"><img src="/image/pdf.png" alt="" style="width: 20px"></a>` : 'N/A'}</div>
                </div>
                <div class="row" style="margin-bottom: 7px;">
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">Keterangan</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; text-align: justify; color: black;">${response.keterangan}</div>
                </div>
              </div>
            </div>
          `
        });
      },
      error: function(xhr) {
        // Tangani kesalahan jika ada
        console.log(xhr.responseText);
      }
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    new simpleDatatables.DataTable("#tabelku", {
    });
  });


</script>
@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Laporan Kerja';
        $breadcrumbItem = 'Kelola Laporan Kerja';
    @endphp
@endpush