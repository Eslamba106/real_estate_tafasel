<!DOCTYPE html>
<html lang="ar"  >

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>تفاصيل</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('logo.png') }}" rel="icon">
  <link href="{{ asset('logo.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('front_assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front_assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('front_assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('front_assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front_assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('front_assets/css/main.css') }}" rel="stylesheet">
  <style>
    .btn-primary {
      color: #0e1b3d !important;
    }
  </style>
  <!-- =======================================================
  * Template Name: FlexStart
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Updated: Nov 01 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  @include('front_office.includes.header')

  <main class="main">
    @yield('content')
  </main>

 @include('front_office.includes.footer')
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('front_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
  <script src="{{ asset('front_assets/vendor/php-email-form/validate.js') }} "></script>
  <script src="{{ asset('front_assets/vendor/aos/aos.js') }} "></script>
  <script src="{{ asset('front_assets/vendor/glightbox/js/glightbox.min.js') }} "></script>
  <script src="{{ asset('front_assets/vendor/purecounter/purecounter_vanilla.js') }} "></script>
  <script src="{{ asset('front_assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }} "></script>
  <script src="{{ asset('front_assets/vendor/isotope-layout/isotope.pkgd.min.js') }} "></script>
  <script src="{{ asset('front_assets/vendor/swiper/swiper-bundle.min.js') }} "></script>

  <!-- Main JS File -->
  <script src="{{ asset('front_assets/js/main.js') }}"></script>

</body>

</html>