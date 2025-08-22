<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="card card-warning card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Edit role</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form>
        <!--begin::Body-->
        <div class="card-body">
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $role[0]['rl_name'] }}" id="inputEmail3">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control">{{ $role[0]['rl_description'] }}</textarea>
            </div>
          </div>
          </fieldset>
          <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck1">
                <label class="form-check-label" for="gridCheck1">
                  Admin
                </label>
              </div>
            </div>
          </div>
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