@extends('4-layout.frantend')
@section('title', 'Sign Up')
@section('content')

    <section id="login">
        <div class="text-center bg">
            <p class="p-2 text">LPUNEST Study Grant 7th Edition: Applications Open - Apply Now!</p>
        </div>

        <div class="container">
            <div class="row d-flex justify-content-center align-items-center flex-column-reverse flex-lg-row h-90">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('3-images/logo1.jpg') }}" class="img-fluid login-image" width="100%"
                        alt="Sample image">
                </div>

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

                    <form id="login" method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email input -->
                        <div class="mb-3">
                            <label for="email" data-mdb-input-init class="form-outline mb-3">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="form-control form-control-lg" placeholder="Enter a valid email address">
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        {{-- Password input --}}
                        <div class="mb-3">
                            <label for="password" data-mdb-input-init class="form-outline mb-3">Password</label>
                            <input id="password" type="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter password">
                            @error('password')<div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            {{-- Forgot your password --}}
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-bg text-bold text-decoration-none"
                                    style="font-size: 12px">Forgot your password?</a>
                            @endif
                        </div>

                        {{-- Log in --}}
                        <button type="submit" class="btn mt-2 bg text w-100">login</button>
                        <a href="{{ route('register') }}" class="btn mt-1 bg  w-100">Don't have an account?</a>
                    </form>

                </div>
            </div>
        </div>
    </section>



@endsection

<style>
    #header,
    footer {
        display: none !important;
    }

    #login .login-image {
        height: 100%;
        border-radius: 15px;
        border: 2px solid var(--bg-color);
    }

    #login .divider {
        background-color: var(--bg-color) !important;
        border-radius: 5px;
    }

    #login .divider p {
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


    #login form input a {
        font-size: 11px;
    }

    #login form a {
        opacity: .5;
        font-weight: bold;
    }

    #login form input:focus {
        outline: none !important;
        box-shadow: none !important;
        border-color: var(--bg-color) !important;
    }
</style>