@extends('4-layout.backend');
@section('title', 'Reviewer Status')
@section('content')
    <section>
        <div class="shadow-lg border-0">
            <div class="card-header bg bg-primary text-center p-2 text-white">
                <h4 class="mb-0 fs-13">Paper Details</h4>
            </div>
            <div class="card-body">

                {{-- Paper & Author Details --}}
                <div class="d-flex  justify-between  border  rounded bg-light">

                    <ul class="m-2 p-1 w-50 list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="fs-12">📄 Paper Details</h4>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Paper Code:</strong> {{ $paper->paper_code }} </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Title:</strong> {{ $paper->paper_title }} </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>keywords:</strong> {{ $paper->keywords }} </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>status:</strong> {{ $paper->status }} </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>submission date:</strong> {{ $paper->created_at }} </p>
                        </li>
                        <li class="list-group-item">
                            <strong class="fs-12">version 1:</strong>
                            <a href="{{ asset($paper->paper_file) }}" download class="btn btn-sm bg text fs-12"
                                target="_blank">
                                <i class="bi bi-file-earmark-pdf"></i> View Paper
                            </a>
                        </li>
                        @if (!empty($paper->paperFileV2))
                            <li class="list-group-item">
                                <strong class="fs-12">version 2:</strong>
                                <a href="{{ asset($paper->paperFileV2) }}" download class="btn btn-sm bg text fs-12"
                                    target="_blank">
                                    <i class="bi bi-file-earmark-pdf"></i> View Paper
                                </a>
                            </li>
                        @endif
                    </ul>

                    <ul class="m-2 p-1  w-50  list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="fs-12">✍️ Author Details</h4>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Name:</strong> {{ $paper->author_name }} </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Email:</strong> {{ $paper->email }}</p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Phone Number:</strong> {{ $paper->phone }} </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Address :</strong> {{ $paper->address }} </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Number of Authors:</strong> {{ $paper->number_of_authors }} </p>
                        </li>
                        @foreach ($paper->comment_paper as $reviewer)
                            <li class="list-group-item">
                                @if (!empty($reviewer->comment) || !empty($reviewer->comment_file))
                                    <strong class="fs-12">Comment from Reviewer:</strong>
                                    <span class="badge bg-success"><i class="fa-solid p-1 fs-13  text-bg fa-check"></i> Done</span>
                                @endif
                            </li>
                        @endforeach
                        <li class="list-group-item">
                            @foreach ($paper->controller_report as $report)
                                @if (!empty($report))
                                    <strong class="fs-12">Report from Controller:</strong>
                                    <span class="badge bg-success"><i class="fa-solid p-1 fs-13  text-bg fa-check"></i> Done</span>
                                @else
                                    <strong>Send report to Author:</strong>
                                    <button
                                        x-on:click="open = !open; $nextTick(() => { document.querySelector('#commint').scrollIntoView({ behavior: 'smooth' }) })"
                                        class="btn btn-sm bg text ">
                                        <i class="bi bi-file-earmark-pdf"></i> Send report
                                    </button>
                                @endif
                            @endforeach
                        </li>
                    </ul>

                </div>

                <div>
                    <ul class="m-3   list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="fs-13"><i class="fa-solid fa-circle-user"></i> Allocated Reviewer </h4>
                            @if ($paper->reviewers->count() > 0)
                                            <div>
                                                @foreach ($paper->reviewers as $reviewer)
                                                    <li class="list-group-item">
                                                        <p class="fs-12"><strong>Name:</strong> {{ $reviewer->name}} </p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p class="fs-12"><strong>Email:</strong> {{ $reviewer->email }}</p>
                                                    </li>
                                                    @foreach ($paper->comment_paper as $reviewer)
                                                        <li class="list-group-item">
                                                            @if (!empty($reviewer->comment) || !empty($reviewer->comment_file))
                                                                <strong class="fs-12">Comment from Reviewer:</strong>
                                                                <p class="fs-12 pt-1">{{ $reviewer->comment }}</p>
                                                                <strong class="fs-12">Comment File:</strong>
                                                                <a href="{{ asset($reviewer->comment_file) }}" download class="btn fs-12 btn-sm bg text "
                                                                    target="_blank">
                                                                    <i class="bi bi-file-earmark-pdf"></i> View File
                                                                </a>

                                                                <br class="divider">
                                                                <a class="btn bg text mt-3 fs-13" href="{{ route('controller.report', $paper->id) }}">Generate
                                                                    report</a>
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                @endforeach
                                </div>
                            @else
                                <p class="mt-2 mb-1 text-muted"><em>No reviewers assigned yet.</em></p>
                            @endif
                </ul>
            </div>


        </div>
        </div>
    </section>
    </div>
    </div>
@endsection