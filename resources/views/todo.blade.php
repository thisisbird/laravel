@extends('layout.app')
@section('content')


<nav>
    <router-link to="/home">Home</router-link>
    <router-link to="/about">about</router-link>
    ​
    <router-view>11</router-view>
</nav>
<div class="w-full h-full flex flex-col justify-center items-center">
    <h1 class="text-white text-lg">Vue js Todo App</h1>
    <todo-component></todo-component>
</div>
@endsection