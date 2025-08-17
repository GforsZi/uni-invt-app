<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/asset/{{ $asset[0]['ast_id'] }}/edit" class="btn btn-warning w-100">Edit this data</a>
    </x-slot:side_canvas>
    {{ $asset }}
</x-app-layout>