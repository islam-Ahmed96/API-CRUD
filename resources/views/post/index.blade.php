@extends('layouts.app')
@section('content')
    <a href="{{route('posts.create')}}" type="button" class="mb-3 btn btn-success"> Create Post </a>
    <table class="table" >
        <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Title</th>
              <th scope="col">Posted By</th>
              <th scope="col">Created At</th>
              <th scope="col">Photo</th>
              <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
              <th scope="row">{{$post->id}}</th>
              <td>{{$post['title']}}</td>
              <td>{{$post->user ? $post->user->name : "user not found"}}</td>
              <td>{{$post['created_at']}}</td>
              <td><img src="Photos/{{$post->photo}}" style="width:50px; heigh:50px;"></td>
              <td>
                <a href="{{route('posts.show', $post->id)}}" class="btn btn-info"> View</a>
                <a href="{{route('posts.edit', $post->id)}}" class="btn btn-primary"> Edit</a>
                <form style="display:inline;" method="POST" action="{{route('posts.destroy', $post->id)}}">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="btn btn-danger"> Delete</button>
                </form>
              </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
@endsection