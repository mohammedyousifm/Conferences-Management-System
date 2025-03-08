@extends('4-layout.backend');
@section('title' , 'Controller Send Reviewer Invitation')
@section('content')
      <section  id="AddReviwer">
          <div class="card shadow-sm p-4 mb-4 bg-white rounded">
              <div  class=" d-flex justify-content-between mt-2">
                <h2 class="text-black">Send Reviewer Invitation</h2>
              </div>
              <p class="lead text-muted">Manage your submissions, track your papers, and stay updated with the latest notifications.</p>
          </div>

        <div class="mt-5">
            <div class="alert alert-success" x-show="successMessage" x-text="successMessage"></div>
            <div class="alert alert-danger" x-show="errorMessage" x-text="errorMessage"></div>

            <form action="{{ route('send-invitation') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Reviewer Email</label>
                    <input type="email" name="email" class="form-control" x-model="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message Email</label>
                    <textarea name="message"  class="form-control" x-model="message" ></textarea>
                </div>

                <button type="submit" class="btn bg btn-primary w-100">Send Invitation</button>
            </form>
        </div>

      </section>
      </div>
    </div>
@endsection
