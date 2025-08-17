<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <form class="needs-validation was-validated" novalidate="">
        <hr>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label for="validationCustom01" class="form-label">name</label>
            <input type="text" class="form-control" id="validationCustom01" value="{{ $category[0]['ctgy_ast_name'] }}" placeholder="name category" required="">
          <div class="valid-feedback">Looks good!</div>
        </div>
        <div class="col-md-6">
          <label for="validationCustom02" class="form-label">description</label>
          <input type="text" class="form-control" id="validationCustom02" value="{{ $category[0]['ctgy_ast_description'] }}" placeholder="description category">
          <div class="valid-feedback">Looks good!</div>
        </div>
        <div class="input-group mb-3 collapse" id="edit_img">
            <input type="file" class="form-control" required="" id="inputGroupFile02">
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
      <input class="form-check-input" type="checkbox" value="" id="checkIndeterminate">
      <label class="form-check-label" for="checkIndeterminate">
        delete img
      </label>
    </div>         
    </div>
    <div class="card-footer mt-3">
      <button class="btn btn-info" type="submit">Submit form</button>
    </div>
</form>
<script>
//   (() => {
//     'use strict';
//     const forms = document.querySelectorAll('.needs-validation');
//     // Loop over them and prevent submission
//     Array.from(forms).forEach((form) => {
//       form.addEventListener(
//         'submit',
//         (event) => {
//           if (!form.checkValidity()) {
//             event.preventDefault();
//             event.stopPropagation();
//           }
//           form.classList.add('was-validated');
//         },
//         false,
//       );
//     });
//   })();
</script>  
</x-app-layout>