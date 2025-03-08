<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta name="author" content="Lovely Professional University" />
    <link rel="shortcut icon" href="{{ asset('3-images/logo.png') }}" type="image/x-icon">
    <title>@yield('title' , 'LPU - National and International Conferences')</title>

    {{-- Stylesheets --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.lpu.in/lpu-assets/css/bootstrap-grid.css" type="text/css" />
    <link rel="stylesheet" href="https://www.lpu.in/lpu-assets/style.css" type="text/css" />
    <link rel="stylesheet" href="https://www.lpu.in/lpu-assets/css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="https://www.lpu.in/lpu-assets/css/custom.css" type="text/css" />
    <link rel="stylesheet" href="https://schools.lpu.in/school-assets/css/school-custom.css" />

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons for search icon -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

   <!-- Font Awesome for Icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

   <!-- Alpine.js -->
   <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


  <!-- Toastr CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Toastr JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- FontAwesome for Icons -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>



    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('1-css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('1-css/frantend.css') }}">

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>


<body class="stretched home-bg">

    @auth
         <!-- Advanced Navbar -->
       <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm" x-data="{ mobileOpen: false }">
          <div class="container">
            <!-- Logo (modify src to your actual logo) -->
            <a class="navbar-brand" href="#">
              <img src="{{ asset('3-images/logo.png') }}" alt="Conference Logo" width="70">
            </a>
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" @click="mobileOpen = !mobileOpen">
              <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Collapsible Content -->
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>

             <!-- Vertical Separator -->
            <div class="vertical-line mx-3"></div>

              <!-- Search and Auth Buttons -->
              <div class="d-flex align-items-center">
                <!-- Search Bar Toggle -->

                <!-- Sign In and Sign Up Buttons -->
                <a href="{{ route('login') }}" class="btn bg btn-primary m-1">Sign In</a>
                <a href="#" class="btn bg btn-primary m-1">Sign Up</a>
              </div>
            </div>
          </div>
        </nav>

    @endauth

      @yield('content')


    {{-- Go To Top --}}
    <div id="gotoTop" class="icon-angle-up"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



</body>
</html>



