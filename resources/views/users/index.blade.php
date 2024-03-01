@extends("layouts.main")

@section("title" , "index")

@section("content")
@parent

<table class="table">
<tr>
    <th>Id</th>
    <th>Name</th>
    <th>Email</th>
    <th>Posts No.</th>
    <th>Action</th>
</tr>
@foreach ($users as $user)
    <tr id={{ $user->id }} >
        <td>{{ $user->id }}</td>
        <td><a href={{ "/users/" . $user->id }}>{{ $user->name }}</a></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->posts_count }}</td>
        <td>
            <a class="btn btn-info" role="button" href={{ route('users.edit', ['id' => $user->id]) }}>Edit</a>
            {{-- <a class="btn btn-danger" role="button" href={{ route('users.destroy', ['id' => $user->id]) }}>Delete</a> --}}

            <form class="d-inline" method="POST" action="{{ route('users.destroy', ['id' => $user->id]) }}">
                @csrf
                @method('DELETE')
                <input type="text" value="{{ $user->id }}" hidden>
                <input value="Delete" type="submit" class="btn btn-danger">
            </form>
        </td>
    </tr>
@endforeach
</table>
@endsection
