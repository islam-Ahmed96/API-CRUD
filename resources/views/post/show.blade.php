@extends('layouts.app')
@section('content')

  <div class="card">
    <div class="card-header">Post Info</div>
    <div class="card-body">
      <h5 class="card-title">ID : {{$post['id']}} </h5>
      <h5 class="card-title">Title : {{$post['title']}} </h5>
      <h5 class="card-title">Description : {{$post['description']}} </h5>
    </div>
  </div>
  <a href="{{route('posts.index')}}" class="mb-3 mt-3 btn btn-success"> back </a>

@endsection