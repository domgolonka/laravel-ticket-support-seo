@extends('support.layouts.default')

@section('ticket')
<div id="page-content" style="min-height: 929px;">
    <div class="page-header">

        <h4>New Ticket</h4>

    </div>

    <!-- form div -->
    <div class="span7">

        <!-- notification -->
        {{ Notification::show() }}

        <!-- form -->
        {{ Form::open(array('url'=>'support/ticket/add','method'=>'POST','class' => 'form-horizontal form-bordered', 'files'=> false)) }}
        <div class="block">
        <!-- department -->
        <div class="form-group">

            <label for="department" class="col-md-3 control-label">Departments</label>
            <div class="col-md-9">

                <select name="department" id="department" class="form-control">

                    {{ Fields::departments() }}

                </select>

            </div>

        </div>
        <!-- end department -->

        <!-- assign -->
        <div class="form-group">
            <label for="assign" class="col-md-3 control-label">Assign to</label>
            <div class="col-md-9">

                <select name="assign" id="assign" class="form-control">

                    {{ Fields::members() }}

                </select>

            </div>

        </div>
        <!-- end assign -->
        </div>
        <!-- subject -->
        <div class="form-group">
            <label for="subject" class="col-md-3 control-label">Subject</label>

            <div class="col-md-9">

                <input type="text" name="subject" id="subject" class="form-control" /><span class="help-block">Briefly describe your issue.</span>

            </div>

        </div>
        <!-- end subject -->

        <!-- content -->
        <div class="form-group">


                <!-- no label in here -->
                <div class="col-md-12">

                    <textarea name="content" id="wmd-input" rows="20" class="form-control input-xlarge" placeholder="Content.."></textarea>
                    <span class="help-block">Indicate the issue presented, the more details the better.</span>

                </div>

        </div>
        <!-- end content -->



        <div class="form-actions">

            <button class="btn btn-primary submit">{{ Helper::icon('plus') }} New Ticket</button>

        </div>

        {{ Form::close() }}
        <!-- end form -->

    </div>
    <!-- end form div -->

    <!-- help text -->
    <div class="span4">

        <h3>User Information</h3>

        <p>To improve the response time, please ensure:</p>

        <ul>

            <li>Make sure you select the right department  </ li>
            <li>Write clearly what needs to be done </ li>
            <li>Provide as much information as possible </ li>

        </ul>
        <p>Following these steps will significantly improve the response time.</p>
        <br />
        <h4>Have you reported this problem before?</h4>

        <p>If continuing a previously opened a ticket, or want to add more information, {{ HTML::link('support/tickets', 'reopen') }} your ticket.</p>

    </div>
</div>
@stop