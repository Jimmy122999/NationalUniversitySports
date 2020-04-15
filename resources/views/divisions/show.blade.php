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
    <a class="btn btn-primary" href="/sports/{{$division->sport->name}}/{{$division->id}}/season" role="button">Generate Season</a>
  </div>
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
        <td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/edit" role="button">Edit</a></center></td>
        @endcan
        @endcan
        @can('captainEdit' , [App\Fixture::class , $fixture])
        <td><center><a class="btn btn-primary ml-auto" href="/fixtures/{{$fixture->id}}/edit-information" role="button">Add Information</a></center></td>
        @endcan
      </tr>   
      
      


      @endforeach
    </tbody>

    {{$fixtures->links()}}
    {{-- <form METHOD ="POST" action="/sports/{{$sport->name}}/{{$sport->division->id}}/season">
      @csrf --}}
    
</div>
@endsection

<script type="text/javascript">
  $(document).ready(function() {
      $('#fixtures').DataTable();
  } );

</script>

