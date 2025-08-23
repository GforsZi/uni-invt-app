<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        .edit {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-top: 20px;
        }

        #map {
            flex: 1;
            height: 350px;
            border-radius: 10px;

        }

        .edit form {
            flex: 1;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="edit">
        <!-- Map -->
        <div id="map"
            data-name="{{ $location[0]['lctn_name'] }}"
            data-lat="{{ $location[0]['lctn_latitude'] }}"
            data-lng="{{ $location[0]['lctn_longitude'] }}">
        >

        </div>

        <!-- Form -->
        <form action="/location/{{ $location[0]['lctn_id'] }}/edit" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" id="lat-input" name="lctn_latitude" value="{{ $location[0]['lctn_latitude'] }}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" id="lng-input" name="lctn_longitude" value="{{ $location[0]['lctn_longitude'] }}" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="lctn_name" value="{{ $location[0]['lctn_name'] }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="lctn_description" class="form-control">{{ $location[0]['lctn_description'] }}</textarea>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="delete_image" id="checkIndeterminate">
                <label class="form-check-label" for="checkIndeterminate">
                    delete img
                </label>
            </div>  

            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
        <!-- 
        <div id="map" style="height:400px;   width:50% ;"></div> -->

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
            // Event klik map → masukkan lat lng ke form
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                document.getElementById('lat-input').value = '';
                document.getElementById('lng-input').value = '';

                document.getElementById('lat-input').value = lat;
                document.getElementById('lng-input').value = lng;

                L.popup()
                    .setLatLng(e.latlng)
                    .setContent("Location:<br>" + lat + ", " + lng)
                    .openOn(map);
            });
        </script>

</x-app-layout>