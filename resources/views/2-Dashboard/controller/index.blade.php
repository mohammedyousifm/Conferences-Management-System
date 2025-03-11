 @extends('4-layout.backend');
 @section('title' , 'Controller Dashboard')
 @section('content')

      <section id="Controller_Dashboard">
        {{-- Dashboard Cards --}}
         <div class="mt-3" x-data="dashboard">
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
                                        <h4 class="fw-bold text-dark">{{ $In_Process_papers_count }}  </h4>
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
                                        <h6 class="text-muted text-black mb-1">Approved</h6>
                                        <h4 class="fw-bold text-dark">{{ $Approved_papers_count }}</h4>
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
                                        <h4 class="fw-bold text-dark">{{ $all_papers_count }}</h4>
                                    </div>
                                    <div class="icon-box d-flex justify-content-center bg align-items-center"
                                        style="width: 50px; height: 50px; border-radius: 12px;">
                                        <i class="fas fa-times-circle  text-white fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Paper Status Card--}}
                    <div class="py-4">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-header bg text-white">
                                <i class="bi bi-file-earmark-check me-2"></i>Paper Status
                              </div>
                              <div class="card-body">
                                <table class="table table-bordered mb-0">
                                  <tbody>

                                    <tr>
                                        <th scope="row" style="width: 40%;">Paper ID</th>
                                        <td>{{ $Paper_Comment_Done->paper->paper_code }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Allocated To</th>
                                        <td>{{ $Paper_Comment_Done->reviewer->name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="row">Status</th>
                                        <td>
                                          <!-- Use status-done or status-review based on your dynamic status -->
                                          <span class="status-done">{{ $Paper_Comment_Done->status }}</span>
                                        </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">Action</th>
                                          <td>
                                            <a href="{{ route('review_papers.controller' , $Paper_Comment_Done->paper->id) }}" class="btn bg btn-primary btn-sm">
                                              <i class="bi bi-eye"></i> View Details
                                            </a>
                                          </td>
                                        </tr>

                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                          <!-- New Paper Submission Card -->
                          <div class="col-md-6">
                            <div class="card">
                              <div class="card-header bg text-white">
                                <i class="bi bi-file-earmark-plus me-2"></i>New Paper Submission
                              </div>
                              <div class="card-body">
                                <table class="table table-bordered mb-0">
                                  <tbody>
                                    <tr>
                                      <th scope="row" style="width: 40%;">Paper Code</th>
                                      <td>{{ $New_Paper->paper_code }}</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Submitted By</th>
                                      <td>{{ $New_Paper->author_name }}</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Received On</th>
                                      <td>{{ $New_Paper->created_at }}</td>
                                    </tr>
                                    <tr>
                                      <th scope="row">Action</th>
                                      <td>
                                        <a href="{{ route('review_papers.controller' , $New_Paper->id) }}" class="btn bg btn-primary btn-sm">
                                          <i class="bi bi-eye"></i> View Details
                                        </a>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      {{-- Recent Activity --}}
                      <div class="card dashboard-card">
                        <div class="card-header bg text-white">
                          <h5><i class="bi bi-clock-history me-2"></i> Recent Activity</h5>
                        </div>
                        <div class="card-body">
                          <ul class="list-group">
                            @foreach ($Recent_Activity as $Activity)
                              <li class="list-group-item">
                                <i class="bi bi-file-earmark-check text-success me-2"></i>
                                <strong>{{ $Activity->Activity_User->name }}</strong> {{ $Activity->description }} <strong>{{ $Activity->paper_code }}</strong> <span class="text-muted float-end">{{ $Activity->created_at->diffForHumans() }}</span>
                              </li>
                            @endforeach
                          </ul>
                        </div>
                      </div>

                      <div class="card dashboard-card">
                        <div class="card-header bg text-white">
                          <h5><i class="bi bi-bar-chart-line me-2"></i> Paper Submission Trends</h5>
                        </div>
                        <div class="card-body">
                          <canvas id="paperChart"></canvas>
                        </div>
                      </div>

                      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                      <script>
                        var ctx = document.getElementById('paperChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                                datasets: [{
                                    label: 'Papers Submitted',
                                    data: [5, 10, 8, 15, 12, 20],
                                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                      </script>





         </div>
      </section>

<!-- Notification new Paper -->
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('4b4596e6d2b0e51c0c4f', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('new-paper');
    channel.bind('paper-new', function(data) {
        if (data.paper_code) {
            showCustomToastrNotification(data.paper_code);
        }
    });

    function showCustomToastrNotification(paper_code) {
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

        // Display Toastr notification
        toastr.info(
            `<div style="display: flex; align-items: center; gap: 12px;">
                <div>
                    <small style="color: #eee;">Paper Code: <strong>${paper_code}</strong></small>
                </div>
            </div>`,
            "📢New Paper", // Title
            { escapeHtml: false }
        );
    }
</script>

<!-- Notification: Reviewer Comments on Paper -->
<script>
// Ensure the script runs after the page is loaded
 document.addEventListener("DOMContentLoaded", function () {
    // Initialize Pusher
    const pusher = new Pusher('4b4596e6d2b0e51c0c4f', { cluster: 'ap2' });

    // Subscribe to the 'reviewer-comment' channel
    const channel = pusher.subscribe('reviewer-comment');

    // Listen for new comments (Fix: Avoid destructuring directly)
    channel.bind('comment-reviewer', function (data) {
        if (data && data.Reviewer_Name && data.Paper_Code) {
            showCustomToastrNotification(data.Reviewer_Name, data.Paper_Code);
        }
    });

    // Set global Toastr options
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-center",
        timeOut: 10000, // 10 seconds
        extendedTimeOut: 5000,
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        toastClass: "custom-toast"
    };

    // Function to show Toastr notification
    function showCustomToastrNotification(Reviewer_Name, Paper_Code) {
        toastr.info(
            `<strong>${Reviewer_Name}</strong> commented on Paper ID: <strong>${Paper_Code}</strong>`,
            "📢 New Paper Review",
            { escapeHtml: false }
        );
    }
});
</script>


</div>

@endsection
