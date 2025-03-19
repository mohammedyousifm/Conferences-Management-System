@extends('4-layout.backend');
@section('title', 'coference view')
@section('content')
    <section id="coference-view">
        <div class="shadow-lg border-0">
            <div class="card-header bg bg-primary text-center p-2 text-white">
                <h4 class="mb-0 fs-13">conference Details</h4>
            </div>
            <div class="card-body">

                {{-- Paper & Author Details --}}
                <div class="d-flex  justify-between  border  rounded bg-light">

                    <ul class="m-2 p-1 w-50 list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="fs-12">📄 conference Details</h4>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>status:</strong> 10 </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Title:</strong> 10 </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>start date:</strong> 10 </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>end date:</strong> 10</p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>registration deadline:</strong> 10 </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>location:</strong> 10</p>
                        </li>
                    </ul>

                    <ul class="m-2 p-1 w-50 list-group list-group-flush">
                        <li class="list-group-item">
                            <h4 class="fs-12">📄 authors Details</h4>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Number of authors:</strong> 10 </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Number of authors In process:</strong> 10 </p>
                        </li>
                        <li class="list-group-item">
                            <p class="fs-12"><strong>Number of authors Approved:</strong> 10 </p>
                        </li>
                    </ul>

                </div>

            </div>
        </div>

    </section>
    </div>
@endsection