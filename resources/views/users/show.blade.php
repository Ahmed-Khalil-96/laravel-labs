@extends("layouts.main")


@section("title" , "show")

@section("content")

@if ($user == '') 
    No user with this id
@else
<h3>User {{ $user->id }}</h3>
<h2>Username :  {{ $user->name }}</h3>
<h2>Email :  {{ $user->email }}</h3>

    <h2>Posts</h2>
    @foreach ($posts as $post )
        <p>{{ $post->title }} : {{ $post->body }}</p>
    @endforeach

@endif

@endsection
