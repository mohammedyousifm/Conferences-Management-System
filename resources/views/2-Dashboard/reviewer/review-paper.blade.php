@extends('4-layout.backend');
@section('title' , 'Reviewer Dashboard')
@section('content')
<section x-data="{open: false}">
    <div class=" shadow-lg border-0 p-1">
        <div class="card-header bg text-center p-2 text-white">
            <h4 class="mb-0">Paper Details</h4>
        </div>
        <div class="card-body">
                  {{-- Paper & Author Details --}}
                  <div class="d-flex  justify-between  border p-3 rounded bg-light">
                    <ul class="m-3 p-1 list-group list-group-flush">
                        <li class="list-group-item"><h4 class="mb-3">📄 Paper Details</h4></li>
                        <li class="list-group-item"><p><strong>Paper Code:</strong> {{ $paper->paper_code }} </p></li>
                        <li class="list-group-item"><p><strong>Title:</strong> {{ $paper->paper_title }} </p></li>
                        <li class="list-group-item"><p><strong>Abstract:</strong> {{ $paper->abstract }} </p></li>
                        <li class="list-group-item"><p><strong>version:</strong> {{ $paper->version }} </p></li>
                        <li class="list-group-item"><p><strong>keywords:</strong> {{ $paper->keywords }} </p></li>
                        <li class="list-group-item"><p><strong>status:</strong> {{ $paper->status }} </p></li>
                        <li class="list-group-item"><p><strong>submission date:</strong> {{ $paper->created_at }} </p></li>
                    </ul>
                    <ul class="m-3 p-1 list-group list-group-flush">
                         <li class="list-group-item"><h4>✍️ Author Details</h4>
                         <li class="list-group-item"><p><strong>Name:</strong> {{ $paper->author_name }} </p></li>
                         <li class="list-group-item"><p><strong>Email:</strong> {{ $paper->email }}</p></li>
                         <li class="list-group-item"><p><strong>Phone Number:</strong> {{ $paper->phone }} </p></li>
                         <li class="list-group-item"><p><strong>Address :</strong> {{ $paper->address }} </p></li>
                         <li class="list-group-item"><p><strong>Number of Authors:</strong> {{ $paper->number_of_authors }} </p></li>
                         <li class="list-group-item">
                            <strong>Paper File:</strong>
                            <a href="{{ asset($paper->paper_file) }}"  download  class="btn btn-sm bg text " target="_blank">
                                <i class="bi bi-file-earmark-pdf"></i> View Paper
                            </a>
                        </li>
                    </ul>
                    <ul class="m-3 p-1 list-group list-group-flush">
                        <li class="list-group-item"><h4><i class="fa-solid fa-circle-user"></i> Allocated Reviewer </h4>
                            @if ($paper->reviewers->count() > 0)
                            <div>
                                @foreach ($paper->reviewers as $reviewer)
                                <li class="list-group-item"><p><strong>Name:</strong> {{ $reviewer->name}} </p></li>
                                <li class="list-group-item"><p><strong>Email:</strong> {{ $reviewer->email }}</p></li>
                              @endforeach
                                <li class="list-group-item">
                                    @foreach ($paper->comment_paper as $reviewer)
                                    <li class="list-group-item">
                                        <strong>Comment from Reviewer:</strong>
                                        @if (!empty($reviewer->comment) || !empty($reviewer->comment_file))
                                         <span class="badge bg-success"><i class="fa-solid text-bg fa-check"></i> Done</span>
                                        @else
                                        <a x-on:click="open = !open; $nextTick(() => { document.querySelector('#commint').scrollIntoView({ behavior: 'smooth' }) })"
                                            href="#commint" class="btn btn-sm bg text">
                                             📝 Add Comment
                                         </a>
                                        @endif
                                    </li>
                                @endforeach
                                </li>
                            </div>
                        @else
                            <p class="mt-2 mb-1 text-muted"><em>No reviewers assigned yet.</em></p>
                        @endif
                   </ul>

                 </div>

              {{-- commint --}}
              <section id="commint" class="p-2 commint" >
                  <form x-show="open" action="{{ route('papers_commint.reviewer', $paper->id) }}" method="POST" enctype="multipart/form-data"  class="mt-4" >
                      @csrf
                      <div class="mb-3">
                          <label class="form-label m-2 fw-bold">Comment to Author</label>
                          <textarea name="comment" class="form-control" rows="4" placeholder="Write your Commint here..." required></textarea>
                      </div>

                      <div class="mb-3">
                          <label for="paper_file" class="form-label m-2 fw-bold">Upload File <small>(Optional)</small></label>
                          <input type="file" name="paper_file" id="paper_file" class="form-control">
                        </div>

                      {{-- Submit Button --}}
                      <button type="submit" class="btn bg text w-100">
                          <i class="bi bi-send"></i> Submit
                      </button>
                  </form>
              </section>



        </div>
    </div>
</section>







     </div>
   </div>
@endsection
    {{-- Bootstrap 5 Styling for Star Rating --}}
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-start;
        }
        .star {
            font-size: 1.8rem;
            color: #ccc;
            cursor: pointer;
            transition: color 0.3s;
        }
        .star:hover,
        .star:hover ~ .star,
        input[type="radio"]:checked ~ .star {
            color: gold;
        }
    </style>
