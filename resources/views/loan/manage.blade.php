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
          <td>{{$loan->user->name}}</td>
          <td>
            @if ($loan->ln_status)
              active
            @else
              not active
            @endif
          </td>
          <td>{{$loan->ln_limit}}</td>
          <td>
            @if ($loan->ln_accepted === true)
              accepted
            @elseif ($loan->ln_accepted === false)
              rejected
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