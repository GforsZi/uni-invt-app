<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div>
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Detail account</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>title</th>
                    <th>value</th>
                </tr>
                </thead>
                <tbody>
                <tr class="align-middle">
                    <td>username</td>
                    <td>{{ $account[0]['name'] }}</td>
                </tr>
                <tr class="align-middle">
                    <td>email</td>
                    <td>{{ $account[0]['email'] }}</td>
                </tr>
                <tr class="align-middle">
                    <td>role</td>
                    <td>{{ $account[0]['roles']['rl_name']??'not have' }}</td>
                </tr>
                <tr class="align-middle">
                    <td>activation</td>
                    <td>
                        @if ($account[0]['usr_activation'])
                            already activated
                        @else
                            not activated
                        @endif
                    </td>
                </tr>
                <tr class="align-middle">
                    <td>created at</td>
                    <td>{{ $account[0]['usr_created_at']->format('d F Y') }}</td>
                </tr>
                </tbody>
            </table>
            </div>
        <!-- /.card-body -->
        </div>
        <div class="d-flex gap-2">
        <form method="post" action="/account/{{$account[0]['usr_id']}}/activated">
            @csrf
            @method('PUT')
            <input hidden name='usr_activation' value="1"/>
            <button type="submit" class="btn btn-primary">activate this account</button>
        </form>
        <form method="post" action="/account/{{$account[0]['usr_id']}}/banned">
            @csrf
            @method('PUT')
            <input hidden name='usr_activation' value="0"/>
            <button type="submit" class="btn btn-warning">banned this account</button>
        </form>
        <a class="btn btn-danger"style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteConfirmation{{$account[0]['usr_id']}}" >delete this account</a>

        </div>
    </div>
    <div class="modal fade" id="deleteConfirmation{{$account[0]['usr_id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteConfirmation{{$account[0]['usr_id']}}Label" aria-hidden="true">
        <form method="post" class="modal-dialog modal-dialog-centered" action="/account/{{$account[0]['usr_id']}}/delete">
            @csrf
            @method('DELETE')
                <div class="modal-content rounded-3 shadow"> 
                <div class="modal-body p-4 text-center"> 
                    <h5 class="mb-0">Delete this data?</h5> 
                    <p class="mb-0">are you sure to delete user {{$account[0]['name']}}.</p> 
                </div> 
                <div class="modal-footer flex-nowrap p-0"> 
                    <button type="button" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0 border-end" data-bs-dismiss="modal">Cancle</button> 
                        <input hidden value="{{ $account[0]['usr_id'] }}"/>
                        <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 py-3 m-0 rounded-0" ><strong>Delete</strong></button> 
                    </div> 
                </div> 
            </form>
    </div> 
</x-app-layout>