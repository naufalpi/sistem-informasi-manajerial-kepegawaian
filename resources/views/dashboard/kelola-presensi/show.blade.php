@extends('dashboard.layouts.main')

@section('container')

<section class="section">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-0">Kode Presensi: </h5>
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <h1 class="card-title mb-0" style="font-size: 30px">{{ session('kodePresensi') }}</h1>
                        <form action="{{ route('dashboard.kelola-presensi.buka') }}" method="POST">
                            @csrf
                            <button id="reloadButton" class="btn btn-transparent" type="submit">
                                <i class="ri ri-refresh-line"></i>
                            </button>
                        </form>
                    </div>
                    <p id="countdown"></p>
                </div>
            </div>
        </div>

        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
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

    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> <!-- Menggunakan Moment.js melalui CDN -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var countdownElement = document.getElementById('countdown');

        // Ambil waktu kedaluwarsa dari backend atau sesuaikan dengan kebutuhan
        var expireTime = moment("{{ session('expireTime') }}");

        // Perbarui waktu mundur setiap detik
        setInterval(function() {
            var now = moment();
            var diff = expireTime.diff(now);

            var countdown;

            if (diff <= 0) {
                countdown = 'Sesi telah berakhir';
            } else {
                var minutes = Math.floor(diff / 60000);
                var seconds = Math.floor((diff % 60000) / 1000);
                countdown = minutes + " menit " + seconds + " detik";
            }

            // Tampilkan waktu tersisa pada elemen countdown
            countdownElement.textContent = countdown;

            // Jika waktu kedaluwarsa, refresh halaman
            if (diff <= 0) {
                location.reload();
            }
        }, 1000); // Update setiap 1 detik (1000ms)
    });


    document.addEventListener("DOMContentLoaded", function () {
    new simpleDatatables.DataTable("#tabelku", {
    });
  });
</script>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Presensi Pegawai';
        $breadcrumbItem = 'Kelola Presensi Pegawai / Kode Presensi';
    @endphp
@endpush
