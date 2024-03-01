@extends("layouts.main")

@section("title" , "Posts")

@section("content")
@parent

<table class="table">
<tr>
    <th>img</th>
    <th>Id</th>
    <th>Title</th>
    <th>Body</th>
    <th>Published at</th>
    <th>Publisher ID</th>
</tr>
@foreach ($posts as $post)
    <tr id={{ $post->id }} >
        @if ($post->image != null)
            <td><img width=100 height=100 src="{{ Storage::disk('public')->url($post->image) }}" alt=""></td>
        @else
            <td>No image</td>
        @endif
        <td>{{ $post->id }}</td>
        <td><a href={{ route('posts.show', ['id' => $post->id]) }}>{{ $post->title }}</a></td>
        <td>{{ $post->body }}</td>
        <td>{{ $post->published_at }}</td>
        <td>{{ $post->user->name }}</td>

        <td>
            <a class="btn btn-info" role="button" href={{ route('posts.edit', ['id' => $post->id]) }}>Edit</a>
            {{-- <a class="btn btn-danger" role="button" href={{ route('posts.destroy', ['id' => $post->id]) }}>Delete</a> --}}

            <form class="d-inline" method="POST" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
                @csrf
                @method('DELETE')
                <input value="Delete" type="submit" class="btn btn-danger">
            </form>
        </td>
    </tr>
@endforeach
</table>
{!! $posts->links() !!}

@endsection
