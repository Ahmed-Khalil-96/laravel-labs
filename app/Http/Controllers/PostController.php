<?php

namespace App\Http\Controllers;

use App\Events\PostAdded;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(3);
        return view("posts.index" , ["posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::all();
        return view("posts.create", ["users" => $users]);
    }

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StorePostRequest;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request) 
    {
        $validatedData = $request->validated();
        // dd($request->file('image'));
        $now = new DateTime();

        $published_at = $now->format('Y-m-d H:i:s');
        $slug = Str::slug($validatedData['title'], '-');
        $enabled = 1; // true by default
        $user = User::find(Auth::id());
        if($request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('posts' , 'public');
        }


        $data = [
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'slug' => $slug,
            'published_at' => $published_at,
            'enabled' => $enabled,
            'image' => $imagePath
        ];

        $post = $user->posts()->save(new Post($data));

        event(new PostAdded($post));
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view("posts.show" , ["post" => ($post ? $post : '')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view("posts.edit" , ["post" => ($post ? $post : '')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\StorePostRequest;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $slug = Str::slug($validatedData['title'], '-');
        $data = [
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'slug' => $slug,
            'enabled' => 1,
        ];

        // $user = User::find();

        $post = Post::find($id);

        if(Auth::id() == $post->user_id)
            $post->update($data);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
}
