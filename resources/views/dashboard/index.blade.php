@extends('dashboard.layouts.main')

@section('container')

<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Welcome back, {{ auth()->user()->name }}</h5>
                            <marquee behavior="scroll" direction="left" scrollamount="10">
                                <strong><span style="font-size: 35px;">Selamat Datang di Sistem Informasi Kepegawaian Kantor Desa Wanakarsa</span></strong>
                            </marquee>
                        </div>
                    </div>
                </div>

                

            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->

        @can('kades')
        <div class="col-lg-4">

            <div class="card">      
                <div class="card-body">
                    <div class="card-bodi">
                        <div>
                            <h5 class="card-title">Aktivitas Terbaru</h5>

                            @foreach ($activities as $item)
                            <div class="row" style="font-size: 12px;">
                                <div class="col-lg-4 col-md-4 label ">{{ $item->created_at_formatted }}</div>
                                <div class="col-lg-2 col-md-4"><i class='bi bi-circle-fill activity-badge text-success'></i></div>
                                <div class="col-lg-6 col-md-4">{{ $item->description }}</div>
                            </div>
                            @endforeach      
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        @endcan
        @can('sekdes')
        <div class="col-lg-4">

            <div class="card">      
                <div class="card-body">
                    <div class="card-bodi">
                        <div>
                            <h5 class="card-title">Aktivitas Terbaru</h5>

                            @foreach ($activities as $item)
                            <div class="row" style="font-size: 12px;">
                                <div class="col-lg-4 col-md-4 label ">{{ $item->created_at_formatted }}</div>
                                <div class="col-lg-2 col-md-4"><i class='bi bi-circle-fill activity-badge text-success'></i></div>
                                <div class="col-lg-6 col-md-4">{{ $item->description }}</div>
                            </div>
                            @endforeach      
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
        @endcan

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
        $pageTitle = 'Dashboard';
        $breadcrumbItem = 'Dashboard';
    @endphp
@endpush