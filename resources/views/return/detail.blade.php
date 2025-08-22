<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="" class="btn btn-warning w-100">Edit this data</a>
    </x-slot:side_canvas>
    {{ $return }}
    <hr>
    {{ $assets }}
</x-app-layout>