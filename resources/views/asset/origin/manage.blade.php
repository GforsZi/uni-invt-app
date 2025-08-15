<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$origins">
        <x-slot:title>Manage origin asset</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>username</th>
          <th>description</th>
          <th style="width: 60px">option</th>
        </x-slot:header>
        @forelse ($origins as $index => $origin)
        <tr class="align-middle">
          <td>{{$origins->firstItem() + $index}}</td>
          <td>{{$origin->ast_orgn_name}}</td>
          <td>{{$origin->ast_orgn_description}}</td>
          <td><span class="badge text-bg-danger">55%</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada user.</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>