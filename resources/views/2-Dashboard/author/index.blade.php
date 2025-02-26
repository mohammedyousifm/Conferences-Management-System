@extends('4-layout.backend');
@section('title' , 'Author Dashboard')
@section('content')
<div id="Auther-dashboard" class="mt-5" x-data="dashboard">
    {{-- Welcome --}}
    <div class="card shadow-sm p-4 mb-4 bg-white rounded">
            <h2 class="text-black">Welcome, Author!</h2>
            <p class="lead text-muted">Manage your submissions, track your papers, and stay updated with the latest notifications.</p>
            <button class="btn bg text mt-3">Explore Dashboard</button>
    </div>

    {{-- Dashboard Cards --}}
    <div>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 p-1" style="background: #f8f9fa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-black mb-1">Pending Reviews</h6>
                            <h4 class="fw-bold text-dark">{{--{{ $Under_reviwe }}  --}} 10</h4>
                        </div>
                        <div class="icon-box d-flex justify-content-center bg align-items-center"
                            style="width: 50px; height: 50px; border-radius: 12px;">
                            <i class="fas fa-exclamation-circle text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 p-1" style="background: #f8f9fa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-black mb-1">Accepted Papers</h6>
                            <h4 class="fw-bold text-dark">{{--{{ $Accepted_papers }}  --}} 10</h4>
                        </div>
                        <div class="icon-box d-flex justify-content-center bg align-items-center"
                            style="width: 50px; height: 50px; border-radius: 12px;">
                            <i class="fas fa-check-circle text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 p-1" style="background: #f8f9fa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-black mb-1">Total Papers Submitted</h6>
                            <h4 class="fw-bold text-dark">{{--{{ $Rejected_papers }}  --}} 10</h4>
                        </div>
                        <div class="icon-box d-flex justify-content-center bg align-items-center"
                            style="width: 50px; height: 50px; border-radius: 12px;">
                            <i class="fas fa-file  text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

 </div>
@endsection

