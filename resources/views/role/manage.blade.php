<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$roles">
        <x-slot:title>Manage Role</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>Name</th>
          <th>description</th>
          <th style="width: 50px">option</th>
        </x-slot:header>
        @forelse ($roles as $index => $role)
          
        <tr class="align-middle">
          <td>{{$roles->firstItem() + $index}}</td>
          <td>{{$role->rl_name}}</td>
          <td>{{$role->rl_description}}</td>
          <td>
          <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-menu-down"></i>
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/manage/role/{{ $role->rl_id }}/edit">Edit</a></li>
              <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{$roles->firstItem() + $index}}" >Delete</a></li>
            </ul>
          </div>
            <div class="modal fade" id="deleteConfirmation{{$roles->firstItem() + $index}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmation{{$roles->firstItem() + $index}}Label" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-3 shadow"> 
                <div class="modal-body p-4 text-center"> 
                  <h5 class="mb-0">Delete this data?</h5> 
                  <p class="mb-0">are you sure to delete data {{$roles->firstItem() + $index}}.</p> 
                </div> 
                <div class="modal-footer flex-nowrap p-0"> 
                  <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                  <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Delete</strong></button> 
                </div> 
              </div> 
              </div>
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