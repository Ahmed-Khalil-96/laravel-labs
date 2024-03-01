@extends("layouts.main")


@section("title" , "edit")

@section("content")
@if ($user == '') 
    No user with this id
@else
<h1>Editing User {{ $user->id }} </h1>
<form method="post" action="/users/{{ $user->id }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input name="username" type="text" value="{{ $user->name }}" class="form-control" id="username">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1"  class="form-label">Email address</label>
            <input type="email" value={{ $user->email }} class="form-control" name="email" id="email" aria-describedby="emailHelp">            
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endif

@endsection