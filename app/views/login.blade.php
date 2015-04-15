<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>{{ isset($title) ? $title : 'mx15'}}</title>

        <meta name="description" content="{{ isset($seo->description) ? $seo->description : ''}}">
        <meta name="author" content="SEO">
        <meta name="robots" content="">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="img/favicon.ico">


        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{ URL::asset('css/plugins.css') }}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <link href="{{ URL::asset('js/vendor/modernizr-2.7.1-respond-1.4.2.min.js') }}" rel="stylesheet" media="screen">
    </head>
    <body>

        <!-- Login Full Background -->
        <!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
        <img src="{{asset('img/backgrounds/bg-cyan.jpg')}}" alt="Login Full Background" class="full-bg animation-pulseSlow">
        <!-- END Login Full Background -->

        <!-- Login Container -->
        <div id="login-container" class="animation-fadeIn">
            <!-- Login Title -->
            <div class="login-title text-center">
                <h1><i class="gi gi-stats"></i><br><small>Please <strong>Login</strong> or <strong>{{ HTML::link('register', 'Register') }}</strong></small></h1>
            </div>
            <!-- END Login Title -->

            <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                {{ Form::open(array('class' => 'form-horizontal form-bordered form-control-borderless')) }}
                {{ $errors->first("password") }}<br />
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            {{ Form::label("login-email", "Username",array('class' => 'input-group-addon')) }}
                            {{ Form::text("username", Input::old("username"),array('id'=>'login-email','class' => 'form-control input-lg','placeholder'=>'Username')) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            {{ Form::label("login-password", "Password", array('class' => 'input-group-addon')) }}
                            {{ Form::password("password", array('id'=>'login-password', 'class' => 'form-control input-lg','placeholder'=>'Password' )) }}
                        </div>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-4">
                        <div class="col-xs-8 text-right">
                            {{ Form::submit("Login to Dashboard", array('class' => 'btn btn-sm btn-primary') ) }}
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <!-- END Login Form -->

                <!-- Reminder Form -->
                <form action="login_full.php#reminder" method="post" id="form-reminder" class="form-horizontal form-bordered form-control-borderless display-none">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-envelope"></i></span>
                                <input type="text" id="reminder-email" name="reminder-email" class="form-control input-lg" placeholder="Email">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Reset Password</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <small>Did you remember your password?</small> <a href="javascript:void(0)" id="link-reminder"><small>Login</small></a>
                        </div>
                    </div>
                </form>
                <!-- END Reminder Form -->


                <!-- END Register Form -->
            </div>
            <!-- END Login Block -->
        </div>
        <!-- END Login Container -->




        <!-- Remember to include excanvas for IE8 chart support -->
        <!--[if IE 8]><script src="{{ URL::asset('js/helpers/excanvas.min.js') }}"></script><![endif]-->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.0.min.js"%3E%3C/script%3E'));</script>

        <script src="{{ URL::asset('js/vendor/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/plugins.js') }}"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>

        <script src="{{ URL::asset('js/pages/login.js') }}"></script>
        <script>$(function() {
    Login.init();
});</script>

    </body>
</html>