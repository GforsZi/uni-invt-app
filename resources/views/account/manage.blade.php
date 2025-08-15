<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="$accounts">
        <x-slot:title>Manage Account</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th style="width: 150px">photo profile</th>
          <th>username</th>
          <th>role</th>
          <th>activation</th>
          <th style="width: 60px">activation</th>
        </x-slot:header>
        @forelse ($accounts as $index => $account)
        <tr class="align-middle">
          <td>{{ $accounts->firstItem() + $index }}</td>
          <td>
            <img src="{{asset('/photo_profile'. '/' . Auth::user()->usr_photo_path)}}" class="user-image rounded-circle shadow" width="50" alt="User Image" />
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
          <td><span class="badge text-bg-danger">55%</span></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada user.</td>
        </tr>
        @endforelse
    </x-table_data>
</x-app-layout>