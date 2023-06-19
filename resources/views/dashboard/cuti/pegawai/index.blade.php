@extends('dashboard.layouts.main')

@section('container')


<section class="section">
    <div class="row">
      <div class="col-lg-6">
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
          <a href="/dashboard/cuti/pegawai/create" class="btn btn-primary mb-3">Ajukan Cuti</a>
        </div>
      
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"></h5>
      
            <table class="table table-borderless datatable">
              <thead>
                <tr class="table-primary">
                  <th scope="col" data-sortable="false">#</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col" data-sortable="false">Keperluan</th>
                  <th scope="col" >Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cutis as $cuti)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cuti->tanggal }}</td>
                    <td>{{ $cuti->keperluan }}</td>
                    <td>
                      @if (is_null($cuti->status))
                          <span>Dalam Proses</span>
                      @elseif ($cuti->status)
                          <span>Disetujui</span>
                      @else
                          <span>Ditolak</span>
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
        $pageTitle = 'Cuti Pegawai';
        $breadcrumbItem = 'Cuti Pegawai';
    @endphp
@endpush
