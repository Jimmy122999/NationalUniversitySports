<!DOCTYPE html>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>





</head>
<body>
	<div id="header" class="container">
		
		<div>

			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			  <a class="navbar-brand" href="/">National University Sports</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="collapsibleNavbar">
			    <ul class="navbar-nav">
			      <li class="nav-item">
			        <a class="nav-link" href="/sports">Sports</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/fixtures">Fixtures</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/about">About</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/myTeam">My Team</a>
			      </li>    
			    </ul>
			  </div>  
			</nav>
			<!--!!
			<ul class="nav">
				<li class="btn btn-outline-primary" class="{{ Request::path() == '/' ? 'current_page_item' : ''}}"><a class="nav-link" href="/" accesskey="1" title="">Homepage</a></li>

				<li class="btn btn-outline-primary" class="{{ Request::path() == 'sports' ? 'current_page_item' : ''}}"><a class="nav-link" href="/sports" accesskey="2" title="">Sports</a></li>
				
				<li class="btn btn-outline-primary" class="{{ Request::path() == 'about' ? 'current_page_item' : ''}}"><a class="nav-link" href="/about" accesskey="3" title="">About Us</a></li>
				<li class="btn btn-outline-primary" class="{{ Request::path() == '/' ? 'current_page_item' : ''}}"><a class="nav-link" href="#" accesskey="4" title="">Careers</a></li>
				<li class="btn btn-outline-primary" class="{{ Request::path() == 'myTeam' ? 'current_page_item' : ''}}"><a class="nav-link" href="/myTeam" accesskey="5" title="">My Team</a></li>
			</ul>-->
		</div>
	</div>
@yield ('content')

<div id="copyright" class="container">
	<p>NUS Sports</p>
</div>
</body>
</html>