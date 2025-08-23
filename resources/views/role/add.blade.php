<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Add role</div></div>
      <!--end::Header-->
      <!--begin::Form-->
      <form action="/role/add" method="post">
        @csrf
        <!--begin::Body-->
        <div class="card-body">
          <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" name="rl_name" class="form-control" id="inputEmail3">
            </div>
          </div>
          <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
              <textarea name="rl_description" class="form-control"></textarea>
            </div>
          </div>
          </fieldset>
          <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
              <div class="form-check">
                <input class="form-check-input" name="rl_admin" value="1" type="checkbox" id="gridCheck1">
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
          <button type="submit" class="btn btn-primary">submit</button>
        </div>
        <!--end::Footer-->
      </form>
      <!--end::Form-->
    </div>
</x-app-layout>