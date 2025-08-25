<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
<div class="card card-warning card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Input Group</div></div>
                  <!--end::Header-->
                  <!--begin::Body-->
                  <form action="/admin/profile/edit" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" value="{{ $user['name'] }}" class="form-control @error('name') is-invalid @enderror" name="name" >
                      </div>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user['email'] }}">
                        <span class="input-group-text" id="basic-addon2">@example.com</span>
                      </div>
                      <div class="input-group mb-3">
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="inputGroupFile02">
                      <label class="input-group-text" for="inputGroupFile02" >Upload img</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" name="delete_image" id="checkIndeterminate">
                      <label class="form-check-label" for="checkIndeterminate">
                        delete img
                      </label>
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
</x-app-layout>