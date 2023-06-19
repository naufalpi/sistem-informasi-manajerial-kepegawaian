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

        @can('admin')
        <div class="col-lg-4">

            <!-- Recent Activity -->
            <div class="card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>


                {{-- <div class="card-body">
                    <h5 class="card-title">Aktivitas Terbaru
                        <span></span>
                    </h5>
                    <div class="activity">

                        <div class="activity-item d-flex">
                            <div class="activite-label">32 min</div>
                            <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                            <div class="activity-content">
                            Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae
                            </div>
                        </div><!-- End activity item-->

                        <div class="activity-item d-flex">
                            <div class="activite-label">56 min</div>
                            <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                            <div class="activity-content">
                            Voluptatem blanditiis blanditiis eveniet
                            </div>
                        </div><!-- End activity item-->

                        <div class="activity-item d-flex">
                            <div class="activite-label">2 hrs</div>
                            <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                            <div class="activity-content">
                            Voluptates corrupti molestias voluptatem
                            </div>
                        </div><!-- End activity item-->

                        <div class="activity-item d-flex">
                            <div class="activite-label">1 day</div>
                            <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                            <div class="activity-content">
                            Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore
                            </div>
                        </div><!-- End activity item-->

                        <div class="activity-item d-flex">
                            <div class="activite-label">2 days</div>
                            <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                            <div class="activity-content">
                            Est sit eum reiciendis exercitationem
                            </div>
                        </div><!-- End activity item-->

                        <div class="activity-item d-flex">
                            <div class="activite-label">4 weeks</div>
                            <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                            <div class="activity-content">
                            Dicta dolorem harum nulla eius. Ut quidem quidem sit quas
                            </div>
                        </div><!-- End activity item-->

                    </div>
                </div> --}}

                <div class="card-body">
                    <h5 class="card-title">Aktivitas Terbaru
                        <span></span>
                    </h5>
                    <div class="activity">
                        <table id="tabelku" class="table table-sm datatabel" >
                            <tbody>
                                @foreach ($activities as $item)
                                    <tr>
                                        <td>{{ $item->created_at_formatted }}</td>
                                        <td>
                                            <i class='bi bi-circle-fill activity-badge text-success'></i>
                                        </td>
                                        <td>{{ $item->description }}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div><!-- End Recent Activity -->

        </div><!-- End Right side columns -->
        @endcan

    </div>
  </section>
 

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      new simpleDatatables.DataTable(".datatabel", {
        "searching": false
      });
    });

    $('#tabelku').dataTable( {
    "searching": false
    } );
    </script>
    

@endsection

@push('scripts')
    @php
        $pageTitle = 'Dashboard';
        $breadcrumbItem = 'Dashboard';
    @endphp
@endpush