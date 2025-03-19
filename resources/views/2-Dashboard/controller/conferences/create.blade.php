@extends('4-layout.backend');
@section('title', 'Add Conferences')
@section('content')

    <section id="AddCoference">


        <div class="container mt-5">
            <div class="card fs-13 p-4">
                <form action="{{ route('controller.store_conference') }}" method="POST">
                    @csrf

                    {{-- controller_id --}}
                    <input type="hidden" value="{{ Auth::user()->id }}" name="controller_id">

                    {{-- Conference Title --}}
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Conference Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control fs-12" name="title" placeholder="Enter Conference Title">
                        </div>
                    </div>

                    {{-- Start Date & End Date --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Start Date<span class="text-danger">*</span></label>
                            <input type="date" name="start_date"
                                class="form-control fs-12 @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">End Date<span class="text-danger">*</span></label>
                            <input type="date" name="end_date"
                                class="form-control fs-12 @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Registration Deadline & Location --}}
                    <div class="row mb-3">

                        <div class="col-md-6">
                            <label class="form-label">Registration Deadline<span class="text-danger">*</span></label>
                            <input type="date" name="registration_deadline"
                                class="form-control fs-12 @error('registration_deadline') is-invalid @enderror"
                                value="{{ old('registration_deadline') }}">
                            @error('registration_deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Location</label>
                            <input type="text" name="location"
                                class="form-control fs-12 @error('location') is-invalid @enderror"
                                value="{{ old('location') }}" placeholder="Enter the  Location">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description<span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control fs-12 @error('description') is-invalid @enderror"
                            rows="8">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg mt-2 fs-13 text">Save & Continue</button>
                    </div>
                </form>
            </div>
        </div>

    </section>

    </div>

@endsection