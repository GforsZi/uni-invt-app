<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/asset/{{ $asset[0]['ast_id'] }}/edit" class="btn btn-warning w-100">Edit this data</a>
        {{ $relation }}
    </x-slot:side_canvas>
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
                  <td>{{ $asset[0]['ast_codename'] }}</td>
                </tr>
                <tr class="align-middle">
                    <td>Category: </td>
                    <td>{{ $asset[0]['category']['ctgy_ast_name'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>Origin: </td>
                  <td>{{ $asset[0]['origin']['ast_orgn_name'] }}</td>
                </tr>
                <tr class="align-middle">
                  <td>COdename: </td>
                  <td>{{ $asset[0]['ast_created_at']->format('d F Y') }}</td>
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
          <div class="card-body p-0">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th style="width: 20%">title</th>
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
</x-app-layout>