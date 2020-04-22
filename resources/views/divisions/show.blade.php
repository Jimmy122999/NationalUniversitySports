@extends ('layout')

@section ('content')
<div class = container>
  <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Games Played</th>
          <th scope="col">Wins</th>
          <th scope="col">Draws</th>
          <th scope="col">Losses</th>
          <th scope="col">Points</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($teams as $team)
       <tr>
         <th scope="row"><a href="/teams/{{$team->id}}">{{$team->name}}</a></th>
         <td>{{$team->played}}</td>
         <td>{{$team->wins}}</td>
         <td>{{$team->draws}}</td>
         <td>{{$team->losses}}</td>
         <td>{{$team->points}}</td>


        
         
       </tr>

       @endforeach



      
    
       
      </tbody>


    </table>
    @can('generateSeason' , App\Fixture::class)
    <a class="btn btn-primary" id='season' href="/sports/{{$division->sport->name}}/{{$division->id}}/new" role="button"> New Season</a>
    <a class="btn btn-primary" data-toggle="modal" data-target='#myModal' style="color: white">Start New Season</a>

    @endcan
  </div>
    @if($results->count() !== 0)
    <div class = container>
      @if(empty($results))
      @else
      <h1 class="font-weight-bold"><center>Latest Results</center></h1>
      <table class="table table-bordered">
          <tbody>
            
            @foreach($results as $result)
            <tr>
              <td><a href="/teams/{{$result->homeTeam->id}}"><center>{{$result->homeTeam->name}}</center></a></td>
              <td><center>{{$result->result->home_team_score}}</center></td>
              <td><center>-</center></td>
              <td><center>{{$result->result->away_team_score}}</center></td>
              <td><a href="/teams/{{$result->awayTeam->id}}"><center>{{$result->awayTeam->name}}</center></a></td>
              @can('update' , App\Fixture::class)
              <td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$result->id}}/result/{{$result->result->id}}/edit" role="button">Edit</a></center></td>
              @endcan
              
              
            </tr> 

            
            


            @endforeach
            @endif
          </tbody>

        </table>
       

      {{$results->links()}}
      {{-- <form METHOD ="POST" action="/sports/{{$sport->name}}/{{$sport->division->id}}/season">
        @csrf --}}
      
  </div>
  @endif
  @if($fixtures->count() !== 0)
  <div class = container>

    <h1 class="font-weight-bold"><center>Upcoming Fixtures</center></h1>

    <table id='fixtures' class="table table-bordered">
    <tbody>

      @foreach($fixtures as $fixture)
      <tr>
        <td><a href="/teams/{{$fixture->homeTeam->id}}"><center>{{$fixture->homeTeam->name}}</center></a></td>
        <td><center>{{$fixture->time->format('d/m/Y H:i')}}</center><br><center>{{$fixture->notes}}</center></td>
        <td><a href="/teams/{{$fixture->awayTeam->id}}"><center>{{$fixture->awayTeam->name}}</center></a></td>
        @can('update' , App\Fixture::class)
        <td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/result" role="button">Enter Result</a></center></td>
        @can('create' , App\Fixture::class)
        <td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/edit" role="button">Set Time and Information</a></center></td>
        @endcan
        @endcan
        @can('captainEdit' , [App\Fixture::class , $fixture])
        <td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/edit-information" role="button">Add Information</a></center></td>
        @endcan
      </tr>   
      
      


      @endforeach
    </tbody>
  </table>
  {{$fixtures->links()}}
@endif
    
</div>


    
     


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <p>Are you sure you want to generate a new season? This will delete all previous Fixtures and results for this division?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             <a class="btn btn-primary" id='season' href="/sports/{{$division->sport->name}}/{{$division->id}}/season" role="button">Start New Season</a>
          </div>
        </div>

      </div>
    </div>
  
@endsection

