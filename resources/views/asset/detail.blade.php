<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/asset/{{ $asset[0]['ast_id'] }}/edit" class="btn btn-warning w-100">Edit this data</a>
    </x-slot:side_canvas>
    <x-slot:header_layout>
      <button class="btn btn-primary mx-2" data-bs-toggle="collapse" data-bs-target="#desc_ast" aria-expanded="false" aria-controls="desc_ast">description</button>
      <a class="btn btn-danger" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{$asset[0]['ast_id']}}" >Delete this asset</a>
            <div class="modal fade" id="deleteConfirmation{{$asset[0]['ast_id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmation{{$asset[0]['ast_id']}}Label" aria-hidden="true">
              <form action="/asset/{{ $asset[0]['ast_id'] }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                @csrf
                @method('DELETE')
                <div class="modal-content rounded-3 shadow"> 
                <div class="modal-body p-4 text-center"> 
                  <h5 class="mb-0">Delete this data?</h5> 
                  <p class="mb-0">are you sure to delete data {{$asset[0]['ast_id']}}.</p> 
                </div> 
                <div class="modal-footer flex-nowrap p-0"> 
                  <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                  <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Delete</strong></button> 
                </div> 
              </div> 
              </form>
            </div> 
    </x-slot:header_layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    <div class="w-100">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Detail asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20%">title</th>
                  <th>value</th>
                </tr>
              </thead>
              <tbody>
                <tr class="align-middle">
                  <td>Codename: </td>
                  <td>{{ $asset[0]['ast_codename'] }}</td>
                </tr>
                <tr class="align-middle">
                    <td>Category: </td>
                    <td>{{ $asset[0]['category']['ctgy_ast_name']??'not have' }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Origin: </td>
                  <td>{{ $asset[0]['origin']['ast_orgn_name']??'not have' }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Available: </td>
                  <td>
                    @if ($asset[0]['ast_available'])
                      yes
                    @else
                      no
                    @endif
                  </td>
                </tr>
                <tr class="align-middle">
                  <td>Created at: </td>
                  <td>{{ $asset[0]['ast_created_at']->format('d F Y') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Decription asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0 collapse" id="desc_ast">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 30%">title</th>
                  <th>value</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($descriptions as $description)
                <tr class="align-middle">
                  <td>{{ $description->description->desc_ast_description }}</td>
                  <td>{{ $description->description->desc_ast_value }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="2" class="w-100 text-center">404 | data not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
    <hr>
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Log asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 30%">status</th>
                  <th>note</th>
                  <th>created at</th>
                  <th>Option</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($logs as $log)
                <tr class="align-middle">
                  <td>{{ $log->ast_lg_status??'not have' }}</td>
                  <td>{{ $log->ast_lg_note }}</td>
                  <td>{{ $log->ast_lg_created_at->format('d F y') }}</td>
                  <td>
                    <a class="btn btn-danger" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deletelog{{ $log->ast_lg_id }}" >delete log</a>
                    <div class="modal fade" id="deletelog{{ $log->ast_lg_id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deletelog{{ $log->ast_lg_id }}Label" aria-hidden="true">
                      <form action="/asset/log/{{ $log->ast_lg_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content rounded-3 shadow"> 
                          <div class="modal-body p-4 text-center"> 
                            <h5 class="mb-0">Delete this data?</h5> 
                            <p class="mb-0">are you sure to delete data {{ $log->ast_lg_id }}.</p> 
                            <input type="hidden" name="detail_asset_id" value="{{ $asset[0]['ast_id'] }}">
                          </div> 
                          <div class="modal-footer flex-nowrap p-0"> 
                            <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                            <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button> 
                          </div> 
                        </div> 
                      </form>
                    </div> 
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="w-100 text-center">404 | data not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
    <hr>
    <div style="height: 400px; flex:1;" id="map" data-location="{{ $relation[0]['location']??'' }}"></div>
    <script>
        const mapDiv = document.getElementById('map');
        const locations = mapDiv.dataset.location;
        const locationsjson = [JSON.parse(locations)];
        
        var map = L.map('map').setView([locationsjson[0].lctn_latitude, locationsjson[0].lctn_longitude], 17);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'UNI-INVT'
        }).addTo(map);


        locationsjson.forEach((location) => {
            let alamatMarker = L.marker([location.lctn_latitude, location.lctn_longitude]).addTo(map);
            alamatMarker.bindPopup("<b>Location</b><br>" + location.lctn_name + "<br>").openPopup();
        });

    </script>
</x-app-layout>