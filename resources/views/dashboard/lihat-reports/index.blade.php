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
  
                    <table class="table table-borderless datatable table-sm" id="reportsTable">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col" data-sortable="false">Jabatan</th>
                          <th scope="col" data-sortable="false">Kegiatan</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col" class="text-center" data-sortable="false">File</th>
                          <th scope="col" class="text-center" data-sortable="false">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($reports as $report)
                        <tr>
                          
                          <th scope="row"><a href="#">{{ $loop->iteration }}</a></th>
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
  
                </div>
              </div>

            </div>
        </div>


    </div>


</section>


@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // document.addEventListener("DOMContentLoaded", function() {
  //   const datatables = document.querySelectorAll('.datatable');
  //   datatables.forEach(datatable => {
  //     new simpleDatatables.DataTable(datatable, {
  //       language: {
  //         lengthMenu: "Tampilkan _MENU_ data per halaman",
  //         zeroRecords: "Tidak ditemukan data",
  //         info: "Menampilkan halaman _PAGE_ dari _PAGES_",
  //         infoEmpty: "Tidak ada data yang tersedia",
  //         infoFiltered: "(disaring dari total _MAX_ data)",
  //         search: "Cari:",
  //         paginate: {
  //           first: "Awal",
  //           last: "Akhir",
  //           next: "Selanjutnya",
  //           previous: "Sebelumnya"
  //         }
  //       }
  //     });
  //   });
  // });

</script>


@push('scripts')
    @php
        $pageTitle = 'Lihat Laporan Pegawai';
        $breadcrumbItem = 'Lihat Laporan Pegawai';
    @endphp
@endpush