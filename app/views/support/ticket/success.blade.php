@extends('support.layouts.default')

@section('ticket')
<div id="page-content" style="min-height: 929px;">
    <!-- form div -->
    <div class="offset3 span6">

        <div class="page-header">

            <h4>Ticket Received</h4>

        </div>

        <p>Your ticket is the number of {{ HTML::link('support/ticket/' . $ticket->id, '#' . $ticket->id) }} —This is your identification number so you can follow it by the {{ HTML::link('support/tickets', 'listing') }}.</p>

        <p>You will receive notification in your email the moment it is answered.</p>

        <br />

        <!-- options -->
        <div class="btn-group pagination-centered">

            <a href="{{ URL::to('support/ticket/' . $ticket->id) }}" class="btn">{{ Helper::icon('mail-forward') }} Go to ticket</a>
            <a href="{{ URL::to('support/ticket/add') }}" class="btn">{{ Helper::icon('plus') }} Create another Ticket</a>
            <a href="{{ URL::to('support/tickets') }}" class="btn">{{ Helper::icon('reorder') }} Ticket List</a>
            <a href="{{ URL::to('support') }}" class="btn">{{ Helper::icon('home') }} Support Home</a>

        </div>
        <!-- end options -->

    </div>
</div>
@stop