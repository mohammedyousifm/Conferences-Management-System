@extends('4-layout.frantend')
@section('title', 'Sign in')
@section('content')

    {{-- register --}}
    <section id="login">
        <div class="text-center head bg">
            <p class="p-2">LPUNEST Study Grant 7th Edition: Applications Open - Apply Now!</p>
        </div>

        <div class="container">
            <div class="row d-flex justify-content-center align-items-center flex-column-reverse flex-lg-row h-90">

                <!-- Image Section -->
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('3-images/logo1.jpg') }}" class="img-fluid login-image" width="100%"
                        alt="Login Image">
                </div>

                <!-- Registration Form -->
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form id="register" method="POST" action="{{ route('register') }}">
                        @csrf

                        @if(request()->has('token'))
                            <input type="hidden" name="token" value="{{ request()->query('token') }}">
                        @endif

                        <!-- Name Field -->
                        <div class="mb-4">
                            <label class="form-label text-dark" for="name">Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                autocomplete="name" class="form-control">
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label class="form-label text-dark" for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autocomplete="username" class="form-control">
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="form-control">
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-4">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                autocomplete="new-password" class="form-control">
                            @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn mt-2 bg text w-100">Register</button>
                        <a href="{{ route('login') }}" class="btn mt-1 bg  w-100">I have account</a>
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
</style>