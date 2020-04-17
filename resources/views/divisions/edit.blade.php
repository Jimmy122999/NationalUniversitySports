@extends('layout')

@section('content')
<body>
  <div class="container">
<h1 class='title'>Edit Division</h1>

<form METHOD ="POST" action="/sports/{{$sport->name}}/{{$division->id}}/edit">
  @csrf

  @method('patch')
  

  <div class ='row'>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Sport Name</span>
      </div>
      <input type="text" value='{{$division->name}}' name="name" placeholder="Name" class="form-control" required>
    </div>
   
    <div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Edit Name"></div> </form>

    <form METHOD ="POST" action="/sports/{{$sport->name}}/{{$division->id}}">
      @csrf
      @method('delete')
    
    <div class="col-sm-1 ml-3"><a class="btn btn-danger" data-toggle="modal" data-target='#myModal' style="color: white">Delete</a></div>
    
     


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <p>Are you sure you want to delete this Division?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             <input id='delete' data-toggle="modal"  class="btn btn-danger ml-3" type="submit" value="Delete">
          </div>
        </div>

      </div>
    </div>
  

  


@endsection


