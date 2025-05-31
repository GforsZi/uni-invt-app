<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
            <div class="row">
              <div class="col-md-3 col-sm-6 col-12">
                <button type="button" class="btn info-box text-bg-primary bg-gradient" data-bs-toggle="collapse" data-bs-target="#username" aria-expanded="false" aria-controls="collapseExample">
                  <span class="info-box-icon"> <i class="bi bi-person-fill"></i> </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Username</span>
                    <div class="progress"><div class="progress-bar" style="width: 90%"></div></div>
                    <div class="collapse" id="username">
                        <div class="card text-black">
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
                        <div class="card text-black text-break">
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
                        <div class="card text-black">
                          {{$users?->roles[0]['rl_name']??'belum tersedia'}}
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
                        <div class="card text-black">
                          {{$users->usr_activation}}
                        </div>
                      </div>
                  </div>
                  <!-- /.info-box-content -->
                </button>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
</x-app-layout>
