<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
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
              <!-- Start col -->
              <div class="col-lg-7 connectedSortable">
                                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Accordion</div></div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <div class="card-body">
                    <div class="accordion" id="accordionExample">
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseOne"
                            aria-expanded="false"
                            aria-controls="collapseOne"
                          >
                            Accordion Item #1
                          </button>
                        </h2>
                        <div
                          id="collapseOne"
                          class="accordion-collapse collapse show"
                          data-bs-parent="#accordionExample"
                        >
                          <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by
                            default, until the collapse plugin adds the appropriate classes that we
                            use to style each element. These classes control the overall appearance,
                            as well as the showing and hiding via CSS transitions. You can modify
                            any of this with custom CSS or overriding our default variables. It's
                            also worth noting that just about any HTML can go within the
                            <code>.accordion-body</code>, though the transition does limit overflow.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo"
                            aria-expanded="false"
                            aria-controls="collapseTwo"
                          >
                            Accordion Item #2
                          </button>
                        </h2>
                        <div
                          id="collapseTwo"
                          class="accordion-collapse collapse"
                          data-bs-parent="#accordionExample"
                        >
                          <div class="accordion-body">
                            <strong>This is the second item's accordion body.</strong> It is hidden
                            by default, until the collapse plugin adds the appropriate classes that
                            we use to style each element. These classes control the overall
                            appearance, as well as the showing and hiding via CSS transitions. You
                            can modify any of this with custom CSS or overriding our default
                            variables. It's also worth noting that just about any HTML can go within
                            the <code>.accordion-body</code>, though the transition does limit
                            overflow.
                          </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header">
                          <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapseThree"
                            aria-expanded="false"
                            aria-controls="collapseThree"
                          >
                            Accordion Item #3
                          </button>
                        </h2>
                        <div
                          id="collapseThree"
                          class="accordion-collapse collapse"
                          data-bs-parent="#accordionExample"
                        >
                          <div class="accordion-body">
                            <strong>This is the third item's accordion body.</strong> It is hidden
                            by default, until the collapse plugin adds the appropriate classes that
                            we use to style each element. These classes control the overall
                            appearance, as well as the showing and hiding via CSS transitions. You
                            can modify any of this with custom CSS or overriding our default
                            variables. It's also worth noting that just about any HTML can go within
                            the <code>.accordion-body</code>, though the transition does limit
                            overflow.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Body-->
                </div>
              </div>
              <div class="col-lg-5 connectedSortable">
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Striped Full Width Table</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Task</th>
                          <th>Progress</th>
                          <th style="width: 40px">Label</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="align-middle">
                          <td>1.</td>
                          <td>Update software</td>
                          <td>
                            <div class="progress progress-xs">
                              <div
                                class="progress-bar progress-bar-danger"
                                style="width: 55%"
                              ></div>
                            </div>
                          </td>
                          <td><span class="badge text-bg-danger">55%</span></td>
                        </tr>
                        <tr class="align-middle">
                          <td>2.</td>
                          <td>Clean database</td>
                          <td>
                            <div class="progress progress-xs">
                              <div class="progress-bar text-bg-warning" style="width: 70%"></div>
                            </div>
                          </td>
                          <td><span class="badge text-bg-warning">70%</span></td>
                        </tr>
                        <tr class="align-middle">
                          <td>3.</td>
                          <td>Cron job running</td>
                          <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar text-bg-primary" style="width: 30%"></div>
                            </div>
                          </td>
                          <td><span class="badge text-bg-primary">30%</span></td>
                        </tr>
                        <tr class="align-middle">
                          <td>4.</td>
                          <td>Fix and squish bugs</td>
                          <td>
                            <div class="progress progress-xs progress-striped active">
                              <div class="progress-bar text-bg-success" style="width: 90%"></div>
                            </div>
                          </td>
                          <td><span class="badge text-bg-success">90%</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <div class="card text-white bg-primary bg-gradient border-primary mb-4">
                  <div class="card-header border-0">
                    <h3 class="card-title">Sales Value</h3>
                    <div class="card-tools">
                      <button
                        type="button"
                        class="btn btn-primary btn-sm"
                        data-lte-toggle="card-collapse"
                      >
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body"><div id="map" style="height: 220px"></div></div>
                  <div class="card-footer border-0">
                    <!--begin::Row-->
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
                    <!--end::Row-->
                  </div>
                </div>
              </div>
            </div>
   <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

     <script>
      var map = L.map('map').setView([-1.886558571940574, 117.23889649506248
], 4);

      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: 'UNI-INVT'
}).addTo(map);

     </script>
</x-app-layout>
