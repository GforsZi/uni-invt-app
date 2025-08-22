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
                    <td>role</td>
                    <td>{{ $account[0]['roles']['rl_name'] }}</td>
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
        <form method="post" action="">
            <input hidden value="{{ $account[0]['usr_id'] }}"/>
            <button type="submit" class="btn btn-primary">activate this account</button>
        </form>
        <form method="post" action="">
            <input hidden value="{{ $account[0]['usr_id'] }}"/>
            <button type="submit" class="btn btn-warning">banned this account</button>
        </form>
        <form method="post" action="">
            <input hidden value="{{ $account[0]['usr_id'] }}"/>
            <button type="submit" class="btn btn-danger">delete this account</button>
        </form>
        </div>
    </div>
</x-app-layout>