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

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{ URL::asset('css/plugins.css') }}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
        
        <!-- Stylesheet for Research Center -->
        <link rel="stylesheet" href="{{ URL::asset('css/research.css') }}">

        <!-- END Stylesheets -->
        
        <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
        <link href="{{ URL::asset('js/vendor/modernizr-2.7.1-respond-1.4.2.min.js') }}" rel="stylesheet" media="screen">
        <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file (Remove 'http:' if you have SSL) -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.0.min.js"%3E%3C/script%3E'));</script>

    </head>
    <body>

@section('head')
<div id="page-container"  class="{{Session::get('pagecontainer')}}">
    <!-- Alternative Sidebar -->
    <div id="sidebar-alt">
        <!-- Wrapper for scrolling functionality -->
        <div class="sidebar-scroll">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Chat -->
                <!-- Chat demo functionality initialized in js/app.js -> chatUi() -->
                <a href="page_ready_chat.php" class="sidebar-title">
                    <i class="gi gi-comments pull-right"></i> <strong>Chat</strong>UI
                </a>
                <!-- Chat Users -->
                <ul class="chat-users clearfix">
                    <li>
                        <a href="javascript:void(0)" class="chat-user-online">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar12.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="chat-user-online">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar15.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="chat-user-online">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar10.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="chat-user-online">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar4.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="chat-user-away">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar7.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="chat-user-away">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar9.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="chat-user-busy">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar16.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar1.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar4.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar3.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar13.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <span></span>
                            <img src="{{asset('img/placeholders/avatars/avatar5.jpg')}}" alt="avatar" class="img-circle">
                        </a>
                    </li>
                </ul>
                <!-- END Chat Users -->

                <!-- Chat Talk -->
                <div class="chat-talk display-none">
                    <!-- Chat Info -->
                    <div class="chat-talk-info sidebar-section">
                        <img src="{{asset('img/placeholders/avatars/avatar5.jpg')}}" alt="avatar" class="img-circle pull-left">
                        <strong>{{ Auth::user()->username }}</strong> 
                        <button id="chat-talk-close-btn" class="btn btn-xs btn-default pull-right">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <!-- END Chat Info -->

                    <!-- Chat Messages -->
                    <ul class="chat-talk-messages">
                        <li class="text-center"><small>Yesterday, 18:35</small></li>
                        <li class="chat-talk-msg animation-slideRight">Hey admin?</li>
                        <li class="chat-talk-msg animation-slideRight">How are you?</li>
                        <li class="text-center"><small>Today, 7:10</small></li>
                        <li class="chat-talk-msg chat-talk-msg-highlight themed-border animation-slideLeft">I'm fine, thanks!</li>
                    </ul>
                    <!-- END Chat Messages -->

                    <!-- Chat Input -->
                    <form action="index.php" method="post" id="sidebar-chat-form" class="chat-form">
                        <input type="text" id="sidebar-chat-message" name="sidebar-chat-message" class="form-control form-control-borderless" placeholder="Type a message..">
                    </form>
                    <!-- END Chat Input -->
                </div>
                <!--  END Chat Talk -->
                <!-- END Chat -->

                <!-- Activity -->
                <a href="javascript:void(0)" class="sidebar-title">
                    <i class="fa fa-globe pull-right"></i> <strong>Activity</strong>UI
                </a>
                <div class="sidebar-section">
                    <div class="alert alert-danger alert-alt">
                        <small>just now</small><br>
                        <i class="fa fa-thumbs-up fa-fw"></i> Upgraded to Pro plan
                    </div>
                    <div class="alert alert-info alert-alt">
                        <small>2 hours ago</small><br>
                        <i class="gi gi-coins fa-fw"></i> You had a new sale!
                    </div>
                    <div class="alert alert-success alert-alt">
                        <small>3 hours ago</small><br>
                        <i class="fa fa-plus fa-fw"></i> <a href="page_ready_user_profile.php"><strong>{{Session::get('name')}}</strong></a> would like to become friends!<br>
                        <a href="javascript:void(0)" class="btn btn-xs btn-primary"><i class="fa fa-check"></i> Accept</a>
                        <a href="javascript:void(0)" class="btn btn-xs btn-default"><i class="fa fa-times"></i> Ignore</a>
                    </div>
                    <div class="alert alert-warning alert-alt">
                        <small>2 days ago</small><br>
                        Running low on space<br><strong>18GB in use</strong> 2GB left<br>
                        <a href="page_ready_pricing_tables.php" class="btn btn-xs btn-primary"><i class="fa fa-arrow-up"></i> Upgrade Plan</a>
                    </div>
                </div>
                <!-- END Activity -->

                <!-- Messages -->
                <a href="page_ready_inbox.php" class="sidebar-title">
                    <i class="fa fa-envelope pull-right"></i> <strong>Messages</strong>UI (5)
                </a>
                <div class="sidebar-section">
                    <div class="alert alert-alt">
                        Debra Stanley<small class="pull-right">just now</small><br>
                        <a href="page_ready_inbox_message.php"><strong>New Follower</strong></a>
                    </div>
                    <div class="alert alert-alt">
                        Sarah Cole<small class="pull-right">2 min ago</small><br>
                        <a href="page_ready_inbox_message.php"><strong>Your subscription was updated</strong></a>
                    </div>
                    <div class="alert alert-alt">
                        Bryan Porter<small class="pull-right">10 min ago</small><br>
                        <a href="page_ready_inbox_message.php"><strong>A great opportunity</strong></a>
                    </div>
                    <div class="alert alert-alt">
                        Jose Duncan<small class="pull-right">30 min ago</small><br>
                        <a href="page_ready_inbox_message.php"><strong>Account Activation</strong></a>
                    </div>
                    <div class="alert alert-alt">
                        Henry Ellis<small class="pull-right">40 min ago</small><br>
                        <a href="page_ready_inbox_message.php"><strong>You reached 10.000 Followers!</strong></a>
                    </div>
                </div>
                <!-- END Messages -->
            </div>
            <!-- END Sidebar Content -->
        </div>
        <!-- END Wrapper for scrolling functionality -->
    </div>
    <!-- END Alternative Sidebar -->

    <!-- Main Sidebar -->
    <div id="sidebar">
        <!-- Wrapper for scrolling functionality -->
        <div class="sidebar-scroll">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Logo -->
                <a href="/" class="sidebar-brand">
                    <i class="gi gi-stats"></i><strong>MX</strong> 15
                </a>
                <!-- END Logo -->

                <!-- User Info -->
                <div class="sidebar-section sidebar-user clearfix">
                    <div class="sidebar-user-avatar">
                        <a href="page_ready_user_profile.php">
                            <img src="{{asset('img/placeholders/avatars/avatar2.jpg')}}" alt="avatar">
                        </a>
                    </div>
                    <div class="sidebar-user-name">{{Session::get('name')}}</div>
                    <div class="sidebar-user-links">
                        <a href="{{ URL::route('user/profile') }}" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
                        <a href="page_ready_inbox.php" data-toggle="tooltip" data-placement="bottom" title="Messages"><i class="gi gi-envelope"></i></a>
                        <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.php in PHP version) -->
                        <a href="#modal-user-settings" data-toggle="modal" class="enable-tooltip" data-placement="bottom" title="Settings"><i class="gi gi-cogwheel"></i></a>
                        <a href="{{ URL::route("user/logout") }}" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
                    </div>
                </div>
                <!-- END User Info -->

               

                <!-- sidebarnav here-->

                <!-- Sidebar Notifications -->
                <div class="sidebar-header">
                    <span class="sidebar-header-options clearfix">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="Refresh"><i class="gi gi-refresh"></i></a>
                    </span>
                    <span class="sidebar-header-title">Activity</span>
                </div>
                <div class="sidebar-section">
                    <div class="alert alert-success alert-alt">
                        <small>5 min ago</small><br>
                        <i class="fa fa-thumbs-up fa-fw"></i> Your rank has increased
                    </div>
                   
                </div>
                <!-- END Sidebar Notifications -->
            </div>
            <!-- END Sidebar Content -->
        </div>
        <!-- END Wrapper for scrolling functionality -->
    </div>
    <!-- END Main Sidebar -->
