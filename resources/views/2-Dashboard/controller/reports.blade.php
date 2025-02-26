@extends('4-layout.backend');
@section('title' , 'Controller reports')
@section('content')

 <section id="reports-Controller">
    <div>
        <h3 class="card-title fw-bold text-dark mb-3">Reports <i class="fa-solid fa-file"></i></h3>
    </div>


    <div class="container">
        <div class="reportcard shadow-lg">
            <div class="card-header bg p-2 bg-primary text-white">
                <h3>Write Report for Paper: 1</h3>
            </div>
            <div class="card-body  p-1">
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
                            <a href="{{ asset($paper->paper_file) }}"  download  class="btn btn-sm btn-outline-primary" target="_blank">
                                <i class="bi bi-file-earmark-pdf"></i> View Paper
                            </a>
                        </li>
                    </ul>
                 </div>
              <div class="border p-3 px-5 rounded bg-light">
                <h4 class="mt-4">✍️ Reviewer Points</h4>
                    <p><strong>Reviewer --------------- </strong></p>
                    <p><strong>Score: --------------- <strong></p>
              </div>

                <hr>
                <div  class="border p-3 rounded bg-light">
                    <h4 class="mt-4">Controller Report</h4>
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Write your report</label>
                            <textarea name="report" class="form-control" rows="5" required></textarea>
                            @error('report') <small class="text-danger"></small> @enderror
                        </div>
                        <button type="submit" class="btn bg btn-success">Submit Report</button>
                    </form>
                </div>


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

    #reports-Controller .card-header h3{
    font-size: 16px;
    }

    #reports-Controller strong{
    font-size: 16px;
    }

    #reports-Controller  h4{
     font-size: 15px;
    }
</style>
