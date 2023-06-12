<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIMPEG | Dashboard</title>
   

    <!-- Favicons -->
    <link href="/image/logo.png" rel="icon">
    <link href="/image/apple-touch-icon.png" rel="apple-touch-icon">

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

    <!-- Template Main CSS File -->
    <link href="/css/dashboard/style.css" rel="stylesheet">

    <!-- Trix Editor -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <!-- Cropper -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" rel="stylesheet">
  

    <style>
      .button-container {
          display: flex;
          justify-content: center;
          gap: 10px;
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
      </div><!-- End Page Title -->

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


    
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 

    <!-- cropper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>
  </body>
</html>
