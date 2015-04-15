@extends("clients")
@section("content")
<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <div class="content-header content-header-media">
        <div class="header-section">
            <div class="row">
				<h1>Welcome <strong>{{$firstname}}</strong><br><small>To the client dashboard</small></h1>
            </div>
				<div class="row">
				@if (!is_null($maxEntry) && $maxEntry != $minEntry)
					<h3>Your all time top score is <?php echo(floor(json_decode($maxEntry['site_info'], true)['score'])) ?>
						from <?php echo $maxEntry['site_url'] ?></h3>
					<h5>Query was made at <?php echo json_decode($maxEntry['site_info'], true)['lastUpdated'] ?></h5>
					
					<h3>Your all time low score is <?php echo(floor(json_decode($minEntry['site_info'], true)['score'])) ?>
						from <?php echo $minEntry['site_url'] ?></h3>
					<h5>Query was made at <?php echo json_decode($minEntry['site_info'], true)['lastUpdated'] ?></h5>
				@elseif (!is_null($maxEntry) && $maxEntry == $minEntry)
					<h3>Your only query's score is <?php echo(floor(json_decode($maxEntry['site_info'], true)['score'])) ?>
						from <?php echo $maxEntry['site_url'] ?></h3>
					<h5>Query was made at <?php echo json_decode($maxEntry['site_info'], true)['lastUpdated'] ?></h5>
					
					<h3>Make more queries to see the top and bottom scores displayed here</h3>
				@else
					<h3>You currently have no queries! Make some searches and your top scores will be displayed here</h3>
				@endif
				</div>
			</div>
        </div>
    </div>
    <!-- END Dashboard Header -->
<script src="{{ URL::asset('js/pages/index.js') }}"></script>
<script>$(function() {
    Index.init();
});</script>
@stop