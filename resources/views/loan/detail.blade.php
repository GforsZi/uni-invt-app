<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="" class="btn btn-success w-100">Approve this loan</a>
    </x-slot:side_canvas>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <div class="w-100">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Detail loan</h3>
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
                  <td>User: </td>
                  <td>{{ $loan[0]['user']['name'] }}</td>
                </tr>
                <tr class="align-middle">
                    <td>Description: </td>
                    <td>{{ $loan[0]['ln_descrription'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Status: </td>
                  <td>
                    @if ( $loan[0]['ln_status'])
                      Active
                    @else
                      Not active
                    @endif
                  </td>
                </tr>
                <tr class="align-middle">
                  <td>Limit: </td>
                  <td>
                    @if ($loan[0]['ln_loan_limit'] === null)
                      not have
                    @else
                      {{$loan[0]['ln_loan_limit']}}
                    @endif
                  </td>
                </tr>
                <tr class="align-middle">
                  <td>Approved_at: </td>
                  <td>
                    @if ($loan[0]['ln_approved_at'] === null)
                      not approved
                    @else
                      {{$loan[0]['ln_approved_at']}}
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Loan asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20%">category</th>
                  <th>codename</th>
                </tr>
              </thead>
              <tbody>
               @forelse ($assets as $asset)
               <tr class="align-middle">
                 <td>{{ $asset->asset->ast_category_id }}</td>
                 <td>{{ $asset->asset->ast_codename }}</td>
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
    <div style="height: 400px; flex:1;" id="map" data-location="{{ $location[0]['location']??'' }}"></div>
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