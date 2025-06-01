<x-guest-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-navbar></x-navbar>
        <main class="app-main">
      <!--begin::App Content Header-->
      <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Row-->
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">{{$title}}</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
              </ol>
            </div>
          </div>
          <!--end::Row-->
        </div>
        <!--end::Container-->
      </div>
      <!--end::App Content Header-->
      <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
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
          </div>
      </div>
      <!--end::App Content-->
    </main>
    <x-footer></x-footer>
</x-guest-layout>