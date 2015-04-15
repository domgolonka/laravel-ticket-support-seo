@extends('support.layouts.default')

@section('ticket')

<div class="content-header">
    <div class="header-section">
        <h4>General Options</h4>
    </div>
    <!-- notifications -->
    {{ Notification::show() }}

</div>

<!-- settings form -->
{{ Form::open(array('url'=>'support/settings', 'method'=>'PUT', 'class' => 'form-horizontal form-bordered')) }}
<div class="col-md-12">
    <!-- per page -->
    <div class="block">

        <label for="per_page" class="col-md-3 control-label">Results per page</label>

        <div class="col-md-9">

            <input type="text" name="per_page" id="per_page" class="form-control" value="{{ $setting->per_page }}" /><span class="help-inline"><strong>Default:</strong> 50</span>
            <span class="help-block">Number of hits that have each page listing and search</span>

        </div>

    </div>
    <!-- end per page -->
</div>
<div class="col-md-12">
    <!-- system message -->
    <div class="block">
        <div class="block-title">
            <h4>Message System</h4>

        </div>

        <!-- title -->
        <div class="form-group">

            <label for="system_message_title" class="col-md-3  control-label">Title</label>

            <div class="col-md-9">

                <input type="text" class="form-control" name="system_message_title" id="system_message_title" value="{{ $setting->system_message_title }}" />
                <span class="help-block"> Although this field is not necessary for the system message, it is recommended</span>

            </div>

        </div>
        <!-- end title -->
    </div>
</div>
<!-- content -->
<div class="form-group">

    <!-- no label in here -->
    <div class="col-md-12">
        <textarea name="system_message" id="wmd-input" cols="10" rows="10" class="form-control input-xlarge">{{ $setting->system_message }}</textarea><span class="help-block">This message will appear to all users on login</span>

    </div>

</div>
<!-- end system message -->
<!-- hax -->
<br />
<!-- end hax -->

<!-- form actions -->
<div class="form-actions">

    <button class="btn btn-primary">{{ Helper::icon('check-square-o') }} Update</button>

</div>
<!-- end form action -->
{{ Form::close() }}
<!-- end settings form -->

@stop