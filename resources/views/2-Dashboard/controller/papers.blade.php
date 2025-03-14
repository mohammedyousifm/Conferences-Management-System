@extends('4-layout.backend');
@section('title' , 'Controller Papers')
@section('content')

<section id="Papers-Controller">
    <div class="card shadow-sm p-4 mb-4 bg-white rounded">
       <!-- Paper Table -->
       <div class="d-flex justify-content-between align-items-center my-3">
          <h4 class="text-dark">Paper Management</h4>
          <div>
              <button class="btn bg text mx-1" onclick="filterPapers('all')">All
                 <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">{{ $all_papers_count }}</span>
              </button>
              <button class="btn bg text mx-1" onclick="filterPapers('In Process')">In Process
                <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">{{ $In_Process_papers_count }}</span>
              </button>
              </button>
              <button class="btn bg text mx-1" onclick="filterPapers('Approved')">Approved
              <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">{{ $Approved_papers_count }}</span>
              </button>
              <button class="btn bg text mx-1" onclick="filterPapers('Rejected')">Rejected
                <span  class="badge bg-pr bg-opacity-10  px-2 text py-2 rounded-pill">{{ $Rejected_papers_count }}</span>
              </button>
              </button>
          </div>
      </div>

      <div class="d-flex justify-content-end mt-3">
        {{ $papers->links('pagination::bootstrap-5') }}
     </div>

   </div>

    <div class="table-responsive mt-4">
      <table class="table table-bordered">

        <thead>
          <tr>
            <th>ID</th>
            <th>Conference</th>
            <th>Title</th>
            <th>Paper code</th>
            <th>Version</th>
            <th>Status</th>
            <th>Allocate Reviewer</th>
            <th>Submission date</th>
            <th>Paper</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @if ($papers->isNotEmpty())
              @foreach ($papers as $paper)
              <tr class="paper-row" data-status="{{ $paper->status }}">
                 <td>{{ $paper->id }}</td>
                 <td>{{  Str::limit(  $paper->conference->title , 15 , '....') }}</td>
                 <td>{{ Str::limit( $paper->paper_title , 15 , '....') }}</td>
                 <td>{{ $paper->paper_code }}</td>
                 <td>v- {{ $paper->version }}</td>

                 <td>
                     <form action="{{ route('papers.updateStatus', $paper->id) }}" method="POST">
                         @csrf
                         @method('POST')

                         <select name="status" class="form-select form-select-sm" id="status-select-{{ $paper->id }}"
                                 onchange="handleStatusChange({{ $paper->id }})"
                                 {{ $paper->status == 'Approved' ? 'disabled' : '' }}>

                             <!-- Show current status as the first option -->
                             <option value="{{ $paper->status }}" selected>{{ ucfirst($paper->status) }}</option>

                             <!-- Display only the other statuses -->
                             @foreach(['In process', 'Approved', 'Rejected'] as $status)
                                 @if($status !== $paper->status)
                                     <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                 @endif
                             @endforeach
                         </select>

                         <!-- Hidden submit button -->
                         <button type="submit" id="submit-btn-{{ $paper->id }}" class="btn btn-success btn-sm mt-2" style="display: none;">Submit</button>
                     </form>
                 </td>


                      {{-- Multi-select dropdown to assign users --}}
                       <td>
                         <div class="position-relative">
                             {{-- Toggle Button to Show/Hide Users --}}
                             <button class="btn bg btn-primary btn-sm" onclick="toggleUserList({{ $paper->id }})">
                                 Select Reviewer
                             </button>
                             {{-- Show Already Assigned Users --}}
                                 @if ($paper->reviewers->count() > 0)
                                  <p class="mt-2 mb-1"><em>Assigned Reviewers:</em></p>
                                  <div>
                                      @foreach ($paper->reviewers as $reviewer)
                                          <span class="badge bg bg-info text-white p-2 me-1">
                                              {{ $reviewer->name }}
                                          </span>
                                      @endforeach
                                  </div>
                              @else
                                  <p class="mt-2 mb-1 text-muted"><em>No reviewers assigned yet.</em></p>
                              @endif

                             {{-- Hidden Checkboxes --}}
                             <form action="{{ route('assign.reviewers', $paper->id) }}" method="POST" id="user-form-{{ $paper->id }}" class="mt-2 d-none">
                                 @csrf
                                 <div class="border p-2 rounded" style="max-height: 150px; overflow-y: auto;">
                                     @foreach ($users as $user)
                                         @php
                                             $isAssigned = $paper->reviewers->contains($user->id);
                                         @endphp
                                         <div class="form-check">
                                             <input class="form-check-input user-checkbox-{{ $paper->id }}" type="checkbox" name="reviewers_id[]" value="{{ $user->id }}" id="user{{ $user->id }}-{{ $paper->id }}"
                                                 onclick="limitSelection({{ $paper->id }})" {{ $isAssigned ? 'disabled' : '' }}>
                                             <label class="form-check-label {{ $isAssigned ? 'text-muted' : '' }}" for="user{{ $user->id }}-{{ $paper->id }}">
                                                 {{ $user->name }}
                                                 @if ($isAssigned)
                                                     <span class="badge bg-secondary">Assigned</span>
                                                 @endif
                                             </label>
                                         </div>
                                     @endforeach
                                 </div>
                                 <button type="submit" class="btn btn-success btn-sm mt-2">Assign Reviewer</button>
                             </form>

                             {{-- Selected Users Display --}}
                             <div id="selected-users-{{ $paper->id }}" class="mt-2"></div>
                         </div>
                     </td>



                 <td>{{ $paper->created_at->format('Y M') }}</td>
                 <td>
                   <a href="{{ asset($paper->paper_file) }}" class="btn bg text  btn-sm" download target="_blank">Downlowd</a>
                 </td>
                 <td>
                   <div x-data="{ open: false }" class="position-relative">
                       <!-- Dropdown Button -->
                       <button @click="open = !open" class="btn bg text btn-info btn-sm">
                           Actions ▼
                       </button>

                       <!-- Dropdown Menu -->
                       <div x-show="open" @click.outside="open = false" class="position-absolute bg-white shadow rounded p-2" style="min-width: 110px; z-index: 10;">
                           <a href="{{ route('review_papers.controller', $paper->id) }}" class="dropdown-item text-primary">
                               📄 View
                           </a>
                           <hr>
                           <a href="" class="dropdown-item text-success">
                               📝 Report
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
               <tr>
                <td colspan="10" class="p-5">No papers found.</td>
               </tr>
           @endif
        </tbody>
      </table>
    </div>
    <div id="no-match">No match found</div>
</section>

 </div>
@endsection
