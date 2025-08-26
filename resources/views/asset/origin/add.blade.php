<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Add origin</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form action="/asset/origin/add" method="post">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" name="ast_orgn_name" class="form-control @error('ast_orgn_name') is-invalid @enderror" id="inputEmail3">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label @error('ast_orgn_description') is-invalid @enderror">Description</label>
            <div class="col-sm-10">
              <textarea name="ast_orgn_description"  class="form-control"></textarea>
            </div>
          </div>
          </fieldset>
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">submit</button>
        </div>
        <!--end::Footer-->
      </form>
      <!--end::Form-->
    </div>
</x-app-layout>