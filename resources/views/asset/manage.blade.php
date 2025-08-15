<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$assets">
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
          <td>{{$asset->origin->ast_orgn_name}}</td>
          <td>{{$asset->category->ctgy_ast_name}}</td>
          <td><span class="badge text-bg-danger">55%</span></td>
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