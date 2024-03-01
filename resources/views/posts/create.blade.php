@extends("layouts.main")

@section("title" , "create post")

@section("content")
@parent

<h1>Creating New User</h1>
    <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input name="title" value="{{ old('title') }}" type="text" class="form-control" id="title">
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Post Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control">
                {{ old('body')  }}
            </textarea>            
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image (png,jpg,jpeg)</label>
            <input type="file" name="image" id="image">        
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
    </form>

@endsection