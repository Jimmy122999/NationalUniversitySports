@extends ('layout')
@section ('scripts')
<link href="/vendor/datetimepicker-2.5.20/jquery.datetimepicker.css" rel="stylesheet"/>
@endsection
@section ('content')





<div class ="container">
	<p>This is a sports league management app for universities competing against eachother</p>

	<div class="container">
	    <div class="row">
	        <div class='col-sm-6'>
	            <div class="form-group">
	                <div class='input-group date' id='picker'>
	                    <input type='text' class="form-control" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
	            </div>
	        </div>
	        
	    </div>
	</div>

</div>


@endsection
