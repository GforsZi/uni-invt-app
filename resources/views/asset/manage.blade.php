<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/asset/add" class="btn btn-primary w-100">Add asset</a>
    </x-slot:side_canvas>
    <x-slot:header_layout>
      <form action='/manage/asset/' class="d-flex gap-2" method="get">
        <select name="category" class="form-select" aria-label="Default select example">
          <option value="all" selected>Filter by category</option>
          @foreach ($categories as $category)
          <option value="{{ $category->ctgy_ast_id }}">{{ $category->ctgy_ast_name }}</option>
          @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </x-slot:header_layout>
    @if(session()->has("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h5>Success: {{session("success")}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <x-table_data :data="$assets">
      <x-slot:query>{{$search??'&category=all'}}</x-slot:query>
        <x-slot:title>Manage asset</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>code</th>
          <th>origin</th>
          <th>category</th>
          <th style="width: 60px">detail</th>
        </x-slot:header>
        @if ($assets)
        @forelse ($assets as $index => $asset)
        <tr class="align-middle">
          <td>{{$assets->firstItem() + $index}}</td>
          <td>{{$asset->ast_codename}}</td>
          <td>{{$asset->origin->ast_orgn_name??'not have'}}</td>
          <td>{{$asset->category->ctgy_ast_name??'not have'}}</td>
          <td><a href="/manage/asset/{{ $asset->ast_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endforelse
        @else
        <tr>
          <td colspan="5" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endif
    </x-table_data>
</x-app-layout>