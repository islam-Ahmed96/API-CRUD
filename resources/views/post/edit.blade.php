@extends('layouts.app')
@section('content')

<form method="POST" action="{{route('posts.update', $post->id)}}">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input name="title" type="text" class="form-control" value="{{$post->title}}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description</label>
    <textarea name="description" class="form-control">{{$post->description}}</textarea>
  </div>
  <div class="col-md-3 mb-3">
    <label for="validationCustom04" class="form-label">User</label>
      <select name ="user_id" class="form-select" id="validationCustom04" required>
        @foreach ($users as $user)
          <option value="{{$user->id}}" @if($user->id == $post->user_id) selected @endif>{{$user->name}}</option>
        @endforeach
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
      </div>
  </div>
    <button type="submit" class="mb-3 btn btn-success"> Edit </button>
    <a href="{{route('posts.index')}}" class="mb-3 btn btn-danger"> Cancel </a>
</form>

@endsection