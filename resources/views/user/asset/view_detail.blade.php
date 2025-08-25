<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <div class="w-100">
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Detail asset</h3>
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
                  <td>Codename: </td>
                  <td>{{ $asset['ast_codename'] }}</td>
                </tr>
                <tr class="align-middle">
                    <td>Category: </td>
                    <td>{{ $asset['category']['ctgy_ast_name']??'not have' }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Origin: </td>
                  <td>{{ $asset['origin']['ast_orgn_name']??'not have' }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Available: </td>
                  <td>
                    @if ($asset['ast_available'])
                      yes
                    @else
                      no
                    @endif
                  </td>
                </tr>
                <tr class="align-middle">
                  <td>Created at: </td>
                  <td>{{ $asset['ast_created_at']->format('d F Y') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <hr>
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Decription asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0" id="desc_ast">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 30%">title</th>
                  <th>value</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($descriptions as $description)
                <tr class="align-middle">
                  <td>{{ $description->description->desc_ast_description }}</td>
                  <td>{{ $description->description->desc_ast_value }}</td>
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
    <hr>
        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">Log asset</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 30%">status</th>
                  <th>note</th>
                  <th>created at</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($logs as $log)
                <tr class="align-middle">
                  <td>{{ $log->ast_lg_status??'not have' }}</td>
                  <td>{{ $log->ast_lg_note }}</td>
                  <td>{{ $log->ast_lg_created_at->format('d F y') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3" class="w-100 text-center">404 | data not found</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
</x-app-layout>