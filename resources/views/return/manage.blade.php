<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$returns">
        <x-slot:title>Manage return</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>loanner</th>
          <th>description</th>
          <th>accepted</th>
          <th style="width: 60px">accept</th>
        </x-slot:header>
        @forelse ($returns as $index => $return)
        <tr class="align-middle">
          <td>{{$returns->firstItem() + $index}}</td>
          <td>{{$return->user->name}}</td>
          <td>{{$return->rtrn_description}}</td>
          <td>
            @if ($return->rtrn_accepted)
              accepted
            @else
              pending
            @endif
          </td>
          <td><span class="badge text-bg-danger">55%</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada user.</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>