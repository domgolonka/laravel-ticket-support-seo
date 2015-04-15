<header class="navbar {{Session::get('navbar')}}">
            <?php if ( Session::get('header_content') == 'horizontal-menu' ) {  ?>
            <!-- Navbar Header -->
            <div class="navbar-header">
                
                <ul class="nav navbar-nav-custom pull-right visible-xs">
                    <li>
                        <a href="javascript:void(0)" data-toggle="collapse" data-target="#horizontal-menu-collapse">Menu</a> 
                    </li>
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt');">
                            <i class="gi gi-share_alt"></i>
                            <span class="label label-primary label-indicator animation-floating">4</span>
                        </a>
                    </li>
                </ul>
                <!-- END Horizontal Menu Toggle + Alternative Sidebar Toggle Button -->

                <!-- Main Sidebar Toggle Button -->
                <ul class="nav navbar-nav-custom">
                    <li>
                        <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                            <i class="fa fa-bars fa-fw"></i>
                        </a>
                    </li>
                </ul>
                <!-- END Main Sidebar Toggle Button -->
            </div>
            <!-- END Navbar Header -->

            <!-- Alternative Sidebar Toggle Button, Visible only in large screens (> 767px) --> 
            <ul class="nav navbar-nav-custom pull-right hidden-xs">
                <li>
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt', 'toggle-other');">
                        <i class="gi gi-share_alt"></i>
                        <span class="label label-primary label-indicator animation-floating">4</span>
                    </a>
                </li>
            </ul>
            <!-- END Alternative Sidebar Toggle Button -->

            <!-- Horizontal Menu + Search -->
            <div id="horizontal-menu-collapse" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="javascript:void(0)">Home</a>
                    </li>
			        <li>
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Profile</a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Settings <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="fa fa-asterisk fa-fw pull-right"></i> General</a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-lock fa-fw pull-right"></i> Security</a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-user fa-fw pull-right"></i> Account</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-submenu">
                                <a href="javascript:void(0)" tabindex="-1"><i class="fa fa-chevron-right fa-fw pull-right"></i> More Settings</a>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0)" tabindex="-1">Second level MX 15</a></li>
                                    <li><a href="javascript:void(0)">Second level MX 15</a></li>
                                    <li><a href="javascript:void(0)">Second level MX 15</a></li>
                                    <li class="divider"></li>
                                    <li class="dropdown-submenu">
                                        <a href="javascript:void(0)" tabindex="-1"><i class="fa fa-chevron-right fa-fw pull-right"></i> More Settings</a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:void(0)">Third level MX 15</a></li>
                                            <li><a href="javascript:void(0)">Third level MX 15 </a></li>
                                            <li><a href="javascript:void(0)">Third level MX 15</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <form action="page_ready_search_results.php" class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search..">
                    </div>
                </form>
            </div>
            <!-- END Horizontal Menu + Search -->
            <?php } else { // Default Header Content  ?>
            <!-- Left Header Navigation -->
            <ul class="nav navbar-nav-custom">
                <!-- Main Sidebar Toggle Button -->
                <li>
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');">
                        <i class="fa fa-bars fa-fw"></i>
                    </a>
                </li>
                <!-- END Main Sidebar Toggle Button -->

                <!-- Template Options -->
                <!-- Change Options functionality can be found in js/app.js - templateOptions() -->
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="gi gi-settings"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-custom dropdown-options">
                        <li class="dropdown-header text-center">Header Style</li>
                        <li>
                            <div class="btn-group btn-group-justified btn-group-sm">
                                <a href="javascript:void(0)" class="btn btn-primary" id="options-header-default">Light</a>
                                <a href="javascript:void(0)" class="btn btn-primary" id="options-header-inverse">Dark</a>
                            </div>
                        </li>
                        <li class="dropdown-header text-center">Page Style</li>
                        <li>
                            <div class="btn-group btn-group-justified btn-group-sm">
                                <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style">Default</a>
                                <a href="javascript:void(0)" class="btn btn-primary" id="options-main-style-alt">Alternative</a>
                            </div>
                        </li>
                        <li class="dropdown-header text-center">Main Layout</li>
                        <li>
                            <button class="btn btn-sm btn-block btn-primary" id="options-header-top">Fixed Side/Header (Top)</button>
                            <button class="btn btn-sm btn-block btn-primary" id="options-header-bottom">Fixed Side/Header (Bottom)</button>
                        </li>
                        <li class="dropdown-header text-center">Footer</li>
                        <li>
                            <div class="btn-group btn-group-justified btn-group-sm">
                                <a href="javascript:void(0)" class="btn btn-primary" id="options-footer-static">Default</a>
                                <a href="javascript:void(0)" class="btn btn-primary" id="options-footer-fixed">Fixed</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- END Template Options -->
            </ul>
            <!-- END Left Header Navigation -->

            <!-- Search Form -->
            <form action="page_ready_search_results.php" method="post" class="navbar-form-custom" role="search">
                <div class="form-group">
                    <input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
                </div>
            </form>
            <!-- END Search Form -->

            <!-- Right Header Navigation -->
            <ul class="nav navbar-nav-custom pull-right">
                <!-- Alternative Sidebar Toggle Button -->
                <li>
                    <!-- If you do not want the main sidebar to open when the alternative sidebar is closed, just remove the second parameter: App.sidebar('toggle-sidebar-alt'); -->
                    <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar-alt', 'toggle-other');">
                        <i class="gi gi-share_alt"></i>
                        <span class="label label-primary label-indicator animation-floating">4</span>
                    </a>
                </li>
                <!-- END Alternative Sidebar Toggle Button -->

                <!-- User Dropdown -->
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('img/avatar2.jpg')}}" alt="avatar"> <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                        <li class="dropdown-header text-center">Account</li>
                        <li>
                            <a href="clients/updates">
                                <i class="fa fa-clock-o fa-fw pull-right"></i>
                                <span class="badge pull-right">10</span>
                                Even Updates
                            </a>
                            <a href="clients/messages">
                                <i class="fa fa-envelope-o fa-fw pull-right"></i>
                                <span class="badge pull-right">5</span>
                                Notifications
                            </a>
                            <a href="clients/research">
                                <!-- change this to url route later??????? -->
                                <i class="fa fa-bar-chart-o fa-fw pull-right"></i>
                                Research
                            </a>

                            <a href="clients/faq"><i class="fa fa-question fa-fw pull-right"></i>
                                <span class="badge pull-right">11</span>
                                FAQ
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ URL::route('user/profile') }}">
                                <i class="fa fa-user fa-fw pull-right"></i>
                                Profile
                            </a>
                            <!-- Opens the user settings modal that can be found at the bottom of each page (page_footer.php in PHP version) -->
                            <a href="#modal-user-settings" data-toggle="modal">
                                <i class="fa fa-cog fa-fw pull-right"></i>
                                Settings
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="clients/lockscreen"><i class="fa fa-lock fa-fw pull-right"></i> Lock Account</a>
                            <a href="clients/logout"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                        </li>
                        <li class="dropdown-header text-center">Activity</li>
                        <li>
                            <div class="alert alert-warning alert-alt">
                                <small>3 hours ago</small><br>
                                <i class="fa fa-exclamation fa-fw"></i> Your website increased it viewers by <br><strong>100%</strong> 
                            </div>
                            <div class="alert alert-danger alert-alt">
                                <small>Yesterday</small><br>
                                <i class="fa fa-bug fa-fw"></i> <a href="javascript:void(0)" class="alert-link">New bug submitted</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- END User Dropdown -->
            </ul>
            <!-- END Right Header Navigation -->
            <?php } ?>
        </header>
