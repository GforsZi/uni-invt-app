<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title">Edit asset</div></div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
      <form method="post" action="/asset/{{ $asset[0]['ast_id'] }}/edit">
        @csrf
        @method('PUT')
      <div class="input-group mb-3">
        <input type="text" class="form-control @error('ast_codename') is-invalid @enderror" name="ast_codename" value="{{ $asset[0]['ast_codename'] }}" required placeholder="codename" aria-label="Username" aria-describedby="basic-addon1">
        <button type="button" class="btn btn-secondary">generate</button>
        </div>
        <div class="input-group mb-3">
          <select name="ast_category_id" class="form-select @error('ast_category_id') is-invalid @enderror" required aria-label="Default select example">
            <option value="{{ $asset[0]['category']['ctgy_ast_id']??'' }}" selected>{{ $asset[0]['category']['ctgy_ast_name']??'not have' }}</option>
            @foreach ($categories as $category)
            <option value="{{ $category->ctgy_ast_id }}">{{ $category->ctgy_ast_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group mb-3">
          <select name="ast_origin_id" class="form-select @error('ast_origin_id') is-invalid @enderror" aria-label="Default select example">
            <option value="{{ $asset[0]['origin']['ast_orgn_id']??'' }}" selected>{{ $asset[0]['origin']['ast_orgn_name']??'not have' }}</option>
            @foreach ($origins as $origin)
            <option value="{{ $origin->ast_orgn_id }}">{{ $origin->ast_orgn_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group mb-3">
          <select name="rltn_ast_location_id" class="form-select @error('rltn_ast_location_id') is-invalid @enderror" aria-label="Default select example">
            <option value="{{ $relations[0]['location']['lctn_id']??''  }}" selected>{{ $relations[0]['location']['lctn_name']??'not have' }}</option>
            @foreach ($locations as $location)
            <option value="{{ $location->lctn_id }}">{{ $location->lctn_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group mb-3" id="descriptions-wrapper">
            @foreach ($descriptions as $index => $description)                
            <div class="input-group mb-2 description-row"  >
                <input type="text" value="{{ $description->description->desc_ast_description }}" name="descriptions[{{ $index }}][title]"  class="form-control @error('description[{{ $index }}][title]') is-invalid @enderror" placeholder="title">
                <input type="text" value="{{ $description->description->desc_ast_value }}" name="descriptions[{{ $index }}][value]"class="form-control @error('description[{{ $index }}][value]') is-invalid @enderror" placeholder="value">
                <button type="button" class="btn btn-danger remove-description">-</button>
            </div>
            @endforeach
            <div class="input-group mb-2"  id="oldDiv">
                <input type="text" name="descriptions[{{ $descriptions->count() }}][title]"  class="form-control @error('description[{{ $descriptions->count() }}][title]') is-invalid @enderror" placeholder="title">
                <input type="text" name="descriptions[{{ $descriptions->count() }}][value]"class="form-control @error('description[{{ $descriptions }}][value]') is-invalid @enderror" placeholder="value">
                <button type="button" class="btn btn-success  add-description">+</button>
            </div>
        </div>
      </div>
      <!--end::Body-->
      <!--begin::Footer-->
      <div class="card-footer">
        <button type="submit" class="btn btn-warning">Submit</button>
      </div>
      </form>
      <!--end::Footer-->
    </div>
<script>
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
                <input type="text" name="descriptions[${index}][title]"  class="form-control @error('description[${index}][title]') is-invalid @enderror" placeholder="title">
                <input type="text" name="descriptions[${index}][value]"class="form-control @error('description[${index}][value]') is-invalid @enderror" placeholder="value">
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