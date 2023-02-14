<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <title>SIMPEG | Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet"> --}}

    <title>SIMPEG | Dashboard</title>
   

    <!-- Favicons -->
    <link href="/image/favicon.png" rel="icon">
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
  

    {{-- <style>
      trix-toolbar [data-trix-button-group="file-tools"] {
        display-none;
      }
    </style> --}}

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

      @yield('container')
  
    </main>


    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

     <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

    <script src="/js/dashboard.js"></script> --}}

   

    <script src="/js/dashboard/apexcharts/apexcharts.min.js"></script>
    <script src="/js/dashboard/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/js/dashboard/chart.js/chart.umd.js"></script>
    <script src="/js/dashboard/echarts/echarts.min.js"></script>
    <script src="/js/dashboard/quill/quill.min.js"></script>
    <script src="/js/dashboard/simple-datatables/simple-datatables.js"></script>
    <script src="/js/dashboard/tinymce/tinymce.min.js"></script>
    <script src="/js/dashboard/php-email-form/validate.js"></script>
    <script src="/js/dashboard/main.js"></script>
  </body>
</html>
