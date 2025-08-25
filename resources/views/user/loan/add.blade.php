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
        <div id="map" data-location="{{ $locations }}">

        </div>

        <!-- Form -->
        <form action="/loan/add" method="post">
            @csrf
        <div class="input-group mb-3">
          <select name="ln_lctn_location_id" class="form-select @error('ln_lctn_location_id') is-invalid @enderror" aria-label="Default select example">
            <option value="null" selected>select location</option>
            @foreach ($locations as $location)
            <option value="{{ $location->lctn_id }}">{{ $location->lctn_name }}</option>
            @endforeach
          </select>
        </div>


        <div class="input-group mb-3" id="descriptions-wrapper">
            <div class="input-group mb-2" id="oldDiv" >
          <select name="asset_id[0]" class="form-select @error('asset_id[0]') is-invalid @enderror" aria-label="Default select example">
            <option value="null" selected>select asset</option>
            @foreach ($assets as $asset)
            @if ($asset->ast_available === 1)
            <option value="{{ $asset->ast_id }}">{{ $asset->ast_codename??'not have' }}</option>
            @else
            <option value="">{{ $asset->ast_codename??'not have' }} - not available</option>
            @endif
            @endforeach
          </select>
                <button type="button" class="btn btn-success  add-description">+</button>
            </div>
        </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control @error('ln_description') is-invalid @enderror" name="ln_description"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- 
        <div id="map" style="height:400px;   width:50% ;"></div> -->

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
            alamatMarker.bindPopup("<b>Location</b><br>" + location.lctn_name + "<br>").openPopup();
        });

document.addEventListener('DOMContentLoaded', function() {
    let index = 1;
    const wrapper = document.getElementById('descriptions-wrapper');
    const oldDiv = document.getElementById('oldDiv');

    wrapper.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-description')) {
            e.preventDefault();
            let newRow = document.createElement('div');
            newRow.classList.add('input-group', 'description-row');
            newRow.innerHTML = `
            <div class="input-group mb-2"  >
          <select name="asset_id[${ index }]" name="rltn_ast_location_id" class="form-select @error('asset_id[${ index }]') is-invalid @enderror" aria-label="Default select example">
            <option value="null" selected>select location</option>
            @foreach ($assets as $asset)
            @if ($asset->ast_available === 1)
            <option value="{{ $asset->ast_id }}">{{ $asset->ast_codename??'not have' }}</option>
            @else
            <option value="">{{ $asset->ast_codename??'not have' }} - not available</option>
            @endif
            @endforeach
          </select>
          <button type="button" class="btn btn-danger remove-description">-</button>
                </div>
            `;
            wrapper.insertBefore(newRow, oldDiv);
            index++;
        }

        if (e.target.classList.contains('remove-description')) {
            e.preventDefault();
            e.target.closest('.description-row').remove();
        }
    });
});

    </script>

</x-app-layout>