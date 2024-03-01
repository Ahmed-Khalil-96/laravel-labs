<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("users.index" , ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
                'username' => 'required|string',
                'email' => 'required|unique:users|email'
        ]);
        // storing user
        User::create([
            'name' => $request->username,
            'email' => $request->email
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        $posts = $user->posts;
        
        return view("users.show" , [ "user" => ($user ? $user : ''), "posts" => $posts ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $user = User::find($id);
        return view("users.edit" , [ "user" => ($user ? $user : '') ]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validation
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email'
        ]);

        User::find($id)->update([
            'name' => $request->username,
            'email' => $request->email

        ]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect()->route('users.index');
    }
}
