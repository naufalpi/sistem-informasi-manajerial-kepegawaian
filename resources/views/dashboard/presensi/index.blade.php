@extends('dashboard.layouts.main')

@section('container')

<section class="section">

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

    @if(session()->has('fail'))
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          Swal.fire({
            title: 'Error',
            text: '{{ session('fail') }}',
            icon: 'error',
            timer: 3000, // Waktu dalam milidetik (3000ms = 3 detik)
            showConfirmButton: false
          });
        });
      </script>
    @endif

    @if(session()->has('alert'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          title: 'Info',
          text: '{{ session('alert') }}',
          icon: 'info',
          timer: 3000, // Waktu dalam milidetik (3000ms = 3 detik)
          showConfirmButton: false
        });
      });
    </script>
  @endif


    <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Masukan Kode Presensi</h5>
              <form action="{{ route('dashboard.presensi.presensi') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" class="form-control" name="kode_presensi">
                </div>
                <button type="submit" class="btn btn-primary">Presensi</button>
              </form>
            </div>
          </div>
        </div>


        <div class="col-lg-8">
          <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Daftar Kehadiran Saya</h5>
                  <table class="table table-borderless table-sm" id="tabelku">
                      <thead>
                          <tr class="table-primary" style="font-size: 15px;">
                              <th scope="col" data-sortable="false" class="text-center">No</th>
                              <th scope="col" class="text-center">Hari</th>
                              <th scope="col" class="text-center">Tanggal</th>
                              <th scope="col" class="text-center">Waktu Presensi</th>
                              <th scope="col" class="text-center">Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($presensiUsers as $data)
                          <tr style="font-size: 14px">
                              <td class="text-center">{{ $loop->iteration }}</td>
                              <td class="text-center">{{ $data->hari }}</td>
                              <td class="text-center">{{ $data->tanggal }}</td>
                              @if ($data->status == 1)
                                <td class="text-center">{{ $data->waktu_masuk }}</td>
                              @else
                                <td class="text-center">-</td>
                              @endif
                              <td class="text-center">
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


@endsection

@push('scripts')
    @php
        $pageTitle = 'Presensi';
        $breadcrumbItem = 'Presensi';
    @endphp
@endpush
