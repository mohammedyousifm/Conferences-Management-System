@extends('4-layout.backend');
@section('title' , 'Author Papers')
@section('content')
<div id="Auther-dashboard" class="mt-5" x-data="dashboard">
    {{-- Welcome --}}
    <div class="card shadow-sm p-4 mb-4 bg-white rounded">
        <h2 class="text-black">Papers</h2>
        <p class="lead text-muted">Manage your submissions, track your papers, and stay updated with the latest notifications.</p>
    </div>

    {{-- Paper Table --}}
     <div class="table-responsive mt-4">
        <table class="table table-bordered">

          <thead>
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Conference</th>
              <th>Paper code</th>
              <th>Version</th>
              <th>Status</th>
              <th>Submission date</th>
              <th>Paper</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            @if ($Papers->isNotEmpty())
              @foreach ($Papers as $Paper)
              <tr>
                <td class="badge bg-dark bg-opacity-10  px-3 py-2 rounded-pill text-dark">{{ $Paper->id }}</td>
                <td>{{ $Paper->paper_title }}</td>
                <td>{{ $Paper->conference->title }}</td>
                <td>{{ $Paper->paper_code }}</td>
                <td>{{ $Paper->id }}</td>
                <td>v- {{ $Paper->id }}</td>
                <td>
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ $Paper->status }}</span>
                </td>
                <td>{{ $Paper->created_at }}</td>

                <td>
                    <a href="" class="btn bg text mb-2  btn-sm" download target="_blank">Downlowd</a>
                  <div x-data="{ open: false }" class="position-relative">
                      <!-- Dropdown Button -->
                      <button @click="open = !open" class="btn bg text btn-info btn-sm">
                          Actions ▼
                      </button>

                      <!-- Dropdown Menu -->
                      <div x-show="open" @click.outside="open = false" class="position-absolute bg-white shadow rounded p-2" style="min-width: 110px; z-index: 10;">
                          <a  class="dropdown-item text-primary">
                              📄 View
                          </a>
                          <hr>
                          <form action="" method="POST" class="m-0">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="dropdown-item text-danger w-100 text-left">
                                  ❌ Delete
                              </button>
                          </form>
                      </div>
                  </div>
              </td>
            </tr>
              @endforeach

            @else

            @endif

          </tbody>
        </table>
      </div>


 </div>
@endsection
