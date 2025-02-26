@extends('4-layout.frantend')
@section('title' , 'Sign Up')
@section('content')

  <section id="login" class="vh-100 ">
      <div class="container-fluid  h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="{{ asset('3-images/login-image.jpg') }}"
              class="img-fluid login-image" width="100%" alt="Sample image">
          </div>
          <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

              <form id="login" method="POST" action="{{ route('login') }}">
                 @csrf

              <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn bg text btn-floating mx-1">
                  <i class="fab  fa-facebook-f"></i>
                </button>

                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn bg text btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn bg text btn-floating mx-1">
                  <i class="fab fa-linkedin-in"></i>
                </button>
              </div>

              <div class="divider d-flex align-items-center my-4">
                <p class="text-center fw-bold mx-3 mb-0">Or</p>
              </div>


            <!-- Email input -->
              <div class="mb-3">
                  <label for="email" data-mdb-input-init class="form-outline mb-3">Email</label>
                  <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control form-control-lg"
                  placeholder="Enter a valid email address">
                  @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

               {{--  Password input --}}
                <div class="mb-3">
                    <label for="password" data-mdb-input-init class="form-outline mb-3">Password</label>
                    <input id="password" type="password" name="password" class="form-control form-control-lg"
                    placeholder="Enter password">
                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>





                <div class="d-flex justify-content-between align-items-center">
                 {{-- Forgot your password    --}}
                     @if (Route::has('password.request'))
                         <a href="{{ route('password.request') }}" class="text-bg text-bold text-decoration-none" style="font-size: 12px">Forgot your password?</a>
                   @endif
                  </div>

               {{-- Log in   --}}
                <div class="text-center text-lg-start mt-4 pt-2">
                   <button type="submit" class="btn bg btn-primary" style="font-size: 12px">Log in</button>
                   <p class="small fw-bold mt-2 pt-1 mb-0" style="font-size: 12px">Don't have an account? <a href="#!"
                    class="text-bg">Register</a></p>
                </div>

            </form>

          </div>
        </div>
      </div>
  </section>



 @endsection

 <style>
    #login .login-image {
         height: 80%;
         border-radius: 15px;
         border: 2px solid var(--bg-color);
    }

    #login .divider {
        background-color: var(--bg-color) !important;
        border-radius: 5px;
    }

    #login .divider  p{
      font-size: 12px;
    }

    #login .lead {
        font-size: 14px;
    }

    #login form label {
        font-size: 11px;
    }

    #login form input {
        font-size: 12px;
    }


    #login form input  a{
        font-size: 11px;
    }

    #login form  input:focus {
    outline: none !important;
    box-shadow: none !important;
    border-color: var(--bg-color) !important; /* Optional: Removes border color */
  }

 </style>
