@extends('4-layout.backend');
@section('title', 'Reviewer Status')
@section('content')
    <section x-data="{open: false}">
        <div class=" shadow-lg border-0 p-1">
            <div class="card-header bg bg-primary text-center p-2 text-white">
                <h4 class="mb-0">Paper Details</h4>
            </div>
            <div class="card-body">

                {{-- Paper & Author Details --}}
                <div class="d-flex  justify-between  border p-3 rounded bg-light">
                    <ul class="m-3 p-1 list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="mb-3">📄 Paper Details</h4>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Paper Code:</strong> {{ $paper->paper_code }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Title:</strong> {{ $paper->paper_title }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Abstract:</strong> {{ $paper->abstract }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>version:</strong> {{ $paper->version }} </p>
                        </li>
                    </ul>
                    <ul class="m-3 p-1 list-group list-group-flush">
                        <h4 class="mt-5"></h4>
                        <li class="list-group-item">
                            <p><strong>keywords:</strong> {{ $paper->keywords }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>status:</strong> {{ $paper->status }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>submission date:</strong> {{ $paper->created_at }} </p>
                        </li>
                        <li class="list-group-item">
                            <strong>Paper File:</strong>
                            <a href="{{ asset($paper->paper_file) }}" download class="btn btn-sm bg text " target="_blank">
                                <i class="bi bi-file-earmark-pdf"></i> View Paper
                            </a>
                        </li>
                    </ul>
                    <ul class="m-3 p-1 list-group list-group-flush">
                        <li class="list-group-item">
                            <h4>✍️ Author Details</h4>
                        <li class="list-group-item">
                            <p><strong>Name:</strong> {{ $paper->author_name }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Email:</strong> {{ $paper->email }}</p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Phone Number:</strong> {{ $paper->phone }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Address :</strong> {{ $paper->address }} </p>
                        </li>
                        <li class="list-group-item">
                            <p><strong>Number of Authors:</strong> {{ $paper->number_of_authors }} </p>
                        </li>
                        <li class="list-group-item">
                            @foreach ($paper->controller_report as $report)
                                @if (!empty($report))
                                    <strong>Comment from Controller:</strong>
                                    <p>{{ $report->report_comment }}</p>
                                    <span class="badge bg-success"><i class="fa-solid p-1 text-bg fa-check"></i> Done</span>
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
                    <ul class="m-3 p-1 list-group list-group-flush">
                        <li class="list-group-item">
                            <h4><i class="fa-solid fa-circle-user"></i> Allocated Reviewer </h4>
                            @if ($paper->reviewers->count() > 0)
                                            <div>
                                                @foreach ($paper->reviewers as $reviewer)
                                                    <li class="list-group-item">
                                                        <p><strong>Name:</strong> {{ $reviewer->name}} </p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p><strong>Email:</strong> {{ $reviewer->email }}</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        @foreach ($paper->comment_paper as $reviewer)
                                                            <li class="list-group-item">
                                                                @if (!empty($reviewer->comment) || !empty($reviewer->comment_file))
                                                                    <strong>Comment from Reviewer:</strong>
                                                                    <p>{{ $reviewer->comment }}</p>
                                                                    <strong>Comment File:</strong>
                                                                    <a href="{{ asset($reviewer->comment_file) }}" download class="btn btn-sm bg text "
                                                                        target="_blank">
                                                                        <i class="bi bi-file-earmark-pdf"></i> View File
                                                                    </a>

                                                                    <br class="divider">
                                                                    <a class="btn bg text mt-3" href="{{ route('controller.report', $paper->id) }}">Generate
                                                                        report</a>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </li>
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