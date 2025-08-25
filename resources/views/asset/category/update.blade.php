<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
        <div class="card card-warning card-outline mb-4">
      <!--begin::Header-->
      <div class="card-header"><div class="card-title">Edit role</div></div>
    <form enctype="multipart/form-data" action="/asset/category/{{ $category[0]['ctgy_ast_id'] }}/edit" method="post">
      @csrf
      @method('PUT')
        <hr>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="validationCustom01" class="form-label">name</label>
            <input type="text" name="ctgy_ast_name" class="form-control @error('ctgy_ast_name') is-invalid @enderror" id="validationCustom01" value="{{ $category[0]['ctgy_ast_name'] }}" placeholder="name category" required="">
        </div>
        <div class="col-md-6">
          <label for="validationCustom02" class="form-label">description</label>
          <input type="text" name="ctgy_ast_description" class="form-control @error('ctgy_ast_description') is-invalid @enderror" id="validationCustom02" value="{{ $category[0]['ctgy_ast_description'] }}" placeholder="description category">
        </div>
        <div class="input-group mb-3 collapse" id="edit_img">
            <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02" >Upload img</label>
        </div>
    </div>
    <div class="col-sm-10">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" role="switch" data-bs-toggle="collapse" data-bs-target="#edit_img" aria-expanded="false" aria-controls="edit_img" id="switchCheckChecked">
          <label class="form-check-label" for="switchCheckChecked">edit img</label>
        </div>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="1" name="delete_image" id="checkIndeterminate">
      <label class="form-check-label" for="checkIndeterminate">
        delete img
      </label>
    </div>         
    </div>
    <div class="card-footer mt-3">
      <button class="btn btn-warning" type="submit">Submit form</button>
    </div>
  </form> 
</div>
</x-app-layout>