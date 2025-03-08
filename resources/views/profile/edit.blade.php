@extends('4-layout.backend');
@section('title' , 'Controller Dashboard')
@section('content')

<section>
    <h2 class="text-center text-dark">Profile</h2>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

</section>

</div>

@endsection
