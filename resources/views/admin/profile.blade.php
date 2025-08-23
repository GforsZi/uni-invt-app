<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:side_canvas>
        <button type="button" class="btn btn-primary" style="width: 100%;">Edit Profile</button>
    </x-slot:side_canvas>
    <div class="profil">
        <div class="card shadow-sm mb-3 w-100">
            <div class="row g-0 align-items-center">


                <div class="col-12 col-md-4 d-flex justify-content-center p-3">
                    <img src="{{ asset('/logo/uni_invt.png') }}"
                        class="img-fluid rounded-circle"
                        alt="Profile Image"
                        style="max-width: 180px;">
                </div>


                <div class="col-12 col-md-8">
                    <div class="card-body text-center text-md-start">
                        <h5 class="card-title mb-3"></h5>

                        <div class="d-flex justify-content-start mb-2">
                            <strong>Name:</strong>
                            <span>{{ $users['name'] }}</span>
                        </div>

                        <div class="d-flex justify-content-start mb-2">
                            <strong>Email:</strong>
                            <span>{{ $users['email'] }}</span>
                        </div>

                        <div class="d-flex justify-content-Start mb-2">
                            <strong>Role:</strong>
                            <span>{{ $users['roles']['rl_name'] }}</span>
                        </div>

                        <div class="d-flex justify-content-Start">
                            <strong>Description:</strong>
                            <span>{{ $users['roles']['rl_description'] }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


</x-app-layout>