@extends('4-layout.backend');
@section('title', 'Controller reports')
@section('content')

    <section id="reports-Controller">

        <div class="reportcard shadow-lg">
            <div class="card-header bg p-2 bg-primary text-white">
                <h3>Write Report for Paper: 1</h3>
            </div>
            <div class="card-body  p-1">
                {{-- Paper & Author Details --}}
                <div class="d-flex  justify-between  border p-3 rounded bg-light">

                </div>
                <div class="border p-1 px-4 rounded bg-light">
                    <h4 class="mt-4">✍️ Reviewer Points</h4>
                    <p class="mt-3"><strong>Reviewer: {{ $paper_reviewer->comment }} </strong></p>
                    @if (!empty($paper_reviewer->comment_file) && file_exists(public_path($paper_reviewer->comment_file)))
                        <a class="btn bg text" href="{{ asset($paper_reviewer->comment_file) }}" download>Points in file</a>
                    @endif
                </div>

                <hr>
                <div class="borderp-1 px-4 pt-2 rounded bg-light">
                    <h4 class="mt-4 m">✍️ Generate report </h4>
                    <form action="{{ route('store.report', $paper_reviewer->paper_id) }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="mt-3">
                            <textarea name="report" class="form-control" rows="5" required
                                placeholder="Write your report to authar"></textarea>
                            @error('report') <small class="text-danger"></small> @enderror
                        </div>
                        <div class="mt-3">
                            <label for="paper_file" class="form-label m-2 fw-bold">Upload File
                                <small>(Optional)</small></label>
                            <input type="file" name="paper_file" id="paper_file" class="form-control">
                        </div>
                        <button type="submit" class="btn mt-3 mb-2 bg btn-success">Submit Report</button>
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