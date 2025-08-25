<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/profile/edit" class="btn btn-primary" style="width: 100%;">Edit Profile</a>
    </x-slot:side_canvas>
        @if(session()->has("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <h5>Success: {{session("success")}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    <div class="profil">
        <div class="card shadow-sm mb-3 w-100">
            <div class="row g-0 align-items-center">


                <div class="col-12 col-md-4 d-flex justify-content-center p-3">
                    <img src="{{ asset($users['usr_photo_path']??'/logo/uni_invt.png') }}" class="rounded-circle shadow object-fit-cover" alt="Profile Image" width="200" height="200">
                </div>


                <div class="col-12 col-md-8">
                    <div class="card-body text-center text-md-start">
                        <h5 class="card-title mb-3"></h5>

                        <div class="d-flex justify-content-start gap-1 mb-2">
                            <strong>Name:</strong>
                            <span>{{ $users['name'] }}</span>
                        </div>

                        <div class="d-flex justify-content-start gap-1 mb-2">
                            <strong>Email:</strong>
                            <span>{{ $users['email'] }}</span>
                        </div>

                        <div class="d-flex justify-content-Start gap-1 mb-2">
                            <strong>Role:</strong>
                            <span>{{ $users['roles']['rl_name']??'not have' }}</span>
                        </div>

                        <div class="d-flex gap-1 justify-content-Start">
                            <strong>Description:</strong>
                            <span>{{ $users['roles']['rl_description']??'not have' }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <x-table_data :data="$loans">
      <x-slot:query>{{$search??'&category=all'}}</x-slot:query>
        <x-slot:title>Manage asset</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>status</th>
          <th>description</th>
          <th style="width: 60px">detail</th>
        </x-slot:header>
        @forelse ($loans as $index => $loan)
        <tr class="align-middle">
          <td>{{$loans->firstItem() + $index}}</td>
          <td>
            @if ($loan->ln_accepted === 1)
                accepted
            @elseif ($loan->ln_accepted === 0)
                rejected
            @else
                pending
            @endif
          </td>
          <td>{{$loan->ln_description}}</td>
          <td><a href="/loan/{{ $loan->ln_id }}/detail" class="btn btn-warning m-0"><i class="bi bi-list-ul"></i></a></td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="w-100 text-center">404 | data not found</td>
        </tr>
        @endforelse
    </x-table_data>


</x-app-layout>