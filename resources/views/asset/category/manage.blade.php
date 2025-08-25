<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
     <x-slot:side_canvas>
        <a href="/manage/asset/category/add" class="btn btn-primary w-100">add category</a>
    </x-slot:side_canvas>
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    <x-table_data :data="$categories">
        <x-slot:title>Manage category asset</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>image</th>
          <th>name</th>
          <th>description</th>
          <th style="width: 60px">option</th>
        </x-slot:header>
        @forelse ($categories as $index => $category)
        <tr class="align-middle">
          <td>{{$categories->firstItem() + $index}}</td>
          <td>
            <img src="{{asset($category->ctgy_ast_img_path??'logo/uni_invt.png')}}" class="user-image rounded-circle shadow object-fit-cover" height="50" width="50" alt="User Image" />
          </td>
          <td>{{$category->ctgy_ast_name}}</td>
          <td>{{$category->ctgy_ast_description}}</td>
          <td>
          <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-menu-down"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/manage/asset/category/{{ $category->ctgy_ast_id }}/edit">Edit</a></li>
              <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{$categories->firstItem() + $index}}" >Delete</a></li>
            </ul>
          </div>
            <div class="modal fade" id="deleteConfirmation{{$categories->firstItem() + $index}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmation{{$categories->firstItem() + $index}}Label" aria-hidden="true">
              <form action="/asset/category/{{ $category->ctgy_ast_id }}/delete" method="post" class="modal-dialog modal-dialog-centered">
                @csrf
                @method('DELETE')
                <div class="modal-content rounded-3 shadow"> 
                  <div class="modal-body p-4 text-center"> 
                    <h5 class="mb-0">Delete this data?</h5> 
                    <p class="mb-0">are you sure to delete data {{$categories->firstItem() + $index}}.</p> 
                  </div> 
                  <div class="modal-footer flex-nowrap p-0"> 
                  <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                  <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Delete</strong></button> 
                  </div> 
                </div> 
              </form>
            </div> 
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>