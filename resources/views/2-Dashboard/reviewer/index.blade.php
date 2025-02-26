@extends('4-layout.backend');
@section('title' , 'Reviewer Dashboard')
@section('content')
        {{-- Heading --}}
        <div class="d-flex mt-3">
            <div class="border-0 shadow-lg p-3 rounded-4" style="background-color: #343a40;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold text-light mb-3">Amin Role</h5>

                    <div class="d-flex justify-content-center align-items-center" style="position: relative;">
                        <div class="position-absolute top-0 start-50 translate-middle-x" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ff8a00, #e52e71); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0px 5px 15px rgba(255, 138, 0, 0.4);">
                            <i class="fas fa-user-tie fa-2x text-white"></i>
                        </div>
                    </div>

                    <div class="mt-5">
                        <span class="badge text-dark fw-semibold fs-5 px-4 py-2" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px;">
                            {{ Auth::check() ? Auth::user()->user_role : 'Guest' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

       {{-- Dashboard Cards --}}
       <div class="container mt-5" x-data="dashboard">
         <div class="row">
           <div class="col-md-3">
             <div class="card text-white bg-primary mb-3" @click="showTable('new')">
               <div class="card-body">
                 <h5 class="card-title"><i class="fas fa-file-upload me-2"></i>New Allocated</h5>
                 <p class="card-text">{{ $Allocated_papers }}</p>
               </div>
             </div>
           </div>
           <div class="col-md-3">
             <div class="card text-white bg-success mb-3" @click="showTable('complete')">
               <div class="card-body">
                 <h5 class="card-title"><i class="fas fa-check-circle me-2"></i>Complete Papers</h5>
                 <p class="card-text">10</p>
               </div>
             </div>
           </div>
           <div class="col-md-3">
             <div class="card text-white bg-warning mb-3" @click="showTable('incomplete')">
               <div class="card-body">
                 <h5 class="card-title"><i class="fas fa-exclamation-circle me-2"></i>Incomplete Papers</h5>
                 <p class="card-text">{{ $Under_reviwe }}</p>
               </div>
             </div>
           </div>
           <div class="col-md-3">
             <div class="card text-white bg-danger mb-3" @click="showTable('rejected')">
               <div class="card-body">
                 <h5 class="card-title"><i class="fas fa-times-circle me-2"></i>Rejected Papers</h5>
                 <p class="card-text">{{ $Rejected_papers }}</p>
               </div>
             </div>
           </div>
         </div>



       </div>
     </div>
   </div>
@endsection
