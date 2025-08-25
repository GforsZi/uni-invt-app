<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
    </x-slot:side_canvas>
    <x-slot:header_layout>

    </x-slot:header_layout>
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
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
                  <td>{{ $loan[0]['user']['name']??'not have' }}</td>
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
      <div class="d-flex gap-2 pt-2 mx-2">
      @if ($loan[0]['ln_accepted'] === 1)
      <form action="/loan/{{ $loan[0]['ln_id'] }}/rejected" method="post" class="w-100">
        @csrf
        @method('PUT')
        <input type="hidden" value="0" name="ln_accepted">
        <button type="submit" class="btn btn-warning mb-2 w-100">Reject this loan</button>
      </form>
      @elseif ($loan[0]['ln_accepted'] === 0)
<a class="btn btn-success w-100 mb-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addAccLn{{ $loan[0]['ln_id'] }}" >Approve this loan</a>
      <div class="modal fade" id="addAccLn{{ $loan[0]['ln_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAccLn{{ $loan[0]['ln_id'] }}Label" aria-hidden="true">
        <form action="/loan/{{ $loan[0]['ln_id'] }}/accepted" method="post" class="modal-dialog modal-dialog-centered">
          @csrf
          @method('PUT')
          <div class="modal-content rounded-3 shadow"> 
            <div class="modal-body p-4 text-center"> 
              <h5 class="mb-4">Approve loan {{ $loan[0]['ln_id'] }}</h5> 
              <div class="input-group mb-3 d-block">
                <label class="form-label">Loan limits</label>
                 <input type="date" required class="w-100 form-control @error('ln_loan_limit') is-invalid @enderror" name='ln_loan_limit'>
                 <input type='hidden' value='1' name='ln_accepted'>
               </div>
            </div> 
            <div class="modal-footer flex-nowrap p-0"> 
              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
              <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button> 
            </div> 
          </div> 
        </form>
      </div> 
      @else
      <a class="btn btn-success w-100 mb-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#addAccLn{{ $loan[0]['ln_id'] }}" >Approve this loan</a>
      <div class="modal fade" id="addAccLn{{ $loan[0]['ln_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAccLn{{ $loan[0]['ln_id'] }}Label" aria-hidden="true">
        <form action="/loan/{{ $loan[0]['ln_id'] }}/accepted" method="post" class="modal-dialog modal-dialog-centered">
          @csrf
          @method('PUT')
          <div class="modal-content rounded-3 shadow"> 
            <div class="modal-body p-4 text-center"> 
              <h5 class="mb-4">Approve loan {{ $loan[0]['ln_id'] }}</h5> 
              <div class="input-group mb-3 d-block">
                <label class="form-label">Loan limits</label>
                 <input type="date" required class="w-100 form-control @error('ln_loan_limit') is-invalid @enderror" name='ln_loan_limit'>
                 <input type='hidden' value='1' name='ln_accepted'>
               </div>
            </div> 
            <div class="modal-footer flex-nowrap p-0"> 
              <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
              <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Submit</strong></button> 
            </div> 
          </div> 
        </form>
      </div> 
      <form class="w-100" action="/loan/{{ $loan[0]['ln_id'] }}/rejected" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" value="0" name="ln_accepted">
        <button type="submit" class="btn btn-warning mb-2 w-100">Reject this loan</button>
      </form>
      @endif
      <a class="btn btn-danger w-100 mb-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{$loan[0]['ln_id']}}" >Delete this loan</a>
            <div class="modal fade" id="deleteConfirmation{{$loan[0]['ln_id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmation{{$loan[0]['ln_id']}}Label" aria-hidden="true">
              <form action="/loan/{{ $loan[0]['ln_id'] }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                @csrf
                @method('DELETE')
                <div class="modal-content rounded-3 shadow"> 
                <div class="modal-body p-4 text-center"> 
                  <h5 class="mb-0">Delete this data?</h5> 
                  <p class="mb-0">are you sure to delete data {{$loan[0]['ln_id']}}.</p> 
                </div> 
                <div class="modal-footer flex-nowrap p-0"> 
                  <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                  <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Delete</strong></button> 
                </div> 
              </div> 
              </form>
            </div> 
            </div>
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