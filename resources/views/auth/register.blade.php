@extends('4-layout.frantend')
@section('title' , 'Sign Up')
@section('content')

    {{-- register  --}}
    <section id="login" class="vh-100 ">
        <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="{{ asset('3-images/login-image.jpg') }}"
              class="img-fluid login-image" width="100%" alt="Sample image">
          </div>

        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
           <form id="register" method="POST" action="{{ route('register') }}" >
                               @csrf

                               @if(request()->has('token'))
                                   <input type="hidden" name="token" value="{{ request()->query('token') }}">
                               @endif

                               <div class="mb-3">
                                   <label class="form-label text-dark">Name</label>
                                   <input  id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="form-control">
                               </div>


                               <div class="mb-3">
                                   <label class="form-label text-dark">Email</label>
                                   <input  id="email"  type="email" name="email" :value="old('email')" required autocomplete="username" class="form-control">
                               </div>

                               <!-- Password -->
                                <div class="mt-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input id="password" type="password" name="password" required  autocomplete="new-password" class="form-control">
                                    @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" required  autocomplete="new-password" class="form-control">
                                    @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>

                               <button type="submit" class="btn mt-3 bg btn-primary w-100">Register</button>
           </form>
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
