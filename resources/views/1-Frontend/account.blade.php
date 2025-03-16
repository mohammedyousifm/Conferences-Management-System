@extends('4-layout.frantend')
@section('title', 'My profile')
@section('content')
    <section id="acouunt" class="pb-5">

        <div class="container mt-5">
            <div class="card p-4">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $user->name }}" placeholder="Enter your name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" value="{{ $user->email }}"
                                placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">+91</span>
                                <input type="text" class="form-control" value="{{ $user->mobile_number }}"
                                    placeholder="Enter mobile number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Program</label>
                            <select class="form-select">
                                <option selected>M.Sc. (Information Technology)</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">State <span class="text-danger">*</span></label>
                            <select class="form-select">
                                <option selected>Punjab</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" placeholder="Enter your city">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg mt-2 text">Save & Continue</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

@endsection

<style>
    #acouunt {
        padding-top: 110px
    }

    #acouunt form label {
        font-size: 11px;
    }

    #acouunt form input,
    #acouunt form select {
        font-size: 12px;
    }

    #acouunt form .btn {
        font-size: 12px;
    }
</style>