<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('1-css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('1-css/frantend.css') }}">
</head>

<body>
    <section id="login">
        <div class="text-center head bg">
            <p class="p-2">You have been invited to review papers for the Conference Management System</p>
        </div>
        <div class="container">

            <div class="row d-flex justify-content-center align-items-center flex-column-reverse flex-lg-row h-90">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="{{ asset('3-images/logo1.jpg') }}" class="img-fluid login-image" width="100%"
                        alt="Sample image">
                </div>

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <h2 class="fs-13">Complete Your Reviewer Registration</h2>
                    <form action="{{ route('reviewer.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $invitation->token }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ $invitation->email }}"
                                readonly>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn mt-2 bg text w-100">Register</button>
                    </form>
                </div>
            </div>
    </section>
</body>

</html>