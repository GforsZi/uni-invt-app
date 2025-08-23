<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="" class="btn btn-warning w-100">Edit this data</a>
    </x-slot:side_canvas>
    <div class="w-100">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Detail retrurn</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20%">title</th>
                  <th>value</th>
                </tr>
              </thead>
              <tbody>
                <tr class="align-middle">
                  <td>loan_id: </td>
                  <td><a href='/manage/loan/{{ $return[0]['rtrn_loan_id'] }}/detail'>{{ $return[0]['rtrn_loan_id'] }}</a></td>
                </tr>
                <tr class="align-middle">
                    <td>user: </td>
                    <td>{{ $return[0]['user']['name'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>description: </td>
                  <td>{{ $return[0]['rtrn_descrription'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>note: </td>
                  <td>{{ $return[0]['rtrn_note'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Accepted: </td>
                  <td>
                    @if ($return[0]['rtrn_accepted'])
                      accepted
                    @else
                      not accepted
                    @endif
                  </td>
                </tr>
                <tr class="align-middle">
                  <td>Approved_at: </td>
                  <td>
                    @if ($return[0]['rtrn_approved_at'] === null)
                      not approved
                    @else
                      {{$return[0]['rtrn_approved_at']}}
                    @endif
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Return asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20%">category</th>
                  <th>codename</th>
                </tr>
              </thead>
              <tbody>
               @forelse ($assets as $asset)
               <tr class="align-middle">
                 <td>{{ $asset->asset->ast_category_id }}</td>
                 <td>{{ $asset->asset->ast_codename }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="2" class="w-100 text-center">404 | data not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
</x-app-layout>