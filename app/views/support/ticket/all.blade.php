@extends('support.layouts.default')

@section('ticket')
	<!-- toolbar -->
        <div class='block'>
	<div class="btn-toolbar">

		{{-- for search form --}}
		{{ Form::open(array('route' =>'ticket/search', 'method' => 'PUT','id' => 'search-form')) }}

			<div class="btn-group">

				<a href="{{ URL::to($url . 'closed') }}" class="btn">{{ Helper::icon('ok') }} Closed</a>
				<a href="{{ URL::to($url . 'open') }}" class="btn">{{ Helper::icon('exclamation') }} Open</a>
				<a href="{{ URL::to($url . 'hold') }}" class="btn">{{ Helper::icon('time') }} Pending</a>
				<a href="{{ URL::to($url . 'in-progress') }}" class="btn">{{ Helper::icon('star-half-empty') }} In Process</a>
                                <a href="{{ URL::to($url) }}" class="btn">{{ Helper::icon('list') }} View all</a>
			</div>

			<div class="block-options pull-right">

				<input type="hidden" name="url" value="{{ $url }}" />
				<input type="text" name="value" value="" placeholder="Ticket #" />
				<button type="submit" class="btn btn-primary" name="type" value="id">{{ Helper::icon('search') }}</button>

			</div>

		{{ Form::close() }}

	</div>
        </div>
	<!-- end toolbar -->

	{{-- tickets found, create table --}}
	@if (!empty($tickets))
        <div class='block'>
		<!-- tickets -->
                <div class="table-responsive">
		<table class="table table-vcenter table-striped">

			<!-- tickets head row -->
			<thead>

				<tr>

					<th>#</th>
					<th>Tickets</th>
					<th>Reported By</th>
					<th>Assigned To</th>
					<th>Status</th>

				</tr>

			</thead>
			<!-- end tickets head row -->

			<!-- all found tickets -->
			<tbody>

				@foreach($tickets as $ticket)

					<?php 
						foreach($users as $user) {
							if ($user->id == $ticket->reported_by) {
								$reported = $user;
								$reported->name = $reported->firstname . ' ' . $reported->lastname;
							}
						}

						// to prevent conflicts with next loop
						unset($user);

						if (!empty($ticket->assigned_to)) {
							foreach($users as $user) {
								if ($user->id == $ticket->assigned_to) {
									$assigned = $user;
									$assigned->name = $assigned->firstname . ' ' . $assigned->lastname;
								}
							}
						} else {
								$assigned = new StdClass;
								$assigned->name = '<span class="muted">Nobody</span>';
						}

						// for consistency
						unset($user);

						switch($ticket->status) {
							case 'open':			$type = 'warning'; break;
							case 'hold':			$type = 'info'; break;
							case 'closed':			$type = ''; break;
							case 'in-progress':	$type = 'default'; break;
						}
					?>

					<!-- ticket row -->
					<tr class="{{ $type }}">

						<td>{{ $ticket->id }}</td>

						<td>

							<p>{{ HTML::link('support/ticket/' . $ticket->id, $ticket->subject) }}</p>
							<small><strong>Created:</strong>{{ $ticket->created_at }}</small><br />
							<small><strong>Last Updated:</strong> {{ $ticket->updated_at }}</small>

						</td>

						<td>@if (isset($reported->name)) {{$reported->name}} @endif</td>
						<td>@if (isset($assigned->name)) {{ $assigned->name }} @endif </td>
						<td>{{ Helper::status($ticket->status) }}</td>

					</tr>
					<!-- end ticket row -->
				@endforeach

			</tbody>
			<!-- end all tickets -->

		</table>
		<!-- end tickets table -->
                </div>
		{{ $tickets->links() }}

		{{-- if no tickets are found or they don't match any query --}}
		@else

			<div class="alert">

				<span class="block center">No tickets available</span>

			</div>

		@endif

</div>

@stop

@section('postscripts')

<script>

var form = $('#search-form');
var formAction = 'support/tickets/mine/';

$()

</script>
@stop