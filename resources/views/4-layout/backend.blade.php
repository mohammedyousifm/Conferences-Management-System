<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
  <title>@yield('title' , 'Dashboard')</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome for Icons -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   <!-- Alpine.js -->
   <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

   {{-- style --}}
   <link rel="stylesheet" href="{{ asset('1-css/main.css') }}">
   <link rel="stylesheet" href="{{ asset('1-css/backend.css') }}">

     {{-- ajax --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

      {{-- pusher --}}
      <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

 </head>
 <body>

    {{-- php code | Get authenticated user role and return the respective route --}}
    @php
    function getUserRoute(string $type) {
        $role = auth()->user()->user_role ?? 'guest';
        $routes = [
            'dashboard' => [
                'reviewer' => 'reviewer.dashboard',
                'controller' => 'controller.dashboard',
                'author' => 'author.dashboard',
                'default' => 'home',
            ],
            'paper' => [
                'reviewer' => 'papers.reviewer',
                'controller' => 'papers.controller',
                'author' => 'track_status.author',
                'default' => 'home',
            ],
        ];

        return route($routes[$type][$role] ?? $routes[$type]['default']);
    }
   @endphp


   <div x-data="{ sidebarOpen: false, darkMode: false }">

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3 bg-dark text-white" :class="{ open: sidebarOpen }">

        <!-- Logo & Toggle Button -->
        <div class="d-flex align-items-center justify-content-center mb-3">
            <h4 class="fw-bold p-3">Dashboard</h4>
        </div>

        <!-- Navigation Menu -->
        <ul class="nav flex-column">

            <li class="nav-item mb-1">
                <a class="nav-link text-white d-flex align-items-center
                 {{ request()->routeIs('reviewer.dashboard' , 'controller.dashboard' ,  'author.dashboard')  ? 'active' : '' }} "
                  href="{{ getUserRoute('dashboard') }}">

                  <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 25px;">
                    <i class="fas fa-home me-2"></i>
                  </div>

                    <span>Home</span>

                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('papers.reviewer' , 'papers.controller' , 'track_status.author' , 'review_papers.controller')  ? 'active' : '' }}  text-white d-flex align-items-center"
                 href="{{ getUserRoute('paper') }}">

                 <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 25px;">
                     <i class="fas fa-file-alt me-2"></i>
                 </div>
                    <span>Papers</span>
                </a>

            </li>

            @if (Auth::user()->user_role == 'controller')

             <li class="nav-item mb-1">
                 <a class="nav-link {{ request()->routeIs('conference.controller')  ? 'active' : '' }} text-white d-flex align-items-center"
                     href="{{ route('conference.controller') }}">

                     <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">
                        <i class="fas fa-file-alt me-2"></i>
                      </div>
                     <span>Conference</span>
                 </a>
             </li>

             <li class="nav-item mb-1">
                <a class="nav-link {{ request()->routeIs('addReviewer.controller')  ? 'active' : '' }} text-white d-flex align-items-center"
                    href="{{ route('addReviewer.controller') }}">

                    <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">
                        <i class="fa-solid fa-plus mt-2"></i>
                      </div>

                    <span>Add reviewer</span>
                </a>
            </li>

            <li class="nav-item mb-1">
                <a class="nav-link text-white d-flex align-items-center" href="{{ route('reports.controller' , 1) }}">

                    <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">
                        <i class="fas fa-chart-bar me-2"></i>
                      </div>

                    <span>Reports</span>
                </a>
            </li>

            @endif
            <li class="nav-item mb-1">
                <a class="nav-link text-white d-flex align-items-center {{ request()->routeIs('profile.edit')  ? 'active' : '' }}" href="{{ route('profile.edit') }}">

                    <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">
                        <i class="fas fa-user me-2"></i>
                      </div>

                    <span>Account</span>
                </a>
            </li>
            <li class="nav-item mb-1">
                <a class="nav-link text-white d-flex  align-items-center" href="#">

                    <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">
                        <i class="fas fa-cog me-2"></i>
                      </div>

                    <span>Settings</span>
                </a>
            </li>
        </ul>

        <!-- Sidebar Footer -->
        <div class="mt-auto border-top pt-3">
            <a href="/logout" class="text-white d-flex align-items-center">

                <div class="icon-box d-flex justify-content-center align-items-center me-3" style="width: 35px; height: 35px;">
                    <i class="fas fa-sign-out-alt me-2"></i>
                  </div>

                <span>Logout</span>
            </a>
        </div>

    </div>


     <!-- Main Content -->
      <div class="main-content" :class="{ 'sidebar-open': sidebarOpen }">

      <!-- Top Navbar -->
       <nav id="top-navbar" class="navbar   navbar-custom navbar-expand-lg mb-4">
              <div class="container-fluid">
                <button class="btn btn-light me-2 d-block d-md-none" @click="sidebarOpen = !sidebarOpen">
                  <i class="fas fa-bars"></i>
                </button>
                <div class="d-flex text-center" style="font-weight: bold;">
                    Pages / {{ last(request()->segments()) }}
                  </div>
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn bg text btn-outline-success" type="submit">Search</button>
                </form>

              </div>
     </nav>

      @yield('content')




   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


   {{-- ajax.js  --}}
   <script src="{{ asset('2-js/backend.js') }}"></script>

  </body>
 </html>

