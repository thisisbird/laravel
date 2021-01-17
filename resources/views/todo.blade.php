@extends('layouts.app')
@section('content')

<div class="w-full h-full flex flex-col justify-center items-center">
    <h1 class="text-white text-lg">Vue js Todo App</h1>
    {{-- <todo-component></todo-component> --}}
    <router-view></router-view>
</div>
@endsection