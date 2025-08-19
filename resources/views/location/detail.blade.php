<x-app-layout>
    <x-slot:title>{{$title}}</x-slot:title>
    <x-slot:side_canvas>
        <a href="/manage/location/{{ $location[0]['lctn_id'] }}/edit" class="btn btn-warning w-100">Edit this data</a>
    </x-slot:side_canvas>
    {{ $location[0]['lctn_name']}}

    
</x-app-layout>