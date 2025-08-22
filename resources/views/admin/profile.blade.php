<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    {{ $users }}
    <p>name: {{$users['name']}}</p>
    <p>name: {{$users['roles']['rl_name']}}</p>
</x-app-layout>