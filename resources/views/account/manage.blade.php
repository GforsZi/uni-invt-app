<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/account/add" class="btn btn-primary w-100">Add account</a>
    </x-slot:side_canvas>
    <x-table_data :data="$accounts">
        <x-slot:title>Manage Account</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th style="width: 150px">photo profile</th>
          <th>username</th>
          <th>role</th>
          <th>activation</th>
          <th style="width: 60px">detail</th>
        </x-slot:header>
        @forelse ($accounts as $index => $account)
        <tr class="align-middle">
          <td>{{ $accounts->firstItem() + $index }}</td>
          <td>
            <img src="{{asset($account->usr_photo_path??'logo/uni_invt.png')}}" class="user-image rounded-circle shadow" width="50" alt="User Image" />
          </td>
          <td>{{$account->name}}</td>
          <td>{{$account->roles->rl_name??'not have'}}</td>
          <td>
            @if ($account->usr_activation)
              already activated
            @else
              not activated
            @endif
          </td>
          <td><a href="/manage/account/{{ $account->usr_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>