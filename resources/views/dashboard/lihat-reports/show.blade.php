@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-8">
            <h1 class="mb-3">{{ $report->kegiatan }}</h1>

            <article class="my-3">
                {!! $report->keterangan !!}
            </article>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    @php
        $pageTitle = 'Lihat Laporan Kerja';
        $breadcrumbItem = 'LihatLaporan Kerja';
    @endphp
@endpush