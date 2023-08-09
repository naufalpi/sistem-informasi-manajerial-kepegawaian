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
                          <th scope="col">Kategori</th>
                          <th scope="col" data-sortable="false">Tanggal</th>
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
                          <td>{{ $report->kategori }}</td>
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

        <div class="col-lg-6">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Jumlah Laporan Kerja per Kategori</h5>
      
                  <!-- Bar Chart -->
                  <div id="barChartt"></div>
      
                  <script>
                      document.addEventListener("DOMContentLoaded", () => {
                          const categoryData = @json($categoryData);

                          new ApexCharts(document.querySelector("#barChartt"), {
                              series: [{
                                  data: categoryData.data
                              }],
                              chart: {
                                  type: 'bar',
                                  height: 350
                              },
                              plotOptions: {
                                  bar: {
                                      borderRadius: 4,
                                      horizontal: true
                                  }
                              },
                              dataLabels: {
                                  enabled: false
                              },
                              xaxis: {
                                  categories: categoryData.categories
                              },
                              tooltip: {
                                  y: {
                                      formatter: function (value) {
                                          return 'Jumlah Laporan: ' + value;
                                      }
                                  }
                              }
                          }).render();
                      });
                  </script>
                  <!-- End Bar Chart -->
      
              </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rata-rata Durasi Laporan Kerja per Kategori</h5>
        
              <!-- Bar Chart -->
              <div id="barC"></div>
        
              <script>
              document.addEventListener("DOMContentLoaded", () => {
                const labels = @json($categoryDurationData['categories']);
                const data = @json($categoryDurationData['average_durations']);

                new ApexCharts(document.querySelector("#barC"), {
                    series: [{
                        data: data
                    }],
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 4,
                            horizontal: true,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: labels,
                        labels: {
                            formatter: function(value) {
                              const hours = Math.floor(value / 3600);
                              return value;
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                const hours = Math.floor(value / 3600);
                                const minutes = Math.floor((value % 3600) / 60);
                                return hours + ' Jam ' + minutes + ' Menit';
                            }
                        }
                    }
                }).render();
              });
            

            </script>
              
              <!-- End Bar Chart -->
        
            </div>
          </div>
        </div>
      
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Laporan Bulanan</h5>

              <!-- Line Chart -->
              <canvas id="lineChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const monthlyData = @json($monthlyData); // Menyimpan data dari controller ke variabel JavaScript
            
                    const labels = monthlyData.map(data => {
                        const month = data.month;
                        const indonesianMonths = {
                            'January': 'Januari',
                            'February': 'Februari',
                            'March': 'Maret',
                            'April': 'April',
                            'May': 'Mei',
                            'June': 'Juni',
                            'July': 'Juli',
                            'August': 'Agustus',
                            'September': 'September',
                            'October': 'Oktober',
                            'November': 'November',
                            'December': 'Desember'
                        };
                        return indonesianMonths[month];
                    });
            
                    const data = monthlyData.map(data => data.total);
            
                    new Chart(document.querySelector('#lineChart'), {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Laporan',
                                data: data,
                                fill: false,
                                borderColor: 'rgb(75, 192, 192)',
                                tension: 0.1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
              </script>
              <!-- End Line CHart -->

            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Durasi Kerja per Minggu</h5>
      
                  <!-- Bar Chart -->
                  <canvas id="barChart" style="max-height: 400px;"></canvas>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      const employeeData = @json($employeeData); // Menyimpan data dari controller ke variabel JavaScript
            
                      const labels = employeeData.map(data => data.name);
                      const durationsInSeconds = employeeData.map(data => data.total_duration);
            
                      // Fungsi untuk mengubah total durasi dalam detik menjadi format "HH Jam MM Menit"
                      function formatDuration(totalSeconds) {
                        const hours = Math.floor(totalSeconds / 3600);
                        const minutes = Math.floor((totalSeconds % 3600) / 60);
            
                        return `${hours} Jam`;
                      }

                      function formatDuration2(totalSeconds) {
                        const hours = Math.floor(totalSeconds / 3600);
                        const minutes = Math.floor((totalSeconds % 3600) / 60);
            
                        return `${hours} Jam ${minutes} Menit`;
                      }

                      function tooltipCallback(context) {
                        const index = context.dataIndex;
                        const totalDuration = durationsInSeconds[index];
                        const numReports = employeeData[index].num_reports;

                        return [
                          `Jumlah laporan pekerjaan: ${numReports}`,
                          `Total durasi pekerjaan: ${formatDuration2(totalDuration)}`
                        ];
                      }
            
                      new Chart(document.querySelector('#barChart'), {
                        type: 'bar',
                        data: {
                          labels: labels,
                          datasets: [{
                            label: 'Total Durasi Kerja',
                            data: durationsInSeconds,
                            backgroundColor: [
                              'rgba(255, 99, 132, 0.2)',
                              'rgba(255, 159, 64, 0.2)',
                              'rgba(255, 205, 86, 0.2)',
                              'rgba(75, 192, 192, 0.2)',
                              'rgba(54, 162, 235, 0.2)',
                              'rgba(153, 102, 255, 0.2)',
                              'rgba(201, 203, 207, 0.2)'
                            ],
                            borderColor: [
                              'rgb(255, 99, 132)',
                              'rgb(255, 159, 64)',
                              'rgb(255, 205, 86)',
                              'rgb(75, 192, 192)',
                              'rgb(54, 162, 235)',
                              'rgb(153, 102, 255)',
                              'rgb(201, 203, 207)'
                            ],
                            borderWidth: 1
                          }]
                        },
                        options: {
                          scales: {
                            y: {
                              beginAtZero: true,
                              ticks: {
                                callback: function (value) {
                                  return formatDuration(value); // Menggunakan fungsi untuk mengubah format durasi
                                }
                              }
                            }
                          },
                          plugins: {
                            tooltip: {
                              callbacks: {
                                label: function (context) {
                                  const value = context.parsed.y;
                                  return tooltipCallback(context); // Menggunakan fungsi untuk mengubah format durasi pada tooltip
                                }
                              }
                            }
                          }
                        }
                      });
                    });
                  </script>
                  <!-- End Bar Chart -->
      
              </div>
          </div>
        </div>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Status Laporan</h5>

              <!-- Pie Chart -->
              <canvas id="pieChart" style="max-height: 265px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const statusData = @json($statusData); // Menyimpan data dari controller ke variabel JavaScript
            
                    const labels = statusData.map(data => data.status);
                    const data = statusData.map(data => data.total);
                    const backgroundColor = ['rgb(255, 205, 86)', 'rgb(54, 162, 235)', 'rgb(255, 99, 132)'];
            
                    new Chart(document.querySelector('#pieChart'), {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Jumlah Laporan',
                                data: data,
                                backgroundColor: backgroundColor,
                                hoverOffset: 4
                            }]
                        }
                    });
                });
              </script>
              <!-- End Pie CHart -->

            </div>
          </div>
        </div>

        {{-- <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Lokasi Paling Sering Digunakan</h5>
        
              <!-- Bubble Chart -->
              <canvas id="bubbleChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const locationData = @json($locationData);
              
                  const bubbleData = locationData.map(location => {
                    return {
                      x: location.usage_count,
                      y: location.usage_count,
                      r: location.usage_count
                    };
                  });
              
                  new Chart(document.querySelector('#bubbleChart'), {
                    type: 'bubble',
                    data: {
                      labels: locationData.map(location => location.label),
                      datasets: [{
                        label: 'Lokasi',
                        data: bubbleData,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgb(255, 99, 132)'
                      }]
                    },
                    options: {
                      responsive: true,
                      plugins: {
                        legend: {
                          position: 'top'
                        },
                      },
                      tooltips: {
                        callbacks: {
                          label: function (context) {
                            var label = context.dataset.label || '';
                            if (label) {
                              label += ': ';
                            }
                            if (context.parsed.y !== null) {
                              label += context.parsed.y + ' kali';
                            }
                            return label;
                          }
                        }
                      }
                    }
                  });
                });
              </script>
            </div>
          </div>
        </div> --}}


        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Persebaran Lokai Laporan Kerja Pegawai</h5>
              <div id="map" style="height: 500px;"></div>
              <div class="keterangan">
                <h3>Keterangan</h3>
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            @foreach($locationData as $data)
                                @if($data['label'] === 'RT 07/RW 01')
                                    <li><span style="background-color: #ff0000; display: inline-block; width: 12px; height: 12px;"></span> RT 07/RW 01 = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'RT 06/RW 01')
                                    <li><span style="background-color: #00ff00; display: inline-block; width: 12px; height: 12px;"></span> RT 06/RW 01 = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'RT 05/RW 01')
                                    <li><span style="background-color: #0000ff; display: inline-block; width: 12px; height: 12px;"></span> RT 05/RW 01 = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'RT 01/RW 01')
                                    <li><span style="background-color: #ffff00; display: inline-block; width: 12px; height: 12px;"></span> RT 01/RW 01 = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'RT 02/RW 01')
                                    <li><span style="background-color: #ff00ff; display: inline-block; width: 12px; height: 12px;"></span> RT 02/RW 01 = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'RT 04/RW 01')
                                    <li><span style="background-color: #00ffff; display: inline-block; width: 12px; height: 12px;"></span> RT 04/RW 01 = {{ $data['usage_count'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul>
                            @foreach($locationData as $data)
                                @if($data['label'] === 'RT 03/RW 01')
                                    <li><span style="background-color: #800080; display: inline-block; width: 12px; height: 12px;"></span> RT 03/RW 01 = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'RT 03/RW 02')
                                    <li><span style="background-color: #ffa500; display: inline-block; width: 12px; height: 12px;"></span> RT 03/RW 02 = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'Rawawindu')
                                    <li><span style="background-color: #008000; display: inline-block; width: 12px; height: 12px;"></span> Rawawindu = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'Kantor Desa')
                                    <li><span style="background-color: #ff69b4; display: inline-block; width: 12px; height: 12px;"></span> Kantor Desa = {{ $data['usage_count'] }}</li>
                                @elseif($data['label'] === 'Kecamatan')
                                    <li><span style="background-color: #000000; display: inline-block; width: 12px; height: 12px;"></span> Kecamatan = {{ $data['usage_count'] }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
              </div>
            
            </div>
          </div>
        </div>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            // Data lokasi RT di desa Wanakarsa (contoh)
            const rtData = [
              { rt: 'RT 07/RW 01', lat: -7.366665, lng: 109.629395, iconColor: '#ff0000' },
              { rt: 'RT 06/RW 01', lat: -7.366119, lng: 109.630947, iconColor: '#00ff00' },
              { rt: 'RT 05/RW 01', lat: -7.365736, lng: 109.632807, iconColor: '#0000ff' },
              { rt: 'RT 01/RW 01', lat: -7.368612, lng: 109.628932, iconColor: '#ffff00' },
              { rt: 'RT 02/RW 01', lat: -7.368506, lng: 109.631122, iconColor: '#ff00ff' },
              { rt: 'RT 04/RW 01', lat: -7.366994, lng: 109.633478, iconColor: '#00ffff' },
              { rt: 'RT 03/RW 01', lat: -7.368944, lng: 109.633031, iconColor: '#800080' },
              { rt: 'RT 03/RW 02', lat: -7.373123, lng: 109.633890, iconColor: '#ffa500' },
              { rt: 'Rawawindu', lat: -7.377557, lng: 109.635886, iconColor: '#008000' },
              { rt: 'Kantor Desa', lat: -7.366381921317957, lng: 109.6339661602891, iconColor: '#ff69b4' },
              { rt: 'Kecamatan', lat: -7.367376584772909,  lng: 109.6301876282293, iconColor: '#000000' },
              // Tambahkan data RT lainnya...
            ];

            // Data koordinat batas-batas desa Wanakarsa (contoh)
            const desaWanakarsaCoords = [
              [-7.372037, 109.629021],
              [-7.371632, 109.629308],
              [-7.371283, 109.629344],
              [-7.369827, 109.629142],
              [-7.368130, 109.627919],
              [-7.367925, 109.628208],
              [-7.365445, 109.628617],
              [-7.363285, 109.636132],
              [-7.363875, 109.639140],
              [-7.380820, 109.638921],
              [-7.383416, 109.633128],
              [-7.377798, 109.625188],
            
              // Tambahkan koordinat lainnya hingga membentuk poligon tertutup...
            ];
      
            // Hitung koordinat tengah desa Wanakarsa
            const centerLat = -7.367322; // Ganti dengan latitude koordinat tengah desa Wanakarsa
            const centerLng = 109.634171; // Ganti dengan longitude koordinat tengah desa Wanakarsa
      
            // Inisialisasi peta dan set tampilan awal
            const map = L.map('map').fitBounds(desaWanakarsaCoords);

            // Tambahkan layer OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // Tambahkan poligon untuk batas desa Wanakarsa
            const desaWanakarsaPolygon = L.polygon(desaWanakarsaCoords, {
              color: 'red', // Ganti dengan warna garis yang diinginkan
              weight: 1,    // Ganti dengan ketebalan garis yang diinginkan (dalam piksel)
              fillColor: 'transparent', // Ganti dengan warna poligon yang diinginkan
              fillOpacity: 0.5,  // Ganti dengan tingkat transparansi poligon (0 - 1)
            }).addTo(map);

            function getCustomIcon(iconColor) {
              return L.divIcon({
                className: 'custom-icon',
                html: `<div style="background-color: ${iconColor};"></div>`,
                iconSize: [10, 10], // Atur ukuran ikon sesuai keinginan
                iconAnchor: [10, 10], // Atur anchor ikon (posisi tengah) sesuai keinginan
              });
            }

            // Tambahkan marker dan popup untuk setiap RT
            rtData.forEach(rt => {
              const marker = L.marker([rt.lat, rt.lng], { icon: getCustomIcon(rt.iconColor) }).addTo(map);
              marker.bindPopup(rt.rt);
            });

            
          });
        </script>

          

        
        

       
        
        
        
      
        
        


    </div>


</section>


@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

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
                  <div class="col-lg-3 col-md-4 label" style="text-align: left; font-size: 20px;">Kategori</div>
                  <div class="col-lg-9 col-md-8" style="text-align: left; font-size: 20px; color: black;">${response.kategori}</div>
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