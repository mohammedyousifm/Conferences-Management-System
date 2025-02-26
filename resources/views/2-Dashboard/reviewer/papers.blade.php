@extends('4-layout.backend');
@section('title' , 'Reviewe  Paper')
@section('content')

<div class="heding mt-2">
    <h3 class="card-title fw-bold text-dark mb-3">Papers</h3>
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

                            @foreach ($papers as $paper)
                             <tr>
                                <td>{{ $paper->id }}</td>
                                <td>{{ $paper->paper->conference->title }}</td>
                                <td>{{ $paper->paper->paper_title }}</td>
                                <td>{{ $paper->paper->paper_code }}</td>
                                <td>v- {{ $paper->paper->version }}</td>

                                <td>
                                    <form action="{{ route('papers.updateStatus', $paper->id) }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <select name="status" class="form-select form-select-sm" id="status-select-{{ $paper->id }}"
                                                onchange="handleStatusChange({{ $paper->id }})"
                                                {{ $paper->status == 'Completed' ? 'disabled' : '' }}>

                                            <!-- Show current status as the first option -->
                                            <option value="{{ $paper->status }}" selected>{{ ucfirst($paper->status) }}</option>

                                            <!-- Display only the other statuses -->
                                            @foreach(['Received' , 'Under_review', 'Completed'] as $status)
                                                @if($status !== $paper->status)
                                                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        <!-- Hidden submit button -->
                                        <button type="submit" id="submit-btn-{{ $paper->id }}" class="btn btn-success btn-sm mt-2" style="display: none;">Submit</button>
                                    </form>
                                </td>

                                <td>{{ $paper->created_at->format('Y M') }}</td>
                                <td>
                                    <a href="{{ asset($paper->paper->paper_file) }}" class="btn bg text btn-sm" download target="_blank">Downlowd</a>
                                </td>
                                <td>
                                    <a class="btn  bg text btn-sm" href="{{ route('review_papers.reviewer' , $paper->paper->id) }}">View</a>
                                </td>
                              </tr>
                            @endforeach

                      </tbody>
                    </table>
                  </div>

        {{-- end Main Content --}}
    </div>

@endsection
