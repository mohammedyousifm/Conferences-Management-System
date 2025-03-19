@extends('4-layout.backend');
@section('title', 'Controller reports')
@section('content')
    {{-- && file_exists(public_path($paper_reviewer->comment_file) --}}
    <section id="reports-Controller">

        <div class="reportcard shadow-lg">
            <div class="card-header text-center  bg p-2 bg-primary text-white">
                <h3 class="fs-12">Write Report for Paper: 1</h3>
            </div>
            <div class="card-body">
                <div class="border p-1 px-3 rounded bg-light">
                    <h4 class="mt-4 fs-12">✍️ Reviewer Comment </h4>
                    <p class="mt-3 fs-12">Reviewer: {{ $paper_reviewer->comment }}</p>
                    @if (!empty($paper_reviewer->comment_file))
                        <a class="btn fs-12 bg text" href="{{ asset($paper_reviewer->comment_file) }}" download>Comment in
                            file</a>
                    @endif
                </div>

                <hr>
                <div class="borderp-1 px-3 p-1 rounded bg-light">
                    <h4 class="mt-4 fs-13">✍️ Generate report </h4>
                    <form action="{{ route('controller.store_report', $paper_reviewer->paper_id) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mt-3">
                            <textarea name="report" class="form-control fs-12" rows="5" required
                                placeholder="Write your report to authar"></textarea>
                            @error('report') <small class="text-danger"></small> @enderror
                        </div>
                        <div class="mt-3">
                            <label for="paper_file" class="form-label m-2 fs-12 fw-bold">Upload File
                                <small>(Optional)</small></label>
                            <input type="file" name="paper_file" id="paper_file" class="form-control fs-12">
                        </div>
                        <button type="submit" class="btn mt-3 mb-2 bg fs-12 btn-success">Submit Report</button>
                    </form>
                </div>


            </div>
        </div>

    </section>
    </div>

@endsection
<style>
    #reports-Controller .reportcard,
    .card-header {
        border-radius: 20px;
    }

    #reports-Controller .card-header h3 {
        font-size: 16px;
    }

    #reports-Controller strong {
        font-size: 16px;
    }

    #reports-Controller h4 {
        font-size: 15px;
    }
</style>