@extends("layouts.main")


@section("title" , "Post " . $post->id)

@section("content")

@if ($post == '') 
    No post with this id
@else
@if ($post->image != null)
    <td><img class="border border-5" width=100 height=100 src="{{ Storage::disk('public')->url($post->image) }}" alt=""></td>
@else
<h3 class="border border-5">No image</h3>
@endif
<h1>Post {{ $post->id }}</h1>
<h2>Title :  {{ $post->title }}</h2>
<p>Body :  {{ $post->body }}</p>
<p>Published at : {{ $post->published_at }}</p>
@if($post->user)
<p>By : {{ $post->user->name }}</p>

@endif
@endif


@endsection
