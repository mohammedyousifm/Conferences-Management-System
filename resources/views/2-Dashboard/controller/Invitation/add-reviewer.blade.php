@extends('4-layout.backend');
@section('title', 'Controller Send Reviewer Invitation')
@section('content')
    <section id="AddReviwer">
        <div class="card shadow-sm p-3 mb-4 bg-white rounded">
            <div class=" d-flex justify-content-between mt-2">
                <h2 class="text-black fs-13">Send Reviewer Invitation</h2>
            </div>
            <p class="lea"> By enter the reviewer's email and a personalized message. Once submitted,
                an invitation email will be sent to the reviewer with details on how to
                accept the invitation and access the platform.</p>
        </div>

        <div class="mt-5">
            <div class="alert alert-success" x-show="successMessage" x-text="successMessage"></div>
            <div class="alert alert-danger" x-show="errorMessage" x-text="errorMessage"></div>

            <form action="{{ route('controller.store_reviewer') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label fs-13">Reviewer Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control fs-12" x-model="email" required
                        placeholder="Enter Reviewer Email">
                </div>

                <div class="mb-3">
                    <label class="form-label fs-13">Reviewer Name<span class="text-danger">*</span></label>
                    <input type="text" name="reviewer_name" class="form-control fs-12" x-model="email" required
                        placeholder="Enter Reviewer Email">
                </div>

                <div class="mb-3">
                    <label class="form-label fs-13">Message to reviewer<span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control fs-12" rows="8" x-model="message"
                        placeholder="Enter Message"></textarea>
                </div>

                <button type="submit" class="btn bg btn-primary w-100 fs-13">Send Invitation</button>
            </form>
        </div>

    </section>
    </div>
    </div>
@endsection