<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
<div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Input Group</div></div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <form action="/account/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" name="name" >
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="email">
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                      </div>
                      <div class="input-group mb-3">
                        <input type="file" class="form-control" name="image" id="inputGroupFile02">
                      <label class="input-group-text" for="inputGroupFile02" >Upload img</label>
                    </div>
                    <div class="input-group mb-3">
                       <select name="usr_role_id" class="form-select" required aria-label="Default select example">
                         <option value="null" selected>select role</option>
                         @foreach ($roles as $role)
                         <option value="{{ $role->rl_id }}">{{ $role->rl_name }}</option>
                         @endforeach
                       </select>
                     </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" name="password" required id="password">
                      <label class="input-group-text" id="password">password</label>
                    </div>
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" required name="password_confirmation" id="password_confirmation">
                      <label class="input-group-text" id="password_confirmation">confirm password</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" name="usr_activation" type="checkbox" value="1" id="checkIndeterminate">
                      <label class="form-check-label" for="checkIndeterminate">
                        activation
                      </label>
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
</x-app-layout>