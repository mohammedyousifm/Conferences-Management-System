@extends('4-layout.backend');
@section('title' , 'Reviewe  Paper')
@section('content')


     <section id="Reviewe-Paper">
        <div class="card shadow-sm p-4 mb-4 bg-white rounded">
            <div  class=" d-flex justify-content-between mt-2">
              <h2 class="text-black">Papers</h2>
             </div>
             <p class="lead text-muted">Manage the Papers, track the papers, and stay updated with the latest notifications.</p>
         </div>

            <!-- Paper Table -->
            <div class="paper-table">
              <table class="table table-bordered mt-4">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Conference</th>
                    <th>Title</th>
                    <th>Paper code</th>
                    <th>Version</th>
                    <th>Status</th>
                    <th>Submission date</th>
                    <th>Paper</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  @if ($papers->isNotEmpty())
                     @foreach ($papers as $paper)
                     <tr>
                        <td class="p-3">{{ $paper->id }}</td>
                        <td class="p-3">{{ $paper->paper->conference->title }}</td>
                        <td class="p-3">{{ $paper->paper->paper_title }}</td>
                        <td class="p-3">{{ $paper->paper->paper_code }}</td>
                        <td class="p-3">v- {{ $paper->paper->version }}</td>
                        <td class="p-3">
                            <span class="text {{ $paper->status === 'Done' ? 'status-done' : 'status-in' }}">
                                {{ $paper->status }}
                            </span>

                         </td>
                        <td class="p-3">{{ $paper->paper->created_at->format('Y M') }}</td>
                        <td class="p-3">
                            <a href="{{ asset($paper->paper->paper_file) }}" class="btn bg text btn-sm" download target="_blank">Downlowd</a>
                        </td>
                        <td class="p-3">
                            <a class="btn  bg text btn-sm" href="{{ route('review_papers.reviewer' , $paper->paper->id) }}">View</a>
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
     </section>
    </div>
@endsection

