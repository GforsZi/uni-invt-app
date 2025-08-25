<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
            <div class="row">
              <div class="col-md-3 col-sm-6 col-12">
                <button type="button" class="btn info-box text-bg-primary bg-gradient" data-bs-toggle="collapse" data-bs-target="#username" aria-expanded="false" aria-controls="collapseExample">
                  <span class="info-box-icon"> <i class="bi bi-person-fill"></i> </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Username</span>
                    <div class="progress"><div class="progress-bar" style="width: 90%"></div></div>
                    <div class="collapse" id="username">
                        <div class="card text-break">
                          {{$users->name}}
                        </div>
                      </div>
                  </div>
                  <!-- /.info-box-content -->
                </button>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-12">
                <button class="info-box text-bg-success bg-gradient" data-bs-toggle="collapse" data-bs-target="#email" aria-expanded="false" aria-controls="collapseExample">
                  <span class="info-box-icon"> <i class="bi bi-envelope-at-fill"></i></i> </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Email</span>
                    <div class="progress"><div class="progress-bar" style="width: 90%"></div></div>
                    <div class="collapse" id="email">
                        <div class="card  text-break">
                          {{$users->email}}
                        </div>
                      </div>
                  </div>
                  <!-- /.info-box-content -->
                </button>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-12">
                <button class="info-box text-bg-warning bg-gradient" data-bs-toggle="collapse" data-bs-target="#role" aria-expanded="false" aria-controls="collapseExample">
                  <span class="info-box-icon"><i class="bi bi-award-fill"></i></i></i> </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Role</span>
                    <div class="progress"><div class="progress-bar" style="width: 90%"></div></div>
                    <div class="collapse" id="role">
                        <div class="card text-break">
                          {{$users?->roles['rl_name']??'not have'}}
                        </div>
                      </div>
                  </div>
                  <!-- /.info-box-content -->
                </button>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-md-3 col-sm-6 col-12">
                <button class="info-box text-bg-danger bg-gradient" data-bs-toggle="collapse" data-bs-target="#activation" aria-expanded="false" aria-controls="collapseExample">
                  <span class="info-box-icon"> <i class="bi bi-check2"></i></i> </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Activation</span>
                    <div class="progress"><div class="progress-bar" style="width: 90%"></div></div>
                    <div class="collapse" id="activation">
                        <div class="card text-break">
                          @if ($users->usr_activation)
                            already activated
                          @else
                            not activated
                          @endif
                        </div>
                      </div>
                  </div>
                  <!-- /.info-box-content -->
                </button>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h5 class="card-title">Monthly Recap Report </h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-tool dropdown-toggle"
                          data-bs-toggle="dropdown"
                        >
                          <i class="bi bi-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" role="menu">
                          <a href="#" class="dropdown-item">Action</a>
                          <a href="#" class="dropdown-item">Another action</a>
                          <a href="#" class="dropdown-item"> Something else here </a>
                          <a class="dropdown-divider"></a>
                          <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                      </div>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-8">
                        <p class="text-center">
                          <strong>{{now()->format('F - Y')}}</strong>
                        </p>
                        <div id="sales-chart"></div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-4">
                        <p class="text-center"><strong>Loan this month</strong></p>
                        <div class="progress-group">
                          Total
                          <span class="float-end">{{$loanNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-primary" style="width: 100%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Accepted
                          <span class="float-end"><b>{{ $loanNewAcc }}</b>/{{$loanNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-danger" style="width: {{number_format($percentageLoanAcc, 2)}}%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">Rejected</span>
                          <span class="float-end"><b>{{ $loanNewRej }}</b>/{{$loanNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-success" style="width: {{number_format($percentageLoanRej, 2)}}%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Pending
                          <span class="float-end"><b>{{ $loanNewPen }}</b>/{{$loanNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-warning" style="width: {{number_format($percentageLoanPen, 2)}}%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                          </span>
                          <h5 class="fw-bold mb-0">{{$loanTotal}}</h5>
                          <span class="text-uppercase">TOTAL LOAN</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <h5 class="fw-bold mb-0">{{$loanTotalAcc}}</h5>
                          <span class="text-uppercase">TOTAL LOAN ACC</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                          </span>
                          <h5 class="fw-bold mb-0">{{$loanTotalRej}}</h5>
                          <span class="text-uppercase">TOTAL LOAN RJTD</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center">
                          <span class="text-danger">
                          </span>
                          <h5 class="fw-bold mb-0">{{$loanTotalPen}}</h5>
                          <span class="text-uppercase">TOTAL LOAN PNDG</span>
                        </div>
                      </div>
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h5 class="card-title">Monthly Recap Report </h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                      <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-tool dropdown-toggle"
                          data-bs-toggle="dropdown"
                        >
                          <i class="bi bi-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" role="menu">
                          <a href="#" class="dropdown-item">Action</a>
                          <a href="#" class="dropdown-item">Another action</a>
                          <a href="#" class="dropdown-item"> Something else here </a>
                          <a class="dropdown-divider"></a>
                          <a href="#" class="dropdown-item">Separated link</a>
                        </div>
                      </div>
                      <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                        <i class="bi bi-x-lg"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!--begin::Row-->
                    <div class="row">
                      <!-- /.col -->
                      <div class="col-md-4">
                        <p class="text-center"><strong>Return this month</strong></p>
                        <div class="progress-group">
                          Total
                          <span class="float-end">{{$loanNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-primary" style="width: 100%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Accepted
                          <span class="float-end"><b>{{ $returnNewAcc }}</b>/{{$returnNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-danger" style="width: {{number_format($percentageReturnAcc, 2)}}%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          <span class="progress-text">Rejected</span>
                          <span class="float-end"><b>{{ $returnNewRej }}</b>/{{$returnNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-success" style="width: {{number_format($percentageReturnRej, 2)}}%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                          Pending
                          <span class="float-end"><b>{{ $returnNewPen }}</b>/{{$returnNew}}</span>
                          <div class="progress progress-sm">
                            <div class="progress-bar text-bg-warning" style="width: {{number_format($percentageReturnPen, 2)}}%"></div>
                          </div>
                        </div>
                        <!-- /.progress-group -->
                      </div>
                      <div class="col-md-8">
                        <p class="text-center">
                          <strong>{{now()->format('F - Y')}}</strong>
                        </p>
                        <div id="sales-chart-2"></div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <!--begin::Row-->
                    <div class="row">
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                          </span>
                          <h5 class="fw-bold mb-0">{{$returnTotal}}</h5>
                          <span class="text-uppercase">TOTAL RETURN</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <h5 class="fw-bold mb-0">{{$returnTotalAcc}}</h5>
                          <span class="text-uppercase">TOTAL RETURN ACC</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center border-end">
                          <span class="text-success">
                          </span>
                          <h5 class="fw-bold mb-0">{{$returnTotalRej}}</h5>
                          <span class="text-uppercase">TOTAL RETURN RJTD</span>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3 col-6">
                        <div class="text-center">
                          <span class="text-danger">
                          </span>
                          <h5 class="fw-bold mb-0">{{$returnTotalPen}}</h5>
                          <span class="text-uppercase">TOTAL RETURN PNDG</span>
                        </div>
                      </div>
                    </div>
                    <!--end::Row-->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{asset('/js/dashboard.js')}}" type="text/javascript" charset="utf-8"></script>
</x-app-layout>