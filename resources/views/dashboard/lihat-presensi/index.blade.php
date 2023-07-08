@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Presensi Pegawai</h5>
            <table class="table table-borderless table-sm" id="tabelku">
                <thead>
                    <tr class="table-primary" style="font-size: 15px;">
                        <th scope="col" data-sortable="false" class="text-center">No</th>
                        <th scope="col"  data-sortable="false">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Hari, Tanggal</th>
                        <th scope="col">Waktu Presensi</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensiUsers as $data)
                    <tr style="font-size: 14px">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $data->user->name }}</td>
                        <td class="hide-on-mobile">{{ $data->user->jabatan->name }}</td>
                        <td>{{ $data->hari }}, {{ $data->tanggal }}</td>
                          @if ($data->status == 1)
                              <td>{{ $data->waktu_masuk }}</td>
                          @else
                              <td>-</td>
                          @endif
                        <td>
                          @if ($data->status == 1)
                              Hadir
                          @else
                              Tidak Hadir
                          @endif
                      </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
          </div>
        </div>
      </div>


      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Grafik Presensi Pegawai</h5>
            <canvas id="barChart"></canvas>
          </div>
        </div>
      </div>
      
      <script>
        document.addEventListener("DOMContentLoaded", () => {
          const presensiData = @json($presensiUsers);
      
          // Membuat array tanggal unik
          const uniqueDates = Array.from(new Set(presensiData.map(item => item.tanggal)));
      
          // Mengelompokkan data berdasarkan tanggal
          const groupedData = uniqueDates.map(date => {
            const hadirCount = presensiData.filter(item => item.tanggal === date && item.status === 1).length;
            const tidakHadirCount = presensiData.filter(item => item.tanggal === date && item.status === 0).length;
            return {
              tanggal: date,
              hadir: hadirCount,
              tidakHadir: tidakHadirCount
            };
          });
      
          // Mengambil array tanggal dan data hadir-tidak hadir
          const labels = groupedData.map(item => item.tanggal);
          const dataHadir = groupedData.map(item => item.hadir);
          const dataTidakHadir = groupedData.map(item => item.tidakHadir);
      
          new Chart(document.querySelector("#barChart"), {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Hadir',
                data: dataHadir,
                backgroundColor: 'rgb(54, 162, 235)'
              }, {
                label: 'Tidak Hadir',
                data: dataTidakHadir,
                backgroundColor: 'rgb(255, 99, 132)'
              }]
            },
            options: {
              responsive: true,
              indexAxis: 'x',
              plugins: {
                legend: {
                  position: 'top'
                }
              }
            }
          });
        });
      </script>
      
      
    

      
  
    </div>
  </section>

  <script>

    document.addEventListener("DOMContentLoaded", function () {
      new simpleDatatables.DataTable("#tabelku", {
        perPage: 10
      });
    });

  </script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Lihat Presensi Pegawai';
        $breadcrumbItem = 'Lihat Presensi Pegawai';
    @endphp
@endpush