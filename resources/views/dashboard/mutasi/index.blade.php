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
        
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <a href="/dashboard/mutasi/create" class="btn btn-primary mb-3">Buat Surat Rekomendasi Mutasi</a>
            </div>
           
        </div>
    </div>
</section>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Mutasi Pegawai';
        $breadcrumbItem = 'Kelola Mutasi Pegawai';
    @endphp
@endpush