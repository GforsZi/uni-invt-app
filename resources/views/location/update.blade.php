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
        <form>
            <div class="mb-3">
                <label class="form-label">Latitude</label>
                <input type="text" id="lat-input" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Longitude</label>
                <input type="text" id="lng-input" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" value="">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- 
        <div id="map" style="height:400px;   width:50% ;"></div> -->

        <script>
            var map = L.map('map').setView([-6.997513615690157, 107.58015602767394], 17);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'UNI-INVT'
            }).addTo(map);

            var geding1 = L.marker([-6.997982256727868, 107.58021102858952]).addTo(map);
            geding1.bindPopup("<b>Gedung 1</b><br>Mahaputra");

            var gedung2 = L.marker([-6.997633504762923, 107.5803479678652]).addTo(map);
            gedung2.bindPopup("<b>Gedung 2</b><br>Mahaputra");

            var masjid = L.marker([-6.997417775385263, 107.58057439478381]).addTo(map);
            masjid.bindPopup("<b>Masjid</b><br>Mahaputra");

            var balema = L.marker([-6.997092983094567, 107.58057439478381]).addTo(map);
            balema.bindPopup("<b>Bale</b><br>Mahaputra");

            var hangar = L.marker([-6.997513615690157, 107.58091271534725]).addTo(map);
            hangar.bindPopup("<b>Hangar</b><br>Mahaputra");

            var gerbang = L.marker([-6.9978650299730925, 107.5794693706668]).addTo(map);
            gerbang.bindPopup("<b>SMK</b><br>Mahaputra");

            // Event klik map → masukkan lat lng ke form
            map.on('click', function(e) {
                var lat = e.latlng.lat;
                var lng = e.latlng.lng;

                document.getElementById('lat-input').value = lat;
                document.getElementById('lng-input').value = lng;

                L.popup()
                    .setLatLng(e.latlng)
                    .setContent("Koordinat:<br>" + lat + ", " + lng)
                    .openOn(map);
            });
        </script>

</x-app-layout>