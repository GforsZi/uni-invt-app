<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$locations">
        <x-slot:title>Manage location</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>name</th>
          <th>description</th>
          <th style="width: 60px">detail</th>
        </x-slot:header>
        @forelse ($locations as $index => $location)
        <tr class="align-middle">
          <td>{{$locations->firstItem() + $index}}</td>
          <td>{{$location->lctn_name}}</td>
          <td>{{$location->lctn_description}}</td>
          <td><a href="/manage/location/{{ $location->lctn_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="4" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>