@extends('4-layout.backend');
@section('title' , 'Controller Conferences')
@section('content')


<section id="coference-Controller">

    {{-- <div class="card shadow-sm p-4 mb-4 bg-white rounded">
        <div  class=" d-flex justify-content-between mt-2">
          <h2 class="text-black">Conferences</h2>
          <button class="btn bg btn-primary" @click="showModal = true">Add Conference</button>
        </div>
        <p class="lead text-muted">Manage the  Conferences, track the Conferences, and stay updated with the latest notifications.</p>
    </div>

    <div class="heding d-flex justify-content-between mt-2">
        <div class="" x-data="{ showModal: false }">
            <!-- Modal -->
            <div class="modal fade" :class="{ 'show': showModal }" @keydown.escape.window="showModal = false">
                <div class="modal-dialog modal-dialog-centered custom-modal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Conference</h5>
                            <button type="button" class="btn-close" @click="showModal = false"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Conference Form -->
                            <form action="{{ route('conference.store') }}" method="POST">
                                @csrf
                               <!-- Title -->
                                 <div class="mb-3">
                                     <label class="form-label">Conference Title</label>
                                     <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                     @error('title')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <!-- Description -->
                                 <div class="mb-3">
                                     <label class="form-label">Description</label>
                                     <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                     @error('description')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <!-- Start Date -->
                                 <div class="mb-3">
                                     <label class="form-label">Start Date</label>
                                     <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                                     @error('start_date')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <!-- End Date -->
                                 <div class="mb-3">
                                     <label class="form-label">End Date</label>
                                     <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                                     @error('end_date')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <!-- Registration Deadline -->
                                 <div class="mb-3">
                                     <label class="form-label">Registration Deadline</label>
                                     <input type="date" name="registration_deadline" class="form-control @error('registration_deadline') is-invalid @enderror" value="{{ old('registration_deadline') }}">
                                     @error('registration_deadline')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                                 </div>

                                 <!-- Location -->
                                 <div class="mb-3">
                                     <label class="form-label">Location</label>
                                     <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                                     @error('location')
                                         <div class="invalid-feedback">{{ $message }}</div>
                                     @enderror
                                 </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                                    <button type="submit" class="btn btn-success">Save Conference</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="card shadow-sm p-4 mb-4 bg-white rounded">
      <div class="d-flex justify-content-between align-items-center my-3">
          <h4 class="text-dark">Conferences Management</h4>
          <div>
              <button class="btn bg text mx-1" onclick="filterconferences('all')">All
              <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
              </button>
              <button class="btn bg text mx-1" onclick="filterconferences('ongoing')">ongoing
                <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
              </button>
              </button>
              <button class="btn bg text mx-1" onclick="filterconferences('completed')">completed
              <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
              </button>
              <button class="btn bg text mx-1" onclick="filterconferences('upcoming')">upcoming
                <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">10</span>
              </button>
              </button>
          </div>
      </div>

        <div class="d-flex justify-content-end mt-3">
          {{ $Conferences->links('pagination::bootstrap-5') }}
        </div>
    </div>

     <!-- Paper Table -->
    <div class="table-responsive mt-4">
      <table class="table table-bordered">

        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>description</th>
            <th>Status</th>
            <th>start_date</th>
            <th>end_date</th>
            <th>deadline</th>
            <th>location</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

            @if ($Conferences->isNotEmpty())
               @foreach ($Conferences as $Conference)
                  <tr class="conferences-row" data-status="{{ $Conference->status }}">
                     <td class="p-3">{{ $Conference->id }}</td>
                     {{-- <td>{{ $Conference->author->name }}</td> --}}
                     <td class="p-3">{{ Str::limit( $Conference->title , 20 , '....') }}</td>
                     <td x-data="{open: false}" class="p-3">
                       <span x-on:click="open = !open" class="description">
                           {{ Str::limit($Conference->description , 20 , '....') }}
                       </span>
                       <span x-show="open">
                           {{ $Conference->description }}
                       </span>

                     </td>
                     <td class="text-center p-3">
                        <span @class([
                            'badge bg-opacity-10 text-primary px-3 py-2 rounded-pill',
                            'bg text' => $Conference->status == 'upcoming',
                            'bg-pr text' => $Conference->status == 'ongoing',
                            'bg-dark' => $Conference->status == 'completed',
                        ])>
                            {{ $Conference->status }}
                        </span>

                    </td>
                     <td class="p-3">{{ $Conference->start_date }}</td>
                     <td class="p-3">{{ $Conference->end_date }}</td>
                     <td class="p-3">{{ $Conference->registration_deadline }}</td>
                     <td class="p-3">{{ $Conference->location }}</td>
                     <td class="text-center p-3">
                      <a class="btn bg text   btn-info btn-sm" href="{{ route('review_papers.controller' , $Conference->id) }}">View</a>
                    </td>
                   </tr>
              @endforeach
            @else
            <tr>
                <td colspan="10" class="p-5">No Conference found.</td>
               </tr>
            @endif
        </tbody>
      </table>
    </div>

    <div id="no-match">No match found</div>

</section>

</div>



@endsection
