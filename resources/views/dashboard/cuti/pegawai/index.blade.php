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
                <tr style="font-size: 13px">
                  <th scope="col" data-sortable="false" class="text-center">No</th>
                  <th scope="col" data-sortable="false">Tanggal Pengajuan</th>
                  <th scope="col" data-sortable="false">Tanggal Mulai</th>
                  <th scope="col" data-sortable="false">Tanggal Selesai</th>
                  <th class="text-center" scope="col" data-sortable="false">Total Hari</th>
                  <th scope="col">Jenis</th>
                  <th scope="col" data-sortable="false">Alasan</th>
                  <th scope="col" >Status</th>
                  <th scope="col" data-sortable="false">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($cutis as $cuti)
                  <tr style="font-size: 13px">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $cuti->created_at }}</td>
                    <td>{{ $cuti->tgl_mulai }}</td>
                    <td>{{ $cuti->tgl_selesai }}</td>
                    <td class="text-center">{{ $cuti->total_hari }}</td>
                    <td>{{ $cuti->jenis_cuti }}</td>
                    <td>{{ $cuti->alasan }}</td>
                    <td>
                      @if (is_null($cuti->status))
                          <span class="text-primary">Dalam Proses</span>
                      @elseif ($cuti->status)
                          <span class="text-success">Disetujui</span>
                      @else
                          <span class="text-danger">Ditolak / </span>
                          <span><a href="#" class="view-rejection-reason" data-reason="{{ $cuti->pesan }}">Lihat Pesan</a></span>
                      @endif
                    </td>
                    <td  class="text-center">
                      <form action="/dashboard/cuti/pegawai/{{ $cuti->id }}" method="post" class="d-inline" id="delete-form-{{ $cuti->id }}">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0 text-dark" onclick="confirmDelete(event, '{{ $cuti->id }}')" title="Hapus"><i class="bi bi-x-circle"></i></button>
                      </form>
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


      


     

      // Tombol "Lihat Pesan" untuk penolakan
      const viewRejectionButtons = document.querySelectorAll('.view-rejection-reason');
      viewRejectionButtons.forEach(button => {
          button.addEventListener('click', function() {
              const rejectionReason = button.getAttribute('data-reason');
              Swal.fire({
                  title: 'Alasan Penolakan',
                  text: rejectionReason,
                  icon: 'info',
                  confirmButtonText: 'Tutup'
              });
          });
      });

      // Inisialisasi DataTables
      const table = $('#tabelku').DataTable({
            lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]],
            pageLength: 5,
    
        });
      
    });

    function confirmDelete(event, id) {
      event.preventDefault(); // Hentikan pengiriman form default

      // Tampilkan konfirmasi SweetAlert
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan menghapus pengajuan cuti ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          // Jika pengguna mengklik "Ya, hapus", kirimkan form
          document.getElementById('delete-form-' + id).submit();
        }
      });
    }
  </script>
@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Cuti';
        $breadcrumbItem = 'Kelola Cuti';
    @endphp
@endpush
