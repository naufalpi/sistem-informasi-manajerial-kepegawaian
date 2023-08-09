<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SI Kepegawaian | {{ $pageTitle }}</title>
   

    <!-- Favicons -->
    <link href="/image/logo.png" rel="icon">
    <link href="/image/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/css/dashboard/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/dashboard/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/css/dashboard/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/css/dashboard/quill/quill.snow.css" rel="stylesheet">
    <link href="/css/dashboard/quill/quill.bubble.css" rel="stylesheet">
    <link href="/css/dashboard/remixicon/remixicon.css" rel="stylesheet">
    <link href="/css/dashboard/simple-datatables/style.css" rel="stylesheet">

    {{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css"> --}}
   

    <!-- Template Main CSS File -->
    <link href="/css/dashboard/style.css" rel="stylesheet">

    <!-- Trix Editor -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <!-- Cropper -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  

    <style>
      .button-container {
          display: flex;
          justify-content: center;
          gap: 10px;
      }

      @media (max-width: 767px) {
        .hide-on-mobile {
          display: none;
        }
      }

      .form-group {
         position: relative;
      }

      .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        background-color: transparent;
        border: none;
      }

      .toggle-password:focus {
        outline: none;
      }

      .card-bodi {
        max-height: 250px; /* Atur tinggi tetap sesuai keinginan */
        overflow-x: hidden;
        overflow-y: auto;
      }

      /* Gaya khusus untuk scrollbar horizontal */
      .card-bodi::-webkit-scrollbar {
        display: none;
      }
      
      .tengah {
        padding: 70px 0;
        text-align: center;
      }

      .custom-icon {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      overflow: hidden;
      }
      .custom-icon div {
        width: 100%;
        height: 100%;
      }


      #map {
        height: 500px;
      }
  
      .keterangan {
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
      }
    </style>



  </head>
  <body>

    @include('dashboard.layouts.header')
    @include('dashboard.layouts.sidebar')

    {{-- <div class="container-fluid">
        <div class="row">
            

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('container')
            </main>
        </div>
    </div> --}}

    <main id="main" class="main">

      <div class="pagetitle">
        <h1>{{ $pageTitle }}</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item">{{ $breadcrumbItem }}</li>
          </ol>
        </nav>
      </div>

      @yield('container')
  
    </main>


    <script src="/js/dashboard/apexcharts/apexcharts.min.js"></script>
    <script src="/js/dashboard/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/js/dashboard/chart.js/chart.umd.js"></script>
    <script src="/js/dashboard/echarts/echarts.min.js"></script>
    <script src="/js/dashboard/quill/quill.min.js"></script>
    <script src="/js/dashboard/simple-datatables/simple-datatables.js"></script>
    <script src="/js/dashboard/tinymce/tinymce.min.js"></script>
    <script src="/js/dashboard/php-email-form/validate.js"></script>
    <script src="/js/dashboard/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    <!-- cropper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script> --}}
  </body>
</html>
