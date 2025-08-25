<x-app-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <x-slot:side_canvas>
    <a href="/asset/category" class="btn btn-primary w-100 mb-2">view assets</a>
  </x-slot:side_canvas>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
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
      </button>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
      <button class="info-box text-bg-success bg-gradient" data-bs-toggle="collapse" data-bs-target="#email" aria-expanded="false" aria-controls="collapseExample">
        <span class="info-box-icon"> <i class="bi bi-envelope-at-fill"></i> </span>
        <div class="info-box-content">
          <span class="info-box-text">Email</span>
          <div class="progress"><div class="progress-bar" style="width: 90%"></div></div>
          <div class="collapse" id="email">
            <div class="card text-break">
              {{$users->email}}
            </div>
          </div>
        </div>
      </button>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
      <button class="info-box text-bg-warning bg-gradient" data-bs-toggle="collapse" data-bs-target="#role" aria-expanded="false" aria-controls="collapseExample">
        <span class="info-box-icon"><i class="bi bi-award-fill"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Role</span>
          <div class="progress"><div class="progress-bar" style="width: 90%"></div></div>
          <div class="collapse" id="role">
            <div class="card text-break">
              {{$users?->roles['rl_name']??'not have'}}
            </div>
          </div>
        </div>
      </button>
    </div>

    <div class="col-md-3 col-sm-6 col-12">
      <button class="info-box text-bg-danger bg-gradient" data-bs-toggle="collapse" data-bs-target="#activation" aria-expanded="false" aria-controls="collapseExample">
        <span class="info-box-icon"> <i class="bi bi-check2"></i> </span>
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
      </button>
    </div>
  </div>

  <div class="row">
    <!-- Start col -->
    <div class="col-lg-7 connectedSortable">
      <div class="card card-primary card-outline mb-4">
        <div class="card-header"><div class="card-title">uni invt features</div></div>
        <div class="card-body">
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  View assets
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Perform asset data management actions in the database through the application.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Asset lending
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Create asset borrowing requests.
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Return of assets
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  Create asset return requests.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right col -->
    <div class="col-lg-5 connectedSortable">
      <div class="card text-white bg-primary bg-gradient border-primary mb-4">
        <div class="card-header border-0">
          <h3 class="card-title">Sales Value</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-primary btn-sm" data-lte-toggle="card-collapse">
              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div id="map" style="height: 220px"></div>
        </div>
        <div class="card-footer border-0">
          <div class="row">
            <div class="col-4 text-center">
              <div id="sparkline-1" class="text-dark"></div>
              <div class="text-white">Visitors</div>
            </div>
            <div class="col-4 text-center">
              <div id="sparkline-2" class="text-dark"></div>
              <div class="text-white">Online</div>
            </div>
            <div class="col-4 text-center">
              <div id="sparkline-3" class="text-dark"></div>
              <div class="text-white">Sales</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <script>
    var map = L.map('map').setView([-1.886558571940574, 117.23889649506248], 4);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: 'UNI-INVT'
    }).addTo(map);
  </script>
</x-app-layout>