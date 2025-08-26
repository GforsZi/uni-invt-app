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
        <div id="map">

        </div>

        <!-- Form -->
        <form action="/location/add" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" id="lat-input" class="form-control @error('lctn_latitude') is-invalid @enderror" readonly name="lctn_latitude">
            </div>

            <div class="mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" id="lng-input" class="form-control @error('lctn_longitude') is-invalid @enderror" readonly name="lctn_longitude">
            </div>

            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control @error('lctn_name') is-invalid @enderror" value="" name="lctn_name">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control @error('lctn_description') is-invalid @enderror" name="lctn_description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- 
        <div id="map" style="height:400px;   width:50% ;"></div> -->

        <script>
            var map = L.map('map').setView([-1.886558571940574, 117.23889649506248
], 4);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'UNI-INVT'
            }).addTo(map);


            // Event klik map → masukkan lat lng ke form
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                document.getElementById('lat-input').value = lat;
                document.getElementById('lng-input').value = lng;

                L.popup()
                    .setLatLng(e.latlng)
                    .setContent("Location:<br>" + lat + ", " + lng)
                    .openOn(map);
            });
        </script>

</x-app-layout>