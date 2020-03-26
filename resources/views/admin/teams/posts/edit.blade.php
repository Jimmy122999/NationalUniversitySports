@extends('admin/layout')

@section('content')
<body>
  <div class="container">
<h1 class='title'>Edit's Post</h1>

<form METHOD ="POST" action="/admin/teams/{{$team->id}}/{{$teamMember->id}}/post/{{$teamPost->id}}/edit">
  @csrf

  @method('patch')
  

  <div class ='row'>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Content</span>
      </div>
      <textarea class="form-control" placeholder='{{$teamPost->body}}' name='body' aria-label="With textarea">{{$teamPost->body}}</textarea>
    </div>
   
    <div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Edit Name"></div> </form>

    <form METHOD ="POST" action="/admin/teams/{{$team->id}}/{{$teamMember->id}}/post/{{$teamPost->id}}">
      @csrf
      @method('delete')
    <div class="col-sm-1"><input class="btn btn-danger ml-3" type="submit" value="Delete"></div>
    </form>







  

  







@endsection