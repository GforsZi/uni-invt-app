<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
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
          <td><a href="/asset/{{ $asset->ast_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a></td>
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