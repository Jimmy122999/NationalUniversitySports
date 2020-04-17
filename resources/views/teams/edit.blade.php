@extends('layout')

@section('content')
<body>
  <div class="container">
<h1 class='title'>Edit Team</h1>

<form METHOD ="POST" action="/teams/{{$team->id}}/edit">
  @csrf

  @method('patch')
  

  <div class ='row'>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-default">Team Name</span>
      </div>
      <input type="text" value='{{$team->name}}' name="name" placeholder="{{$team->name}}" class="form-control" required>
    </div>

    <div class="input-group mb-3 dynamic">
        <div class="input-group-prepend dynamic">
            <label class="input-group-text dynamic">Sport</label>
        </div>
          <select class="custom-select dynamic" id='sport_id' name='sport_id' data-dependent='id'>
            <option value="{{$team->sport_id}}" selected='true' disabled='disabled'>Select a Sport</option>
            @foreach ($sports as $sport)
            
              <option value="{{$sport->id}}" name='sport'>{{$sport->name}}</option>
            @endforeach
          </select>
    </div>

    <div class="input-group mb-3 dynamic">
          <div class="input-group-prepend dynamic" >
              <label class="input-group-text dynamic" >Division</label>
          </div>


            <select class="custom-select dynamic" name='division_id' id='division' data-dependent='sport'>
              <option value="#" selected='true' disabled='disabled'>Select Division</option>
              @foreach ($divisions as $division_id => $division_name)

                @if($division_id == $team->division_id)
                  <option value="{{$division_id}}" name='division' selected="true">{{$division_name}}</option>
                @else

                  <option value="{{$division_id}}" name='division'>{{$division_name}}</option>
                @endif

              @endforeach              
            
            </select>

    </div>

    <div class="input-group mb-3 dynamic">
        <div class="input-group-prepend dynamic">
            <label class="input-group-text dynamic">Captain</label>
        </div>
          <select class="custom-select dynamic" id='captain' name='captain_id'>
            <option value="{{$team->captain_id}}" selected='true' disabled='disabled'>Select a Captain (Leave blank if captain not yet available)</option>
            @foreach ($captains as $captain)
              <option value="{{$captain->id}}" name='sport'>{{$captain->name}}</option>
            @endforeach
          </select>
    </div>
   
    <div class="col-sm-1"><input class="btn btn-primary" type="submit" value="Confirm"></div> </form>

    <form METHOD ="POST" action="/teams/{{$team->id}}">
      @csrf
      @method('delete')
    <div class="col-sm-1"><a class="btn btn-danger" data-toggle="modal" data-target='#myModal' style="color: white">Delete</a></div>
        
         


        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-body">
                <p>Are you sure you want to delete this Team?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 <input id='delete' data-toggle="modal"  class="btn btn-danger ml-3" type="submit" value="Delete">
              </div>
            </div>

          </div>
        </div>
    </form>







  

  







@endsection

</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script type="text/javascript">
$(document).ready(function(){

  $('#sport_id').change(function(){


    if($(this).val() != ''){
      var select =$(this).attr('id');
      var value =$(this).val();
      var dependent = $(this).data('dependent');
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url:"{{ route('teamcontroller.fetch')}}",
        method:"POST",
        data:{
          select:select, 
          value:value, 
          _token: _token, 
          dependent:dependent
        },
        success:function(result)
        {
          $('#division').html(result);
        }
      })

    }

  });





});



@push('scripts')



  

</script>

