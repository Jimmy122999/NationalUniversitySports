@extends('admin/layout')

@section('content')
<body>
  <div class="container">
<h1 class='title'>Edit Sport Name</h1>

<form METHOD ="POST" action="/admin/sports/{{$sport->id}}/edit">
  @csrf

  @method('patch')
  

  <div class ='row'>

    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Sport Name</span>
      </div>
      <input type="text" value='{{$sport->name}}' name="name" placeholder="Name" class="form-control">
    </div>
   
    <div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Edit Name"></div> </form>

    <form METHOD ="POST" action="/admin/sports/{{$sport->id}}">
      @csrf
      @method('delete')
    <div class="col-sm-1"><input class="btn btn-danger ml-3" type="submit" value="Delete"></div>
    </form>







  

  







@endsection