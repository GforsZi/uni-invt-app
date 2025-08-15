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
          <td></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada user.</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>