@show
    <!-- Main Container -->
    <div id="main-container">
        <!-- Header -->
        <!-- START HEADER -->
         @include('layouts.partials.navbar')
        <!-- END Header -->
        @yield("content")

 @section('footer')
 <!-- Footer -->
        <footer class="clearfix">
            <div class="pull-right">
                Created by <a href="#">MX 15</a>
            </div>
            <div class="pull-left">
                <span id="year-copy"></span> &copy; 
            </div>
        </footer>
        <!-- END Footer -->
    </div>
    <!-- END Main Container -->
</div>
<!-- END Page Container -->

<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Settings</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="index.php" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
                    <fieldset>
                        <legend>Vital Info</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Username</label>
                            <div class="col-md-8">
                                <p class="form-control-static">Admin</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-email">Email</label>
                            <div class="col-md-8">
                                <input type="email" id="user-settings-email" name="user-settings-email" class="form-control" value="admin@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-notifications">Email Notifications</label>
                            <div class="col-md-8">
                                <label class="switch switch-primary">
                                    <input type="checkbox" id="user-settings-notifications" name="user-settings-notifications" value="1" checked>
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Password Update</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Please choose a complex one..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Confirm New Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="..and confirm it!">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<!-- END User Settings -->
      

<!-- Remember to include excanvas for IE8 chart support -->
<!--[if IE 8]><script src="{{ URL::asset('js/helpers/excanvas.min.js') }}"></script><![endif]-->


<!-- Bootstrap.js, Jquery plugins and Custom JS code -->
<script src="{{ URL::asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/plugins.js') }}"></script>
<script src="{{ URL::asset('js/app.js') }}"></script>
@yield('ticketfoot')
@show
        
    </body>
</html>