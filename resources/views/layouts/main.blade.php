<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SI Kepegawaian | {{ $title }} </title>

  <!-- Favicons -->
  <link href="/image/favicon.png" rel="icon">
  <link href="/image/apple-touch-icon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="/css/dashboard/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/dashboard/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/css/style.css" rel="stylesheet">

  <style>
    .welcome-title {
      font-size: 40px;
    }

    .btn-block {
      width: 100%;
    }

    @media (max-width: 576px) {
      .welcome-title {
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

  </style>
 
  </head>
<body>
  
  <div class="container">
    @yield('container')
  </div>

    <!-- Vendor JS Files -->
    <script src="/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/js/dashboard/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="/js/dashboard/main.js"></script>
    
</body>
</html>