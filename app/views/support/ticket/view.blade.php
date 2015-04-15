@extends('support.layouts.default')

@section('ticket')
<!-- initial thread -->
<div class="block">

    <!-- notification -->
    {{ Notification::show() }}

    <!-- opening message -->

    <!-- ticket status -->
    {{ Form::open(array('url'=>'support/ticket/status/' . $ticket->id,'method'=> 'PUT', 'class' => 'form-status pull-right')) }}

    <div class="btn-group">

        <button class="btn btn-small" name="status" value="closed" title="Ok">{{ Helper::icon('check-square-o') }}</button>
        <button class="btn btn-small" name="status" value="open" title="Refresh">{{ Helper::icon('refresh') }}</button>
        <button class="btn btn-small" name="status" value="hold" title="Pending">{{ Helper::icon('clock-o') }}</button>
        <button class="btn btn-small" name="status" value="in-progress" title="In Process">{{ Helper::icon('star-half-empty') }}</button>

    </div>

    <!-- update this ticket -->
    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

    {{ Form::close() }}

    <!-- subject -->
    <h5>{{ $ticket->subject }}</h5>

    <!-- reporter details -->
    <p>{{ HTML::mailto($reporter->email, $reporter->fullname) }} • <small>{{ $ticket->created_at }}</small></p>

    <!-- separation of info -->
    <br />

    <!-- ticket content -->
    {{ Markdown($ticket->content) }}

    <!-- separation of metadata -->
    <br />

    <!-- metadata -->
    <p class="pull-left"><small><strong>Department:</strong> {{ $department->name }}

            @if (!empty($ticket->assigned))

            <br /><strong>Assign to:</strong> {{ $assigned->firstname . ' ' . $assigned->lastname }}

            @endif

        </small></p>

    <p class="pull-right"><small><strong>Status:</strong> {{ Helper::status($ticket->status) }}</small></p>

    <!-- separate from form -->
    <br />
    <br />
    <br />

    <fieldset>

        <legend>Update Ticket</legend>

        <!-- form -->
        {{ Form::open(array('url'=>'support/ticket/update/' . $ticket->id,'method'=> 'POST', 'files' => false)) }}

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

            <label for="assign" class="col-md-3 control-label">Assign in</label>

            <div class="col-md-9">

                <select name="assign" id="assign" class="form-control">

                    {{ Fields::members() }}

                </select>

                <span class="help-block">If you assign a specialist, you are not notified to the department</span>

            </div>

        </div>
        <!-- end assign -->

        <!-- content -->
        <div class="col-xs-12">

            <div class="form-group">

                <!-- no label in here -->
                <br />

                <div id="wmd-button-bar"></div>

                <div class="controls">

                    <textarea name="content" id="wmd-input" rows="10" class="form-control input-xlarge"></textarea>

                </div>

            </div>

        </div>
        <!-- end content -->

        <!-- status -->
        <div class="form-group">

            <label for="status">Status</label>

            <div class="controls">

                <select name="status" class="input-large" id="">

                    <option value="closed" @if ($ticket->status=="closed") selected @endif>Closed</option>
                    <option value="open"@if ($ticket->status==="open") selected @endif>Open</option>
                    <option value="hold"@if ($ticket->status=="hold") selected @endif>Pending</option>
                    <option value="in-progress"@if ($ticket->status=="in-progress") selected @endif>In Process</option>
                    
                </select>

            </div>

        </div>
        <!-- end status -->
        <!-- separation from the last field -->
        <br />

        <div class="f-group">

            <button class="btn btn-primary">{{ Helper::icon('reply') }} Reply</button>

        </div>

        <!-- additional information -->
        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}" />

        {{ Form::close() }}
        <!-- end form -->

    </fieldset>

</div>
<!-- end initial thread -->

<!-- responses -->
<div class="span6 offset1">

    <div class="tabbable">

        <ul class="nav nav-tabs nav-tabs-google">

            <li class="active"><a href="#messages" data-toggle="tab">{{ Helper::icon('comments-alt') }} Posts</a></li>

        </ul>

    </div>

    <div class="tab-content">

        <div class="tab-pane active" id="messages">

            @if (empty($messages))

            <div class="alert">

                <span class="block center">There are no answers to the ticket registered</span>

            </div>

            @else

            <?php
            // @TODO: optimize for users — WHEN I'M DONE
            foreach ($messages as $message):
                $sender = User::find($message->user_id);
                $sender->fullname = $sender->firstname . ' ' . $sender->lastname;
                ?>

                {{ HTML::mailto($sender->email, $sender->fullname) }} • <small>{{ $message->created_at }}</small>

                {{ Markdown($message->content) }}

                <hr />

                <?php
            endforeach;
            ?>

            @endif

        </div>


    </div>

</div>
<!-- end responses -->

@stop

@section('postscripts')


@stop