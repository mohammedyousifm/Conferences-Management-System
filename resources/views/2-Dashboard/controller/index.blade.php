 @extends('4-layout.backend');
 @section('title' , 'Controller Dashboard')
 @section('content')

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
                          <td>#1212312</td>
                        </tr>
                        <tr>
                          <th scope="row">Allocated To</th>
                          <td>Mohammed</td>
                        </tr>
                        <tr>
                          <th scope="row">Status</th>
                          <td>
                            <!-- Use status-done or status-review based on your dynamic status -->
                            <span class="status-done">Under review</span>
                          </td>
                        </tr>
                        <tr>
                            <th scope="row">Action</th>
                            <td>
                              <a href="#" class="btn bg btn-primary btn-sm">
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
                <li class="list-group-item">
                  <i class="bi bi-file-earmark-check text-success me-2"></i>
                  <strong>Mohammed</strong> approved Paper ID <strong>#1212312</strong> <span class="text-muted float-end">10 mins ago</span>
                </li>
                <li class="list-group-item">
                  <i class="bi bi-file-earmark-text text-warning me-2"></i>
                  <strong>Ahmed</strong> submitted Paper ID <strong>#1242324</strong> <span class="text-muted float-end">30 mins ago</span>
                </li>
                <li class="list-group-item">
                  <i class="bi bi-file-earmark-x text-danger me-2"></i>
                  <strong>Sarah</strong> rejected Paper ID <strong>#1234567</strong> <span class="text-muted float-end">1 hour ago</span>
                </li>
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
    </div>
 @endsection







 <style>
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .card-header {
      background-color: #f8f9fa;
      font-weight: bold;
      border-bottom: 1px solid #dee2e6;
    }
    .status-done {
      color: #fff;
      background-color: #28a745;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.9rem;
    }
    .status-review {
      color: #fff;
      background-color: #ffc107;
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.9rem;
    }
  </style>
