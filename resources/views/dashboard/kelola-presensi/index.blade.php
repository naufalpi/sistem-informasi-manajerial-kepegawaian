@extends('dashboard.layouts.main')

@section('container')

<section class="section">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <form action="{{ route('dashboard.kelola-presensi.buka') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary mb-3">Buka Presensi</button>
        </form>
    </div>

</section>


@endsection

@push('scripts')
    @php
        $pageTitle = 'Kelola Presensi Pegawai';
        $breadcrumbItem = 'Kelola Presensi Pegawai';
    @endphp
@endpush
