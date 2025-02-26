@extends('4-layout.frantend')
@section('content')

<div class="container my-5">

    <!-- Conference Details Section -->
    <div class="row mb-5">
      <div class="col-12">
        <h1 class="mb-4">Conference Details</h1>
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">{{ $Conference->title }}</h2>
            <p class="card-text">{{ $Conference->description }}</p>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Start Date:</strong> {{ $Conference->start_date }}</li>
              <li class="list-group-item"><strong>End Date:</strong> {{ $Conference->end_date }}</li>
              <li class="list-group-item"><strong>Registration Deadline:</strong> {{ $Conference->registration_deadline }}</li>
              <li class="list-group-item"><strong>Location:</strong> {{ $Conference->location }}</li>
              <li class="list-group-item"><strong>Status:</strong> {{ $Conference->status }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Application Form Section -->
    <div class="row">
      <div class="col-12">
        <h2 class="mb-4">Apply for the Conference</h2>
        <form action="{{ route('conference.apply') }}" method="POST" enctype="multipart/form-data">

          @csrf

          <!-- Author Information Card -->
          <div class="card mb-4">
            <div class="card-header">
              Author Information
            </div>
            <div class="card-body">
                <input type="hidden" value="{{ $Conference->id }}" name="conference_id">
              <div class="mb-3">
                <label for="author_name" class="form-label">Author Name</label>
                <input type="text" name="author_name" id="author_name" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" name="phone" id="phone" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
              </div>
              {{-- <div class="mb-3">
                <label for="university" class="form-label">University</label>
                <select name="university" id="university" class="form-select" required>
                  <option value="">Select University</option>
                    <option value="lpu">lpu</option>
                </select>
              </div> --}}
              <div class="mb-3">
                <label for="number_of_authors" class="form-label">Number of Authors</label>
                <input type="number" name="number_of_authors" id="number_of_authors" class="form-control" required min="1">
              </div>
            </div>
          </div>

          <!-- Paper Details Card -->
          <div class="card mb-4">
            <div class="card-header">
              Paper Details
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label for="paper_title" class="form-label">Paper Title</label>
                <input type="text" name="paper_title" id="paper_title" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="abstract" class="form-label">Abstract</label>
                <textarea name="abstract" id="abstract" rows="4" class="form-control" required></textarea>
              </div>
              <div class="mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Enter keywords separated by commas" required>
              </div>
              <div class="mb-3">
                <label for="paper_file" class="form-label">Upload Paper</label>
                <input type="file" name="paper_file" id="paper_file" class="form-control" required>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
      </div>
    </div>

  </div>

@endsection
