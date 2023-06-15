@extends('dashboard.layouts.main')

@section('container')

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"></h1>
      </div>

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

      {{-- <div class="card">
        <div class="card-body">
            <h5 class="card-title">Daftar Laporan Kerja Hari Ini</h5>
    
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-center">File</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todayReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->user->jabatan->name }}</td>
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
                                <a href="/dashboard/lihat-reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $todayReports->links() }}
    
        </div>
      </div>

      <div class="card">
        <div class="card-body">
            <h5 class="card-title">Daftar Laporan Kerja Minggu Ini</h5>
    
            <table class="table">
                <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Kegiatan</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col" class="text-center">File</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weekReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->user->jabatan->name }}</td>
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
                                <a href="/dashboard/lihat-reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $weekReports->links() }}
    
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Semua Laporan Kerja</h5>
    
          <table class="table">
            <thead>
              <tr>
                <th scope="col" class="d-flex align-items-center align-middle">
                  <div class="me-2">#</div>
                  <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bi bi-sort-down"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                      <li><a class="dropdown-item" href="#" onclick="sortData('nama')">Urutkan berdasarkan nama</a></li>
                      <li><a class="dropdown-item" href="#" onclick="sortData('waktu')">Urutkan berdasarkan waktu</a></li>
                    </ul>
                  </div>
                </th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Kegiatan</th>
                <th scope="col">Tanggal</th>
                <th scope="col" class="text-center">File</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($allReports as $report)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $report->user->name }}</td>
                  <td>{{ $report->user->jabatan->name }}</td>
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
                    <a href="/dashboard/lihat-reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $allReports->links() }}
    
        </div>
      </div> --}}

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Daftar Laporan Kerja</h5>

          <!-- Default Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="harian-tab" data-bs-toggle="tab" data-bs-target="#harian" type="button" role="tab" aria-controls="harian" aria-selected="true">Hari ini</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="mingguan-tab" data-bs-toggle="tab" data-bs-target="#mingguan" type="button" role="tab" aria-controls="mingguan" aria-selected="false">Minggu ini</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="bulanan-tab" data-bs-toggle="tab" data-bs-target="#bulanan" type="button" role="tab" aria-controls="bulanan" aria-selected="false">Bulan ini</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="false">Semua</button>
            </li>
          </ul>
          <div class="tab-content pt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="harian" role="tabpanel" aria-labelledby="harian-tab">
              <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                  Urutkan
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href="{{ route('reports.index', ['sort' => 'latest']) }}">Waktu Terbaru</a></li>
                                  <li><a class="dropdown-item" href="{{ route('reports.index', ['sort' => 'name']) }}">Nama Pengguna</a>
                                  </li>
                                </ul>
                            </div>
                        </th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Kegiatan</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col" class="text-center">File</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todayReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->user->jabatan->name }}</td>
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
                                <a href="/dashboard/lihat-reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="mingguan" role="tabpanel" aria-labelledby="mingguan-tab">
              <table class="table">
                <thead>
                    <tr>
                      <th scope="col">#
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                              Urutkan
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                              <li><a class="dropdown-item" href="{{ route('reports.index', ['sort' => 'latest']) }}">Waktu Terbaru</a></li>
                              <li><a class="dropdown-item" href="{{ route('reports.index', ['sort' => 'name']) }}">Nama Pengguna</a></li>
                            </ul>
                          </div>
                      </th>
                      <th scope="col">Nama</th>
                      <th scope="col">Jabatan</th>
                      <th scope="col">Kegiatan</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col" class="text-center">File</th>
                      <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($weekReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->user->jabatan->name }}</td>
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
                                <a href="/dashboard/lihat-reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="tab-pane fade" id="bulanan" role="tabpanel" aria-labelledby="bulanan-tab">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="d-flex align-items-center align-middle">
                      <div class="me-2">#</div>
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                          Urutkan
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                          <li><a class="dropdown-item" href="{{ route('reports.index', ['sort' => 'latest']) }}">Waktu Terbaru</a></li>
                          <li><a class="dropdown-item" href="{{ route('reports.index', ['sort' => 'name']) }}">Nama Pengguna</a></li>
                        </ul>
                      </div>
                    </th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Kegiatan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col" class="text-center">File</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($allReports as $report)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $report->user->name }}</td>
                      <td>{{ $report->user->jabatan->name }}</td>
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
                        <a href="/dashboard/lihat-reports/{{ $report->slug }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div><!-- End Default Tabs -->

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

  function sortData(sortBy) {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('sort', sortBy);
    window.location.search = urlParams.toString();
  }
  
  document.addEventListener('DOMContentLoaded', function() {
    // Menggunakan event delegation untuk mendeteksi perubahan dropdown menu pada setiap tabel
    document.querySelectorAll('.dropdown-menu').forEach(function(menu) {
        menu.addEventListener('click', function(event) {
            event.preventDefault();
            var sort = event.target.getAttribute('data-sort');
            var tabPane = menu.closest('.tab-pane');
            var table = tabPane.querySelector('table');
            var tableBody = table.querySelector('tbody');

            // Hapus semua baris tabel
            tableBody.innerHTML = '';

            // Ambil URL saat ini
            var url = window.location.href;

            // Periksa jika URL sudah mengandung parameter
            if (url.indexOf('?') !== -1) {
                // Periksa jika parameter 'sort' sudah ada dalam URL
                if (url.indexOf('sort=') !== -1) {
                    // Hapus parameter 'sort' dari URL saat ini
                    url = url.replace(/([\?&]sort=)[^&]+/, '');
                }

                // Periksa jika URL sudah mengandung parameter lain
                if (url.indexOf('&') !== -1) {
                    // Tambahkan parameter 'sort' ke URL saat ini
                    url += '&sort=' + sort;
                } else {
                    // Tambahkan parameter 'sort' ke URL saat ini
                    url += '?sort=' + sort;
                }
            } else {
                // Tambahkan parameter 'sort' ke URL saat ini
                url += '?sort=' + sort;
            }

            // Muat ulang tabel dengan URL yang diperbarui
            fetch(url)
                .then(function(response) {
                    return response.text();
                })
                .then(function(data) {
                    // Ambil baris-baris tabel dari respon
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data;
                    var newTableBody = tempDiv.querySelector('tbody');
                    var newRows = newTableBody.querySelectorAll('tr');

                    // Tambahkan kembali baris-baris tabel yang diperbarui
                    newRows.forEach(function(row) {
                        tableBody.appendChild(row);
                    });
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    });
});

</script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Lihat Laporan Pegawai';
        $breadcrumbItem = 'Lihat Laporan Pegawai';
    @endphp
@endpush
