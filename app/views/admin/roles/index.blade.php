@extends('support.layouts.default')

@section('ticket')
<!-- assign roles -->
<div class='row'>
    <div class="col-md-6">
        <div class="block">
            <div class="block-title">
                <h2>Assign Roles</h2>
            </div>
            {{ Form::open(array('url'=>'admin/roles/update', 'method'=> 'PUT', 'class' => 'form-horizontal form-bordered')) }}

            <!-- notifications -->
            {{ Notification::show() }}

            <div class="form-group">

                <label for="users" class="col-md-3 control-label">Assign in</label>

                <div class="col-md-9">

                    <select name="users[]" id="users" class="form-control input-xlarge" multiple>

                        @foreach ($users as $user)

                        <option value="{{ $user->id }}">{{ $user->firstname . ' ' . $user->lastname}}</option>

                        @endforeach

                    </select>

                </div>

            </div>

            <div class="form-group form-actions">

                <div class="col-md-9 col-md-offset-3">

                    <button type="submit" name="action" value="1" class="btn btn-warning">Administrators</button>
                    <button type="submit" name="action" value="2" class="btn">Technical Support</button>
                    <button type="submit" name="action" value="3" class="btn">User</button>

                </div>

            </div>

            {{ Form::close() }}

        </div>
        <!-- end assign roles -->
    </div>
    <div class="col-md-6">
        <!-- list roles -->
        <div class="block">
            <div class="block-title">
                <h2>Roles</h2>
            </div>
            <div class="tabbable">

                <ul class="nav nav-tabs">

                    <li class="active"><a href="#admins" data-toggle="tab">Administrators</a></li>
                    <li><a href="#tech" data-toggle="tab">Technical Support</a></li>
                    <li><a href="#regulars" data-toggle="tab">Users</a></li>

                </ul>

                <div class="tab-content">

                    <!-- admins -->
                    <div class="tab-pane active" id="admins">

                        <table class="table table-striped table-bordered table-hover">

                            @foreach ($admins as $admin)
                            <?php $u = $users[$admin->user_id] ?>
                            <tr>

                                <td>{{ HTML::mailto($u->email, $u->firstname . ' ' . $u->lastname) }}<br ><small class="muted">{{ $u->username }}</small></td>

                            </tr>

                            @endforeach

                        </table>

                    </div>
                    <!-- end admins -->

                    <!-- tech -->
                    <div class="tab-pane" id="tech">

                        <table class="table table-striped table-bordered table-condensed table-hover">

                            @foreach ($supports as $support)
                            <?php $u = $users[$support->user_id] ?>
                            <tr>

                                <td>{{ HTML::mailto($u->email, $u->firstname . ' ' . $u->lastname) }} <small class="muted">{{ $u->username }}</small></td>

                            </tr>

                            @endforeach

                        </table>

                    </div>
                    <!-- end tech -->

                    <!-- users -->
                    <div class="tab-pane" id="regulars">

                        <table class="table table-striped table-bordered table-condensed table-hover">

                            @foreach ($regulars as $regular)
                            <?php $u = $users[$regular->user_id] ?>
                            <tr>

                                <td>{{ HTML::mailto($u->email, $u->firstname . ' ' . $u->lastname) }} <small class="muted">{{ $u->username }}</small></td>

                            </tr>

                            @endforeach

                        </table>

                    </div>
                    <!-- end users -->

                </div>
                <!-- end tabcontent -->

            </div>
            <!-- end tabbable -->

        </div>
        <!-- end list roles -->
    </div>
</div>
@stop