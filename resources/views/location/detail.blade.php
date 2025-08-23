<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/location/{{ $location[0]['lctn_id'] }}/edit" class="btn btn-warning w-100 mb-2">Edit this location</a>
        <a class="btn btn-danger w-100 mb-2" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{$location[0]['lctn_id']}}" >delete this location</a>
    </x-slot:side_canvas>
    <x-slot:header_layout>
      <button class="btn btn-primary mx-2" data-bs-toggle="collapse" data-bs-target="#lctn_img" aria-expanded="false" aria-controls="lctn_img">view image</button>
    </x-slot:header_layout>

    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        .detail {
            display: flex;
            gap: 15px;
        }

        #map {
            flex: 1;
            height: 400px;
            border-radius: 10px;
            margin-top: 15px;
        }

        .card-container {
            width: 50%;
            max-height: 400px;
            padding-right: 5px;
        }

        .card {
            margin-bottom: 15px;
        }
    </style>

    <div class="detail">
        <!-- Map -->
        <div id="map"
            data-name="{{ $location[0]['lctn_name'] }}"
            data-lat="{{ $location[0]['lctn_latitude'] }}"
            data-lng="{{ $location[0]['lctn_longitude'] }}">
        </div>

        <div class="card-container">
            <div class="container p-4 collapse" id="lctn_img">
                <img class="w-100" src="{{ asset($location[0]['lctn_img_path']??'/logo/uni_invt.png') }}">
            </div>
            <div class="card">
                <h5 class="card-header">Alamat</h5>
                <div class="card-body">
                    <p class="card-text">Nama: {{ $location[0]['lctn_name'] }}</p>
                    <p class="card-text">Description: {{ $location[0]['lctn_description'] }}</p>
                    <p class="card-text">Latitude: <span id="lat-text">{{ $location[0]['lctn_latitude'] }}</span></p>
                    <p class="card-text">Longitude: <span id="lng-text">{{ $location[0]['lctn_longitude'] }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmation{{$location[0]['lctn_id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmation{{$location[0]['lctn_id']}}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered" action="/location/{{$location[0]['lctn_id']}}/delete">
            @csrf
            @method('DELETE')
                <div class="modal-content rounded-3 shadow"> 
                <div class="modal-body p-4 text-center"> 
                    <h5 class="mb-0">Delete this data?</h5> 
                    <p class="mb-0">are you sure to delete location {{$location[0]['lctn_name']}}.</p> 
                </div> 
                <div class="modal-footer flex-nowrap p-0"> 
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                        <input hidden value="{{ $location[0]['lctn_id'] }}"/>
                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Delete</strong></button> 
                    </div> 
                </div> 
            </form>
    </div> 

    <script>
        const mapDiv = document.getElementById('map');
        const name = mapDiv.dataset.name;
        const lat = parseFloat(mapDiv.dataset.lat);
        const lng = parseFloat(mapDiv.dataset.lng);

        var map = L.map('map').setView([lat, lng], 17);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'UNI-INVT'
        }).addTo(map);


        var alamatMarker = L.marker([lat, lng]).addTo(map);
        alamatMarker.bindPopup("<b>Location</b><br>" + name + "<br>").openPopup();


    </script>
</x-app-layout>