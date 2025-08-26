<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/loan/{{$loan[0]['ln_id']}}/edit" class="btn btn-warning w-100">Edit loan</a>
    </x-slot:side_canvas>
    <x-slot:header_layout>
      @if ($loan[0]['ln_accepted'] === 1 ?? $loan[0]['ln_status'] === 1)
          
      <a class="btn btn-danger w-100 mb-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#return{{$loan[0]['ln_id']}}" >Return this loan</a>
      <div class="modal fade" id="return{{$loan[0]['ln_id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="return{{$loan[0]['ln_id']}}Label" aria-hidden="true">
          <form action="/return/{{ $loan[0]['ln_id'] }}/add" method="post" class="modal-dialog modal-dialog-centered">
            @csrf
            <div class="modal-content rounded-3 shadow"> 
                <div class="modal-body p-4 text-center"> 
                    <h5 class="mb-0">Return this loan?</h5> 
                    <div id="descriptions-wrapper">
                        @foreach ($assets as $index => $asset)                
                        <div class="input-group mb-2 description-row"  >
                            <select name="asset_id[{{ $index }}]" class="form-select  @error('asset_id[{{ $index }}]') is-invalid @enderror" aria-label="Default select example">
                                <option value="{{ $asset->asset->ast_id??null }}" selected>{{ $asset->asset->ast_codename??'not have' }}</option>
                                <button type="button" class="btn btn-danger remove-description">-</button>
                            </select>
                            <button type="button" class="btn btn-danger remove-description">-</button>
                        </div>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control @error('ast_lg_note') is-invalid @enderror" name="rtrn_description"></textarea>
                        
                    </div>
                </div> 
                <div class="modal-footer flex-nowrap p-0"> 
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button> 
                </div> 
            </div> 
        </form>
    </div> 
    @endif  
</x-slot:header_layout>

            @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

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
                  <td>{{ $loan[0]['user']['name']??'not have' }}</td>
                </tr>
                <tr class="align-middle">
                    <td>Description: </td>
                    <td>{{ $loan[0]['ln_description'] }}</td>
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
                  <td>Accepted: </td>
                  <td>
                    @if ($loan[0]['ln_accepted'] === 1)
                      accepted
                    @elseif ($loan[0]['ln_accepted'] === 0)
                    not accepted
                    @else
                    pendding
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

            const wrapper = document.getElementById('descriptions-wrapper');
            wrapper.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-description')) {
            e.preventDefault();
            e.target.closest('.description-row').remove();
        }
    });

    </script>
</x-app-layout>