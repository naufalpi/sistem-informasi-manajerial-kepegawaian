@extends('dashboard.layouts.main')

@section('container')

<section class="section dashboard">

    <div class="row">

        <div class="col-lg-12">
            <div class="row">
                <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
  
                  <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                      <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                      </li>
                      <li><a class="dropdown-item {{ $filter === 'today' ? 'active' : '' }}" href="{{ route('dashboard.lihat-reports.index', ['filter' => 'today']) }}">Hari ini</a></li>
                      <li><a class="dropdown-item {{ $filter === 'this_week' ? 'active' : '' }}" href="{{ route('dashboard.lihat-reports.index', ['filter' => 'this_week']) }}">Minggu ini</a></li>
                      <li><a class="dropdown-item {{ $filter === 'this_month' ? 'active' : '' }}" href="{{ route('dashboard.lihat-reports.index', ['filter' => 'this_month']) }}">Bulan ini</a></li>
                      <li><a class="dropdown-item {{ $filter === 'this_year' ? 'active' : '' }}" href="{{ route('dashboard.lihat-reports.index', ['filter' => 'this_year']) }}">Tahun ini</a></li>
                      <li><a class="dropdown-item {{ $filter === 'all' ? 'active' : '' }}" href="{{ route('dashboard.lihat-reports.index', ['filter' => 'all']) }}">Semua</a></li>
                    </ul>
                  </div>
  
                  <div class="card-body">
                    <h5 class="card-title">Laporan Kerja
                      <span>|
                        @if ($filter === 'today')
                        Hari ini
                        @elseif ($filter === 'this_week')
                            Minggu ini
                        @elseif ($filter === 'this_month')
                            Bulan ini
                        @elseif ($filter === 'this_year')
                            Tahun ini
                        @else
                            Semua
                        @endif
                      </span>
                    </h5>
  
                    <table class="table table-borderless datatable small" id="tabelku">
                      <thead>
                        <tr>
                          <th scope="col" data-sortable="false" class="text-center">No.</th>
                          <th scope="col">Nama</th>
                          <th scope="col" data-sortable="false">Jabatan</th>
                          <th scope="col" data-sortable="false">Kegiatan</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Status</th>
                          <th scope="col" data-sortable="false">Lokasi</th>
                          <th scope="col" class="text-center" data-sortable="false">File</th>
                          <th scope="col" class="text-center" data-sortable="false">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($reports as $report)
                        <tr>
                          
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $report->user->name }}</td>
                          <td>{{ $report->user->jabatan->name }}</td>
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
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
  
                  </div>
  
                </div>
              </div>

            </div>
        </div>


    </div>


</section>


@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
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


@push('scripts')
    @php
        $pageTitle = 'Lihat Laporan Pegawai';
        $breadcrumbItem = 'Lihat Laporan Pegawai';
    @endphp
@endpush