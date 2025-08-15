<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$locations">
        <x-slot:title>Manage location</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>name</th>
          <th>description</th>
          <th>image</th>
          <th style="width: 60px">detail</th>
        </x-slot:header>
        @forelse ($locations as $index => $location)
        <tr class="align-middle">
          <td>{{$locations->firstItem() + $index}}</td>
          <td>{{$location->lctn_name}}</td>
          <td>{{$location->lctn_description}}</td>
          <td></td>
          <td><span class="badge text-bg-danger">55%</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada user.</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>