@extends('support.layouts.default')

@section('ticket')


<!-- tabsgroup -->
<div class="block">

    <div class="block-title">

        <h4>Most Recent and Assigned Tickets<a href="{{ URL::route('tickets') }}" class="block-options pull-right" title="All Tickets" data-placement="bottom">{{ Helper::icon('list') }}</a></h4>

    </div>

    <!-- tabs -->
    <div class="tabbable">

        <ul class="nav nav-tabs">

            <li class="active"><a href="#latest" data-toggle="tab">Recent</a></li>
            <li><a href="#assigned" data-toggle="tab">Assigned <span class="badge badge-{{ $badge }}">{{ $assigned->total }}</span></a></li>

        </ul>

        <!-- tabcontent -->
        <div class="tab-content">

            <!-- latest -->
            <div class="tab-pane active" id="latest">

                @if (empty($latest->tickets))

                <div class="alert alert-info">

                    <p>There are no open tickets. Want to {{ HTML::link('support/ticket/add', 'create a new ticket') }}?</p>

                </div>

                @else

                <ul class="nav nav-tabs nav-stacked">

                    @foreach($latest->tickets as $ticket)

                    <li class="{{ $ticket->status }}">

                        <a href="{{ URL::to('support/ticket/' . $ticket->id) }}">
                            {{ $ticket->subject }} <span class="pull-right">{{ Helper::icon('chevron-right') }}</span><br />
                            <small class="muted">{{ $ticket->created_at }}</small>
                        </a>

                    </li>

                    @endforeach

                </ul>

                <small class="block-options pull-right"><strong>Tickets:</strong> {{ $total->amount }} — <strong>Open:</strong> {{ $total->open }}</small>

                @endif

            </div>
            <!-- end latest -->

            <!-- assigned -->
            <div class="tab-pane" id="assigned">

                @if (empty($assigned->tickets))

                <div class="alert alert-info">

                    No Tickets assigned to process

                </div>

                @else

                <ul class="nav nav-tabs nav-stacked">

                    @foreach($assigned->tickets as $ticket)

                    <li class="{{ $ticket->status }}">

                        <a href="{{ URL::to('support/ticket/' . $ticket->id) }}">
                            {{ $ticket->subject }} <span class="block-options pull-right">{{ Helper::icon('chevron-right') }}</span><br />
                            <small class="muted">{{ $ticket->created_at }}</small>
                        </a>

                    </li>

                    @endforeach

                </ul>

                @endif

                <small class="pull-right"><strong>Tickets Assigned:</strong> {{ $assigned->all }} — <strong>Open:</strong> {{ $assigned->open }}</small>

            </div>
            <!-- end assigned -->

        </div>
        <!-- end tabcontent -->

    </div>
    <!-- end tabs -->

</div>
<!-- end tabsgroup -->

<!-- graphs -->

<div class='block'>
    <div class="block-title">

        <h4>Statistics on recent activity <a href="#" class="btn pull-right" title="More Stats" data-placement="bottom">{{ Helper::icon('signal') }}</a></h4>

    </div>
    <div class="row">
        <div class="col-md-6" id="graph-week"></div>
        <div class="col-md-6" id="graph-people"></div>
    </div>
</div>
<!-- end graphs -->

@if ($show == true and !empty($alert->message))

<!-- system message modal -->
<div class="modal hide fade" id="system-message">

    @if (!empty($alert->title))

    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h3>{{ $alert->title}}</h3>

    </div>

    @else

    <br />

    @endif

    <div class="modal-body">

        {{ Markdown($alert->message) }}

    </div>

    <div class="modal-footer">

        <a href="#" class="btn" id="alert-close-forever">{{ Helper::icon('remove') }} Close and do not show again.</a>
        <a href="#" class="btn" id="alert-close">{{ Helper::icon('ok') }} Close</a>

    </div>

</div>
<!-- end system message modal -->

@endif

@stop

@section('prescripts')
<script src="http://code.highcharts.com/highcharts.js"></script>
@stop
@section('postscripts')

<script type="text/javascript">
    //var base = '@{{ app.url }}';
    // tickets in the last 7 days graph
    jQuery(document).ready(function() {
    $('#graph-week').highcharts({
    chart: {
    type: 'areaspline'
    },
            title: {
            text: 'Tickets in the last 7 days',
            },
            xAxis: {
            title: {
            text: 'Days',
                    margin: 20
            },
                    categories: {{ $week -> days }},
            },
            yAxis: {
            title: {
            text: 'Tickets'
            }
            },
            series: [{ // people and amount of tickets
            name: 'Tickets',
                    data: {{ $week -> tickets }}
            }],
            credits: {
            enabled: false
            },
            legend: {
            enabled: false
            }
    });
    });
            // total tickets by person graph
            jQuery(document).ready(function() {
    $('#graph-people').highcharts({
    chart: {
    type: 'bar'
    },
            title: {
            text: 'Total tickets for user',
            },
            xAxis: {
            title: {
            text: 'People',
            },
                    categories: {{ $tickets -> users }},
            },
            yAxis: {
            title: {
            text: 'Tickets',
                    margin: 20
            }
            },
            series: [{ // people and amount of tickets
            name: 'Tickets',
                    data: {{ $tickets -> total }}
            }],
            credits: {
            enabled: false
            },
            legend: {
            enabled: false
            }
    });
    });
            jQuery(document).ready(function () {
    $('#system-message').modal({show: true, backdrop: 'static'});
            $('#alert-close').on('click', function() {
    $('#system-message').modal('hide');
    });
            // set cookie that prevent this of being loaded again
            $('#alert-close-forever').on('click', function() {
    $.ajax({
    url:  '/support/dashboard/hide/alerts',
            type: 'POST',
            data: {
            hide: true
            },
            success: function() {
            $('#system-message').modal('hide');
            },
            dataType: 'json'
    });
    });
    });

</script>

@stop