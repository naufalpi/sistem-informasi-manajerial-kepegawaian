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
            <h5 class="card-title">Daftar Pengajuan Cuti</h5>
            
            <table class="table table-borderless table-sm" id="tabelku">
              <thead>
                <tr class="table-primary" style="font-size: 13px;">
                  <th scope="col" data-sortable="false" class="text-center">No</th>
                  <th scope="col"  data-sortable="false" class="tengah">Nama</th>
                  <th scope="col" class="hide-on-mobile">Jabatan</th>
                  <th scope="col">Tanggal Mulai</th>
                  <th scope="col">Tanggal Selesai</th>
                  <th scope="col" data-sortable="false">Jenis Cuti</th>
                  <th scope="col" data-sortable="false">Alasan</th>
                  <th scope="col" class="text-center" data-sortable="false">Aksi</th>
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
                    <td class="text-center">
                        @if (is_null($cuti->status))
                            <div class="button-container">
                                <form action="{{ route('cuti.approve', $cuti) }}" method="POST" class="approve-form">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-check-square"></i></button>
                                </form>
                                <form action="{{ route('cuti.reject', $cuti) }}" method="POST" class="reject-form">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-x-square"></i></button>
                                </form>
                            </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Menangani aksi form approve
        const approveForms = document.querySelectorAll('.approve-form');
        approveForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form secara default
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan menyetujui pengajuan cuti ini',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Melanjutkan pengiriman form jika dikonfirmasi
                    }
                });
            });
        });

        // Menangani aksi form reject
        const rejectForms = document.querySelectorAll('.reject-form');
        rejectForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah pengiriman form secara default
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda akan menolak pengajuan cuti ini',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Melanjutkan pengiriman form jika dikonfirmasi
                    }
                });
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
      new simpleDatatables.DataTable("#tabelku", {
      });
    });
</script>


@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Cuti Pegawai';
        $breadcrumbItem = 'Kelola Cuti Pegawai';
    @endphp
@endpush
