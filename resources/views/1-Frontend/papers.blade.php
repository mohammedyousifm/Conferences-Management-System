@extends('4-layout.frantend')
@section('title', 'My profile | papers')
@section('content')
    <section id="acouunt" class="pb-5">



        <div class="info">
            <div class="head bg mb-2">
                <h3 class="text p-1">structured Info</h3>
            </div>
            <p><i class="fa-solid  text-bg fa-arrow-right"></i> Thank you for your submission. All submitted papers
                will go through the review process. If there are any
                updates regarding your paper, you will receive an email notification<span class="text-danger">*</span>.<br>

                <i class="fa-solid -1 text-bg fa-arrow-right"></i> If your paper is approved, you will be notified via
                email. Here, you can track the status of your
                submission
                and upload any updated versions if required. <br>

                <i class="fa-solid -1 text-bg fa-arrow-right"></i> If you have any questions, please <a
                    href="contact.html">contact us</a>.
            </p>
        </div>



        <div class="paper-table">
            <div class="table-responsive h-100">
                <table class="table table-bordered">
                    <thead>
                        <tr style="background-color: var(--bg-color);">
                            <th style=" font-size: 12px">@</th>
                            <th style=" font-size: 12px">Title</th>
                            <th style=" font-size: 12px">Conference</th>
                            <th style=" font-size: 12px">Paper code</th>
                            <th style=" font-size: 12px">Version</th>
                            <th style=" font-size: 12px">Status</th>
                            <th style=" font-size: 12px">Submission date</th>
                            <th style=" font-size: 12px">Paper</th>
                            <th style=" font-size: 12px">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($papers->isNotEmpty())
                            @foreach ($papers as $Paper)
                                <tr>
                                    <td class="badge bg-dark bg-opacity-10 mt-3  px-3 py-2 rounded-pill text-dark"
                                        style=" font-size: 12pxl"> {{ $loop->iteration }}</td>
                                    <td class="pt-3" style=" font-size: 12px">{{ $Paper->paper_title }}</td>
                                    <td class="pt-3" style=" font-size: 12px">{{ Str::limit($Paper->paper_title, 15, '....') }}</td>
                                    <td class="pt-3" style=" font-size: 12px">{{ $Paper->paper_code }}</td>
                                    <td class="pt-3" style=" font-size: 12px">v- {{ $Paper->version }}</td>
                                    <td class="pt-3" style=" font-size: 12px">
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">{{ $Paper->status }}</span>
                                    </td class="pt-3" style=" font-size: 12px">
                                    <td class="pt-3" style=" font-size: 12px">{{ $Paper->created_at->format('Y M D') }}</td>
                                    <td class="pt-3" style=" font-size: 11px">
                                        <a href="{{ $Paper->paper_file }}" class="btn bg text mb-2  btn-sm" download
                                            target="_blank">View Paper</a>
                                    </td class="pt-3" style=" font-size: 12px">

                                    <td class="pt-3" style=" font-size: 11px">
                                        <a href="{{ route('conference.paper_view', ['encrypted_id' => encrypt($Paper->id)]) }}"
                                            class="btn bg text mb-2  btn-sm">View More</a>
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
        </div>
    </section>

@endsection

<style>
    .info,
    .paper-table {
        padding: 0 20px;
    }

    .info .head h3 {
        font-size: 16px;
    }

    .head {
        border-radius: 5px;
    }

    #acouunt {
        padding-top: 150px;
    }

    #acouunt .active {
        opacity: 1;
    }

    form td {
        font-size: 1px !important;
    }
</style>