<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postFromDB = Post::all();

        return view('post/index', ["posts"=>$postFromDB]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('post/create', ["users"=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $title = request()->title;
       $description = request()->description;
       $user = request()->user_id;

       if($request->has('photo')){
        $image= $request->photo;
        $imagename=time().".".$image->extension();
        $image->move("Photos",$imagename);
       }

       $post = Post::create(
        ["title"=>$title, 
         "description"=>$description,
         "user_id"=>$user,
         "photo"=>$imagename]
       );

       return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $single_post = Post::findorfail($id);
        return view('post/show', ['post'=>$single_post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $users = User::all();

        $post = Post::findorfail($id);
        return view('post/edit', ["post"=>$post, "users"=>$users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $title = $request->title;
        $description = $request->description;
        $user_id = $request->user_id;

        $post = Post::find($id);
        $post->update([
            "title"=>$title,
            "description"=>$description,
            "user_id"=>$user_id
        ]);

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $post = Post::find($id);
        $post->delete();        
        return redirect(route('posts.index'))->with('delete','Post Deleted Successfully');
    }
}