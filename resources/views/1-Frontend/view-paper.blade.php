@extends('4-layout.frantend')
@section('title', 'My profile | papers')
@section('content')
    <section id="acouunt" class="pb-5">
        {{-- Navbar --}}
        <nav>
            <ul class="bg p-2">
                <li><a href="{{ route('conference.profile', Str::slug(Auth::user()->name)) }}">Profile</a></li>
                <li><a class="{{ request()->routeIs('conference.profile_papers', 'conference.paper_view') ? 'active' : '' }}"
                        href="{{ route('conference.profile_papers') }}">Papers</a></li>
                <li><a href="/Logout">Logout</a></li>
            </ul>
        </nav>

        {{-- here i want show about the paper and if the there --}}
        <div class="container">
            <div class="card">
                <div class="head p-1 bg text">
                    <h3 class="p-1 text">Paper info</h3>
                </div>
                <div class="card-body p-2">
                    <ul>
                        <li class="m-1">
                            <i class="fa-solid text-bg fa-arrow-right"></i> Paper Title:
                            <span>{{ $paper->paper_title }}</span>
                        </li>
                        <li class="m-1">
                            <i class="fa-solid text-bg fa-arrow-right"></i> Paper Code:
                            <span>{{ $paper->paper_code }}</span>
                        </li>
                        <li class="m-1"><i class="fa-solid -1 text-bg fa-arrow-right"></i> Conference Name:
                            <span>{{ $paper->conference->title }}</span>
                        </li>
                        <li class="m-1">
                            <i class="fa-solid text-bg fa-arrow-right"></i> Conference Date:
                            <span>{{ $paper->conference->start_date }}</span>
                        </li>
                        <li class="m-1">
                            <i class="fa-solid text-bg fa-arrow-right"></i> Conference Location:
                            <span>{{ $paper->conference->location }}</span>
                        </li>
                        <div class="divider">
                    </ul>
                </div>


                <div class="report">
                    <div class="head  p-1 bg text">
                        <h3 class="p-1 text">controller report</h3>
                    </div>

                    <div class="border  p-1 px-4 rounded bg-light">
                        @if (!empty($report->report_comment))
                            <h4 class="mt-4">✍️ Report Comment</h4>
                            <p class="mt-3"><strong>Report: {{  $report->report_comment }} </strong></p>
                        @elseif (empty($report->report_comment))
                            <p class="mt-3"><strong>You have not received the report yet.</strong></p>
                        @endif


                        @if (!empty($report->report_file) && file_exists(public_path($report->report_file)))
                            <a class="btn bg  mb-2 text" href="{{ asset($report->report_file) }}" download>Report
                                file</a>
                        @endif
                    </div>

                </div>
                <div>
                    <div class="head  p-1 bg text">
                        <h3 class="p-1 text">Update Paper</h3>
                    </div>
                    <div class="px-4">

                        @if (!empty($report->report_comment))
                            <form action="{{ route('paper.update_file', $paper_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mt-3">
                                    <label for="paper_file" class="form-label m-2 fw-bold">Upload File</label>
                                    <input type="file" name="paper_file" id="paper_file" class="form-control">
                                </div>
                                <div class="p-2">
                                    <button type="submit" class="btn mt-3 mb-2 bg text">Submit File</button>
                                </div>
                            </form>
                        @elseif (empty($report->report_comment))
                            <p class="mt-3"><strong>You have not received the report yet to Upload file.</strong></p>
                        @endif




                    </div>

                </div>
            </div>

    </section>

@endsection

<style>
    #acouunt .head h3 {
        font-size: 16px;
        font-weight: bold;
    }

    #acouunt .btn {
        font-size: 13px;
    }

    #acouunt {
        padding-top: 110px
    }

    #acouunt nav ul {
        display: flex;
        justify-content: center
    }

    #acouunt nav ul li a {
        opacity: .7;
        margin: 8px;
        color: white;
        font-weight: bold;
    }

    #acouunt nav ul li a:hover {
        opacity: 1;
    }

    #acouunt .active {
        opacity: 1;
    }
</style>