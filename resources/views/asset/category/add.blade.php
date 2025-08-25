<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="card card-primary card-outline mb-4">
      <!--begin::Header-->
    <div class="card-header"><div class="card-title">Add category</div></div>
    <form class="needs-validation" action="/asset/category/add" method="post" enctype="multipart/form-data">
      @csrf
        <hr>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="validationCustom01" class="form-label">name</label>
            <input type="text" class="form-control @error('ctgy_ast_name') is-invalid @enderror" name='ctgy_ast_name' id="validationCustom01" placeholder="name category" required="">
        </div>
        <div class="col-md-6">
          <label for="validationCustom02" class="form-label">description</label>
          <input type="text" class="form-control @error('ctgy_ast_description') is-invalid @enderror" id="validationCustom02" name="ctgy_ast_description" placeholder="description category">
        </div>
        <div class="input-group mb-3" id="edit_img">
            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02" >Upload img</label>
        </div>
    </div>
  </div>
    <div class="card-footer mt-3">
      <button class="btn btn-info" type="submit">Submit form</button>
    </div>
</form>
</x-app-layout>