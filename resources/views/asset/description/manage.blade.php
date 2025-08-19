<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-table_data :data="">
        <x-slot:title>Manage description asset</x-slot:title>
        <x-slot:header>
          <th style="width: 10px">#</th>
          <th>desc</th>
          <th>value</th>
          <th style="width: 60px">option</th>
        </x-slot:header>
          <tr class="align-middle">
              <td>1.</td>
              <td>Gfors</td>
              <td></td>
            <td><span class="badge text-bg-danger">55%</span></td>
          </tr>
    </x-table_data>
</x-app-layout>