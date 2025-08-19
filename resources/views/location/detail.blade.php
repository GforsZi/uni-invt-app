<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/location/{{ $location[0]['lctn_id'] }}/edit" class="btn btn-warning w-100">Edit this data</a>
    </x-slot:side_canvas>

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
            <div class="card">
                <h5 class="card-header">Alamat</h5>
                <div class="card-body">
                    <p class="card-text">{{ $location[0]['lctn_name'] }}</p>
                    <p class="card-text">Latitude: <span id="lat-text">{{ $location[0]['lctn_latitude'] }}</span></p>
                    <p class="card-text">Longitude: <span id="lng-text">{{ $location[0]['lctn_longitude'] }}</span></p>
                </div>
            </div>
        </div>
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
        alamatMarker.bindPopup("<b>Alamat</b><br>" + name + "<br>").openPopup();


        map.on('click', function(e) {
            var newLat = e.latlng.lat.toFixed(6);
            var newLng = e.latlng.lng.toFixed(6);

            L.popup()
                .setLatLng(e.latlng)
                .setContent("Koordinat Klik:<br>" + newLat + ", " + newLng)
                .openOn(map);
        });
    </script>
</x-app-layout>