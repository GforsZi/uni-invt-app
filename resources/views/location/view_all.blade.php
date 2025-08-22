<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <div style="height: 400px;" id="map" data-location="{{ $locations }}"></div>
    <script>
        const mapDiv = document.getElementById('map');
        const locations = mapDiv.dataset.location;
        const locationsjson = JSON.parse(locations);

        

        var map = L.map('map').setView([43.7164228958962, 9.89378217842869], 1);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: 'UNI-INVT'
        }).addTo(map);


        locationsjson.forEach((location) => {
            let alamatMarker = L.marker([location.lctn_latitude, location.lctn_longitude]).addTo(map);
            alamatMarker.bindPopup("<b>Address</b><br>" + location.lctn_name + "<br>").openPopup();
        });

    </script>
</x-app-layout>