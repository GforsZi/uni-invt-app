<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="" class="btn btn-warning w-100">Edit this data</a>
    </x-slot:side_canvas>
     <x-slot:side_canvas>

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
                  <td></td>
                </tr>
                <tr class="align-middle">
                    <td>Category: </td>
                    <td></td>
                </tr>
                <tr class="align-middle">
                  <td>Origin: </td>
                  <td></td>
                </tr>
                <tr class="align-middle">
                  <td>COdename: </td>
                  <td></td>
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
               
                <tr class="align-middle">
                  <td></td>
                  <td></td>
                </tr>
                
                <tr>
                  <td colspan="2" class="w-100 text-center">404 | data not found</td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
    {{ $loan }}
    <hr>
    {{ $assets }}
    <hr>
    {{ $location }}
</x-app-layout>