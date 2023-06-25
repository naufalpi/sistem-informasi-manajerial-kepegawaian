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
          <a href="/dashboard/cuti/pegawai/create" class="btn btn-primary mb-3">Ajukan Cuti</a>
        </div>
      
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Pengajuan Cuti Saya</h5>
      
            <table class="table table-borderless table-sm" id="tabelku">
              <thead>
                <tr class="table-primary" style="font-size: 13px">
                  <th scope="col" data-sortable="false" class="text-center">No</th>
                  <th scope="col" data-sortable="false">Tanggal Mulai</th>
                  <th scope="col" data-sortable="false">Tanggal Selesai</th>
                  <th scope="col">Jenis</th>
                  <th scope="col" data-sortable="false">Alasan</th>
                  <th scope="col" >Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cutis as $cuti)
                  <tr style="font-size: 13px">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $cuti->tgl_mulai }}</td>
                    <td>{{ $cuti->tgl_selesai }}</td>
                    <td>{{ $cuti->jenis_cuti }}</td>
                    <td>{{ $cuti->alasan }}</td>
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


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      new simpleDatatables.DataTable("#tabelku", {
        searchable: false,
        perPageSelect: false,
        perPage: 5
      });
    });
  </script>
@endsection

@push('scripts')
    @php
        $pageTitle = 'Cuti Pegawai';
        $breadcrumbItem = 'Cuti Pegawai';
    @endphp
@endpush
