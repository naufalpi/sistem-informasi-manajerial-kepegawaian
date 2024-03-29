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
      
      
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Daftar Semua Pengajuan Cuti</h5>
            
            <table class="table table-borderless table-sm" id="tabelku">
              <thead>
                <tr class="table-primary" style="font-size: 13px;">
                  <th scope="col" data-sortable="false" class="text-center">No</th>
                  <th scope="col"  data-sortable="false" class="tengah">Nama</th>
                  <th scope="col" class="hide-on-mobile">Jabatan</th>
                  <th scope="col">Tanggal Mulai</th>
                  <th scope="col">Tanggal Selesai</th>
                  <th scope="col">Jenis Cuti</th>
                  <th scope="col" data-sortable="false">Alasan</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cutis as $cuti)
                  <tr style="font-size: 12px">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $cuti->user ? $cuti->user->name : 'N/A' }}</td>
                    <td class="hide-on-mobile">{{ $cuti->user && $cuti->user->jabatan ? $cuti->user->jabatan->name : 'N/A' }}</td>
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

      

        <div class="card">
          <div class="card-body">
              <h5 class="card-title">Jumlah Pengajuan Cuti Pegawai</h5>

              <table class="table table-borderless table-sm" id="tabelku">
                  <thead>
                      <tr class="table-primary" style="font-size: 13px;">
                          <th scope="col" data-sortable="false" class="text-center">No</th>
                          <th scope="col" data-sortable="false">Nama</th>
                          <th scope="col" class="hide-on-mobile">Jabatan</th>
                          <th scope="col" data-sortable="false" class="text-center">Jumlah Pengajuan Cuti</th>
                          <th scope="col" data-sortable="false" class="text-center">Pengajuan Diterima</th>
                          <th scope="col" data-sortable="false" class="text-center">Pengajuan Ditolak</th>
                          <th scope="col" class="text-center" data-sortable="false">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($cutis->groupBy('user_id') as $cutiGroup)
                      @php
                      $firstCuti = $cutiGroup->first();
                      @endphp
                      <tr style="font-size: 12px" >
                          <td class="text-center">{{ $loop->iteration }}</td>
                          <td>{{ $firstCuti->user ? $firstCuti->user->name : 'N/A' }}</a></td>
                          <td class="hide-on-mobile">{{ $firstCuti->user && $firstCuti->user->jabatan ? $firstCuti->user->jabatan->name : 'N/A' }}</td>
                          <td class="text-center">{{ $cutiGroup->count() }}</td>
                          <td class="text-center">{{ $cutiGroup->where('status', true)->count() }}</td>
                          <td class="text-center">{{ $cutiGroup->where('status', false)->count() }}</td>
                          <td class="text-center" onclick="showDataModal('{{ $firstCuti->user ? $firstCuti->user->name : 'N/A' }}', '{{ $firstCuti->user && $firstCuti->user->jabatan ? $firstCuti->user->jabatan->name : 'N/A' }}', {{ $firstCuti->user_id }}, {{ $cutiGroup->count() }}, {{ $cutiGroup->where('status', true)->count() }}, {{ $cutiGroup->where('status', false)->count() }})"><a href="#" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
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
      });
    });

    document.addEventListener("DOMContentLoaded", function () {
      new simpleDatatables.DataTable("#mytable", {
        perPage: 15
      });
    });

    function showDataModal(nama, jabatan, user_id, pengajuanCuti, pengajuanDiterima, pengajuanDitolak) {
      var userCuti = @json($cutis);
      var leaveRequests = userCuti.filter((cuti) => cuti.user_id === user_id);

      var tableRows = leaveRequests.map((request) => {
        return `
            <tr>
              <td style="font-size: 12px;">${request.tgl_mulai}</td>
              <td style="font-size: 12px;">${request.tgl_selesai}</td>
              <td style="font-size: 12px;">${request.alasan}</td>
              <td style="font-size: 12px;">${request.status ? 'Disetujui' : 'Ditolak'}</td>
            </tr>
        `;
      });

      Swal.fire({
        title: 'Data Pengajuan Cuti Pegawai',
        html: `
          <div style="font-size: 15px; text-align: center;">
            <p><strong>Nama:</strong> ${nama}</p>
            <p><strong>Jabatan:</strong> ${jabatan}</p>
            <p><strong>Jumlah Pengajuan Cuti:</strong> ${pengajuanCuti}</p>
            <p><strong>Pengajuan Diterima:</strong> ${pengajuanDiterima}</p>
            <p><strong>Pengajuan Ditolak:</strong> ${pengajuanDitolak}</p>
          </div>
          <table class="table">
            <thead>
              <tr style="font-size: 15px">
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Alasan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              ${tableRows.join('')}
            </tbody>
          </table>
        `,
        icon: 'info',
        confirmButtonText: 'OK'
      });
    }


</script>


@endsection

@push('scripts')
    @php
        $pageTitle = 'Lihat Cuti Pegawai';
        $breadcrumbItem = 'Lihat Cuti Pegawai';
    @endphp
@endpush
