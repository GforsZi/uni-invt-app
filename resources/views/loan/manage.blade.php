<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$loans">
        <x-slot:title>Manage loan</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>loanner</th>
          <th>status</th>
          <th>limit</th>
          <th>accepted</th>
          <th style="width: 60px">detail</th>
        </x-slot:header>
        @forelse ($loans as $index => $loan)
        <tr class="align-middle">
          <td>{{$loans->firstItem() + $index}}</td>
          <td>{{$loan->user->name??'not have'}}</td>
          <td>
            @if ($loan->ln_status)
              active
            @else
              not active
            @endif
          </td>
          <td>{{$loan->ln_limit}}</td>
          <td>
            @if ($loan->ln_accepted === 1)
              accepted
            @elseif ($loan->ln_accepted === 0)
              rejected
            @else
              pending
            @endif
          </td>
          <td><a href="/manage/loan/{{ $loan->ln_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>