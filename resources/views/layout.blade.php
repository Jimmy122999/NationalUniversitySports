<!DOCTYPE html>



<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">




</head>
<body>
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="/">National University Sports</a></h1>
		</div>
		<div>
			<ul class="nav">
				<li class="btn btn-outline-primary" class="{{ Request::path() == '/' ? 'current_page_item' : ''}}"><a class="nav-link" href="/" accesskey="1" title="">Homepage</a></li>

				<li class="btn btn-outline-primary" class="{{ Request::path() == 'sports' ? 'current_page_item' : ''}}"><a class="nav-link" href="/sports" accesskey="2" title="">Sports</a></li>
				
				<li class="btn btn-outline-primary" class="{{ Request::path() == 'about' ? 'current_page_item' : ''}}"><a class="nav-link" href="/about" accesskey="3" title="">About Us</a></li>
				<li class="btn btn-outline-primary" class="{{ Request::path() == '/' ? 'current_page_item' : ''}}"><a class="nav-link" href="#" accesskey="4" title="">Careers</a></li>
				<li class="btn btn-outline-primary" class="{{ Request::path() == 'myTeam' ? 'current_page_item' : ''}}"><a class="nav-link" href="/myTeam" accesskey="5" title="">My Team</a></li>
			</ul>
		</div>
	</div>
@yield ('content')

<div id="copyright" class="container">
	<p>NUS Sports</p>
</div>
</body>
</html>