<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$categories">
        <x-slot:title>Manage category asset</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>name</th>
          <th>description</th>
          <th style="width: 60px">option</th>
        </x-slot:header>
        @forelse ($categories as $index => $category)
        <tr class="align-middle">
          <td>{{$categories->firstItem() + $index}}</td>
          <td>{{$category->ctgy_ast_name}}</td>
          <td>{{$category->ctgy_ast_description}}</td>
          <td><span class="badge text-bg-danger">55%</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada user.</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>