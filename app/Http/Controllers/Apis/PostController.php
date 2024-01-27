<?php

namespace App\Http\Controllers\Apis;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\traits\ApiTrait;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    use ApiTrait;
    public function index(){
        $posts = Post::all();

        return $this->Data(compact("posts"));
    }

    public function create(){
        $users = User::all();
        return $this->Data(compact("users"));
    }

    public function store(StorePostRequest $request){
        
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

        return $this->SuccessMessage("Post Added Successfully", 201);
    }

    public function show($id){
        $post = Post::find($id);

        return $this->Data(compact("post"));
    }

    public function edit($id){
        $post = Post::findOrfail($id);
        $user = User::all();

        return $this->Data(compact("post","user"));
    }

    public function update(UpdatePostRequest $request, $id){

        $title = $request->title;
        $description = $request->description;
        $user_id = $request->user_id;

        $post = Post::find($id);
        $post->update([
            "title"=>$title,
            "description"=>$description,
            "user_id"=>$user_id
        ]);

        return $this->SuccessMessage("Data Updated Successfully");
    }

    public function destroy( $id)
    {
        $post = Post::find($id);

        if($post){
            $post->delete();        
        return $this->SuccessMessage("Post Deleted Successfully");
        }
        else{
            return $this->ErrorMessage(["id"=>"given id is not invalid"], "Post is not found");
        }
    }
}