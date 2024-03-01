@extends("layouts.main")


@section("title" , "edit")

@section("content")
@if ($post == '') 
    No post with this id
@else
<h1>Editing Post {{ $post->id }} </h1>
<form method="post" action={{ route("posts.update" ,["id" => $post->id]) }}> 
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input name="title" type="text" value="{{ $post->title }}" class="form-control" id="title">
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Post Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control">
                {{ $post->body }}
            </textarea>            
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
</form>
@endif

@endsection