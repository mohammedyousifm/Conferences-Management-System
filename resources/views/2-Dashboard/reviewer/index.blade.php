@extends('4-layout.backend');
@section('title' , 'Reviewer Dashboard')
@section('content')
        {{-- Heading --}}

       {{-- Dashboard Cards --}}
        <div class="row">

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 p-1" style="background: #f8f9fa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-black mb-1">New Papers</h6>
                            <h4 class="fw-bold text-dark">{{--{{ $Submitted_papers }}  --}} 10</h4>
                        </div>
                        <div class="icon-box d-flex justify-content-center bg align-items-center"
                            style="width: 50px; height: 50px; border-radius: 12px;">
                            <i class="fas fa-file-upload text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 p-1" style="background: #f8f9fa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-black mb-1">In process</h6>
                            <h4 class="fw-bold text-dark">{{--{{ $Under_reviwe }}  --}} 10</h4>
                        </div>
                        <div class="icon-box d-flex justify-content-center bg align-items-center"
                            style="width: 50px; height: 50px; border-radius: 12px;">
                            <i class="fas fa-exclamation-circle text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 p-1" style="background: #f8f9fa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-black mb-1">Accepted</h6>
                            <h4 class="fw-bold text-dark">{{--{{ $Accepted_papers }}  --}} 10</h4>
                        </div>
                        <div class="icon-box d-flex justify-content-center bg align-items-center"
                            style="width: 50px; height: 50px; border-radius: 12px;">
                            <i class="fas fa-check-circle text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 rounded-4 p-1" style="background: #f8f9fa;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-black mb-1"> total Papers</h6>
                            <h4 class="fw-bold text-dark">{{--{{ $Rejected_papers }}  --}} 10</h4>
                        </div>
                        <div class="icon-box d-flex justify-content-center bg align-items-center"
                            style="width: 50px; height: 50px; border-radius: 12px;">
                            <i class="fas fa-times-circle  text-white fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

     </div>
   </div>

<!-- Notification Container -->
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('4b4596e6d2b0e51c0c4f', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        if (data.controller_name && data.reviewer_name && data.paper_code) {
            showCustomToastrNotification(data.controller_name, data.reviewer_name, data.paper_code);
        }
    });

    function showCustomToastrNotification(controller_name, reviewer_name, paper_code) {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-center",
            timeOut: 100000,
            extendedTimeOut: 100000,
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
            toastClass: "custom-toast"
        };

        // Add custom styles for better UI
        const style = document.createElement('style');
        style.innerHTML = `
            .custom-toast {
                background-color: #f7941d !important;
                color: white !important;
                border-radius: 10px;
                padding: 15px;
                font-size: 14px;
                font-weight: bold;
                box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
                z-index: 999999 !important;
            }
            .custom-toast .toast-title {
                font-size: 16px;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .custom-toast .toast-message {
                font-size: 14px;
                line-height: 1.5;
            }
                .toast-info::before,
                .toast-success::before,
                .toast-warning::before,
                .toast-error::before {
                    display: none !important;
}

        `;
        document.head.appendChild(style);

        // Display Toastr notification
        toastr.info(
            `<div style="display: flex; align-items: center; gap: 12px;">
                <div>
                    <span>${controller_name} assigned a paper to you.</span><br>
                    <small style="color: #eee;">Paper Code: <strong>${paper_code}</strong></small>
                </div>
            </div>`,
            "📢New Paper Assignment", // Title
            { escapeHtml: false }
        );
    }
</script>


@endsection

