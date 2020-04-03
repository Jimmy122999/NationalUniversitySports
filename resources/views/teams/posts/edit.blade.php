@extends('layout')

@section('content')
<body>
  <div class="container">
<h1 class='title'>Edit's Post</h1>

<form METHOD ="POST" action="/teams/{{$team->id}}/{{$teamMember->id}}/post/{{$teamPost->id}}/edit">
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

    <form METHOD ="POST" action="/teams/{{$team->id}}/{{$teamMember->id}}/post/{{$teamPost->id}}">
      @csrf
      @method('delete')
    <div class="col-sm-1"><input id='delete' class="btn btn-danger ml-3" type="submit" value="Delete"></div>
    </form>







  

  







@endsection

<script type="text/javascript">
  window.onload = function(){
  var del = document.getElementById('delete');

  del.onclick = function(){
    var x = confirm('Are you sure you want to delete this post?');
    if(x == true){
      return true;
    }
    else
    {
      return false;
    }
  }
}
</script>
