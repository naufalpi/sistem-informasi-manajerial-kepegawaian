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
                <tr style="font-size: 12px;">
                  <th scope="col" class="text-center">No</th>
                  <th scope="col"  data-sortable="false" class="tengah">Nama</th>
                  <th scope="col" class="hide-on-mobile">Jabatan</th>
                  <th scope="col" data-sortable="false">Tanggal Pengajuan</th>
                  <th scope="col" data-sortable="false">Tanggal Mulai</th>
                  <th scope="col" data-sortable="false">Tanggal Selesai</th>
                  <th scope="col" data-sortable="false" class="text-center">Total Hari</th>
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
                    <td>{{ $cuti->created_at }}</td>
                    <td>{{ $cuti->tgl_mulai }}</td>
                    <td>{{ $cuti->tgl_selesai }}</td>
                    <td class="text-center">{{ $cuti->total_hari }}</td>
                    <td>{{ $cuti->jenis_cuti }}</td>
                    <td class="reason" data-full-reason="{{ $cuti->alasan }}">
                      {{ Str::of($cuti->alasan)->limit(10, '...') }}
                    </td>
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
                                <input type="hidden" name="pesan"> <!-- Hidden input untuk menyimpan pesan -->
                                <button type="submit" class="btn btn-danger btn-sm reject-btn"><i class="bi bi-x-square"></i></button>
                            </form>
                          </div>
                        @elseif ($cuti->status)
                            <span class="text-success">Disetujui</span>
                        @else
                            <span class="text-danger">Ditolak / </span>
                            <span><a href="#" class="view-rejection-reason" data-reason="{{ $cuti->pesan }}">Lihat Pesan</a></span>
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
        const approveForms = document.querySelectorAll('.approve-form');
        approveForms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Anda akan menyetujui pengajuan cuti ini. Lanjutkan?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        const rejectForms = document.querySelectorAll('.reject-form');
        rejectForms.forEach(form => {
            const rejectBtn = form.querySelector('.reject-btn');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Alasan Penolakan',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Anda harus memasukkan alasan penolakan'
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const reason = result.value;
                        form.querySelector('[name="pesan"]').value = reason;
                        form.submit();
                    }
                });
            });
        });

        const reasonCells = document.querySelectorAll('.reason');
        reasonCells.forEach(cell => {
            cell.addEventListener('click', function() {
                const fullReason = cell.getAttribute('data-full-reason');
                Swal.fire({
                    title: 'Alasan Cuti',
                    text: fullReason,
                    icon: 'info',
                });
            });
        });

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
        const table = $('#tabelku').DataTable();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const viewReasonButtons = document.querySelectorAll('.view-rejection-reason');
        const rejectionReasonModal = document.getElementById('rejectionReasonModal');
        const rejectionReasonText = document.getElementById('rejectionReason');

        viewReasonButtons.forEach(button => {
            button.addEventListener('click', function() {
                const reason = button.getAttribute('data-reason');
                rejectionReasonText.innerText = reason;
                $(rejectionReasonModal).modal('show');
            });
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
