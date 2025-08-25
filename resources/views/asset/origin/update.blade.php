<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Add origin</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form action="/asset/origin/{{ $origin[0]['ast_orgn_id'] }}/edit" method="post">
        @csrf
        @method('PUT')
        <!--begin::Body-->
        <div class="card-body">
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" name="ast_orgn_name" class="form-control @error('ast_orgn_name') is-invalid @enderror" value="{{ $origin[0]['ast_orgn_name'] }}" id="inputEmail3">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPassword3"  class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea name="ast_orgn_description" class="form-control @error('ast_orgn_description') is-invalid @enderror">{{ $origin[0]['ast_orgn_description'] }}</textarea>
            </div>
          </div>
          </fieldset>
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
          <button type="submit" class="btn btn-warning">submit</button>
        </div>
        <!--end::Footer-->
      </form>
      <!--end::Form-->
    </div>
</x-app-layout>