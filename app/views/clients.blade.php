<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

         <title>{{ isset($title) ? $title : 'mx15'}}</title>

        <meta name="description" content="{{ isset($description) ? $description : 'mx15'}}">
        <meta name="author" content="Farzin" >
        <meta name="robots" content="">
        
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
        <!-- END Icons -->
        @yield('tickethead')
        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/master.css') }}">	
		
        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{ URL::asset('css/plugins.css') }}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ URL::asset('css/main-front.css') }}">
        
        <!-- The research css -->
        <link rel="stylesheet" href="{{ URL::asset('css/research.css') }}">

        <!-- END Stylesheets -->
        
        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <link href="{{ URL::asset('js/vendor/modernizr-2.7.1-respond-1.4.2.min.js') }}" rel="stylesheet" media="screen">
        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.0.min.js"%3E%3C/script%3E'));</script>
        @yield('prescripts')

    </head>
    <body>

<!-- Static navbar -->
    <div class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{ URL::to('/') }}">MX 15</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('clients') }}">Dashboard</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Analyze<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
              	 <li><a href="{{ URL::to('clients/research') }}">Research</a></li>	
                <li><a href="{{ URL::to('clients/trends') }}">Trends</a></li>
                <li><a href="{{ URL::to('clients/historical-queries') }}">Past Queries</a></li>
              </ul>
            </li>
			<li><a href="{{ URL::to('support') }}">Help Desk</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
			@if ($role < 3)
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    <li class="dropdown-header">Tickets</li>
                    <li>{{ HTML::link('support/tickets', 'All Tickets') }}</li>
                                        {{-- admins only --}}
					@if ($role == 1)
                    <li class="divider"></li>
					<li class="dropdown-header">System</li>
                    <li>{{ HTML::link('admin/users', 'Users') }}</li>
					<li>{{ HTML::link('admin/roles', 'Roles') }}</li>
					<li>{{ HTML::link('admin/departments', 'Departments') }}</li>
												
                    <li class="divider"></li>
					<li class="dropdown-header">Configuration</li>

					<li>{{ HTML::link('support/settings', 'General Options') }}</li>

					@endif
										
					</ul>

				</li>
			@endif
            <li><a href="{{ URL::route('user/profile') }}">Profile</a></li>
			<li><a href="{{ URL::route('user/logout') }}">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	
	<div id="content-wrapper">
		@yield("content")
	</div>

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
      

<!-- Remember to include excanvas for IE8 chart support -->
<!--[if IE 8]><script src="{{ URL::asset('js/helpers/excanvas.min.js') }}"></script><![endif]-->

<script>
$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
});
</script>

<!-- Bootstrap.js, Jquery plugins and Custom JS code -->
<script src="{{ URL::asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/plugins.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>
        
</body>
</html>