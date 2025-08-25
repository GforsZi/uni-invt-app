<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
    <!--begin::Header-->
    <div class="card-header"><div class="card-title">Add asset</div></div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body">
      <form method="post" action="/asset/add">
        @csrf
      <div class="input-group mb-3">
        <input type="text" class="form-control @error('codename') is-invalid @enderror" required placeholder="codename" name="ast_codename" aria-label="Username" aria-describedby="basic-addon1">
        <button type="button" class="btn btn-secondary">generate</button>
        </div>
        <div class="input-group mb-3">
          <select name="ast_category_id" class="form-select @error('ast_category_id') is-invalid @enderror" required aria-label="Default select example">
            <option value="null" selected>select category</option>
            @foreach ($categories as $category)
            <option value="{{ $category->ctgy_ast_id }}">{{ $category->ctgy_ast_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group mb-3">
          <select name="ast_origin_id" class="form-select @error('ast_origin_id') is-invalid @enderror" aria-label="Default select example">
            <option value="null" selected>select origin</option>
            @foreach ($origins as $origin)
            <option value="{{ $origin->ast_orgn_id }}">{{ $origin->ast_orgn_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group mb-3">
          <select name="rltn_ast_location_id" class="form-select @error('rltn_ast_location_id') is-invalid @enderror" aria-label="Default select example">
            <option value="null" selected>select location</option>
            @foreach ($locations as $location)
            <option value="{{ $location->lctn_id }}">{{ $location->lctn_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="input-group mb-3" id="descriptions-wrapper">
            <div class="input-group mb-2" id="oldDiv" >
                <input type="text" name="descriptions[0][title]"  class="form-control @error('description[0][title]') is-invalid @enderror" placeholder="title">
                <input type="text" name="descriptions[0][value]"class="form-control @error('description[0][value]') is-invalid @enderror" placeholder="value">
                <button type="button" class="btn btn-success  add-description">+</button>
            </div>
        </div>
      </div>
      <!--end::Body-->
      <!--begin::Footer-->
      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
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