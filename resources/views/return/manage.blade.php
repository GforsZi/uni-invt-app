<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$returns">
        <x-slot:title>Manage return</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>loanner</th>
          <th>description</th>
          <th>accepted</th>
          <th style="width: 60px">detail</th>
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
          <td><a href="/manage/return/{{ $return->rtrn_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>