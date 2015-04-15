@extends("clients")
@section('tickethead')
{{ HTML::style('css/support/select.css'); }}
@stop


@section('ticketfoot')
{{ HTML::script('js/charts/highcharts.js');}}
{{ HTML::script('js/charts/highcharts-more.js');}}
{{ HTML::script('js/functions.js');}}
{{ HTML::script('js/holder.js');}}
{{ HTML::script('js/select.js');}}
@stop
@section("content")
<div id="page-content" style="min-height: 929px;">		
    <div id="wrap">

        <!-- navbar -->
        <div class='block'>
            <div class="collapse navbar-collapse">
                <div class="navbar navbar-nav">

                    <div class="navbar-inner">

                        <div class="container">



                            <ul class="nav navbar-nav">

                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tickets <b class="caret"></b></a>

                                    <ul class="dropdown-menu">

                                        <li>{{ HTML::link('support/ticket/add', 'New Ticket') }}</li>
                                        <li>{{ HTML::link('support/tickets/mine', 'My Tickets') }}</li>

                                        @if (Session::get('role') != 3)

                                        <li>{{ HTML::link('support/tickets/assigned', 'Assigned Tickets') }}</li>

                                        @endif

                                    </ul>

                                </li>

                                <li class="divider-vertical"></li>


                            </ul>



                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- navbar end -->

        <!-- container -->


        @yield('ticket')

        <!-- container end -->

        <div id="push"></div>

    </div>
</div>



@yield('postscripts')

@stop