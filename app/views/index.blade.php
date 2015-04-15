<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>{{ isset($title) ? $title : 'mx15'}}</title>

        <meta name="description" content="{{ isset($seo->description) ? $seo->description : ''}}">
        <meta name="author" content="Farzin" >
        <meta name="robots" content="">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{ URL::asset('css/plugins-front.css') }}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ URL::asset('css/main-front.css') }}">
        
        <!-- Research Center Stylesheet -->
        <link rel="stylesheet" href="{{ URL::asset('css/research.css') }}">

        <!-- END Stylesheets -->
        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <link href="{{ URL::asset('js/vendor/modernizr-2.7.1-respond-1.4.2.min.js') }}" rel="stylesheet" media="screen">
        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.0.min.js"%3E%3C/script%3E'));</script>
        @yield('prescripts')
        @yield('poststyle')

    </head>
    <body>
        
        <!-- Page Container -->
        <!-- 'boxed' class for a boxed layout -->
        <div id="page-container">
            <!-- Site Header -->
            <header>
                <div class="container">
                    <!-- Site Logo -->
                    <a href="{{ URL::to('/') }}" class="site-logo">
                        <i class="gi gi-stats"></i> <strong>MX 15</strong>
                    </a>
                    <!-- Site Logo -->

                    <!-- Site Navigation -->
                    <nav>
                        <!-- Menu Toggle -->
                        <!-- Toggles menu on small screens -->
                        <a href="javascript:void(0)" class="btn btn-default site-menu-toggle visible-xs visible-sm">
                            <i class="fa fa-bars"></i>
                        </a>
                        <!-- END Menu Toggle -->

                        <!-- Main Menu -->
                        <ul class="site-nav">
                            <!-- Toggles menu on small screens -->
                            <li class="visible-xs visible-sm">
                                <a href="javascript:void(0)" class="site-menu-toggle text-center">
                                    <i class="fa fa-times"></i>
                                </a>
                            </li>
                            <!-- END Menu Toggle -->
                            <li class="active">
                                <a href="/" >Home</a>
                            </li>
                            
                                @if(!Auth::check())
                            <li>{{ HTML::link('register', 'Register') }}</li>   
                            <li>{{ HTML::link('clients/login', 'Login') }}</li> 
                            @else   
                            <li>{{ HTML::link('clients', 'Control Panel') }}</li>
                            <li>{{ HTML::link('clients/logout', 'logout') }}</li>
                            @endif 
                            
                        </ul>
                        <!-- END Main Menu -->
                    </nav>
                    <!-- END Site Navigation -->
                </div>
            </header>
            <!-- END Site Header -->

            @yield('content')
            <!-- Quick Stats -->
            <section class="site-content site-section themed-background">
                <div class="container">
                    <!-- Stats Row -->
                    <!-- CountTo (initialized in js/pages/features.js),  https://github.com/mhuggins/jquery-countTo -->
                    <div class="row" id="counters">
                        <div class="col-sm-4">
                            <div class="counter site-block">
                                <span data-to="6800" data-after="+"></span>
                                <small>Increased Visitors</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter site-block">
                                <span data-to="5500" data-after="+"></span>
                                <small>Better Rankings</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="counter site-block">
                                <span data-to="100" data-after="+"></span>
                                <small>Awesome Support</small>
                            </div>
                        </div>
                    </div>
                    <!-- END Stats Row -->
                </div>
            </section>
            <!-- END Quick Stats -->
            <!-- Footer -->
            <footer class="site-footer site-section">
                <div class="container">
                    <!-- Footer Links -->
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <h4 class="footer-heading">Information</h4>
                            <ul class="footer-nav list-inline">
                                <li>{{ HTML::link('aboutus', 'About Us') }}</li>
                                <li>{{ HTML::link('contact', 'Contact Us') }}</li>
                                <li>{{ HTML::link('support', 'Support') }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h4 class="footer-heading">Legal</h4>
                            <ul class="footer-nav list-inline">
                                <li>{{ HTML::link('terms-conditions', 'Terms and Conditions') }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <h4 class="footer-heading"><span id="year-copy">2014</span> &copy; <a href="#">MX15</a></h4>
                            <ul class="footer-nav list-inline">
                                <li>Created by the <a href="#">MX15 Team</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Footer Links -->
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <a href="#" id="to-top"><i class="fa fa-angle-up"></i></a>
        <script src="{{ URL::asset('js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/plugins-front.js') }}"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>

        @yield('postscripts')

    </body>
</html>