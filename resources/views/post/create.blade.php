@extends('layouts.app')
@section('content')

<form enctype="multipart/form-data" method="POST" action="{{route('posts.store')}}">
    @csrf
    <div class="mb-3">
        <label for="validationCustom04" class="form-label">Title</label>
        <input name="title" type="text" id="validationCustom04" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="validationCustom04" class="form-label">Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="validationCustom04" class="form-label">Photo</label>
        <input type="file" name="photo" class="form-control" required></textarea>
    </div>
    <div class="col-md-3 mb-3">
        <label for="validationCustom04" class="form-label">User</label>
        <select name="user_id" class="form-select" id="validationCustom04" required>
            <option selected disabled value="">Choose...</option>
            @foreach ($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <div class="invalid-feedback">
            Please select a valid state.
        </div>
    </div>
    <button type="submit" class="mb-3 btn btn-success"> Create Post </button>
    <a href="{{route('posts.index')}}" class="mb-3 btn btn-danger"> Cancel </a>
</form>

@endsection