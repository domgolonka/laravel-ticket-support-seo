@extends('support.layouts.default')

@section('ticket')

<div class="row">

    <div class="col-md-12">
        {{ Notification::show() }}
        <div class ='block'>
            <div class="block-title">

                <h4>New User</h4>

            </div>

            {{ Form::open(array('url'=>'admin/users/new', 'method'=> 'POST', 'class' => 'form-horizontal form-bordered')) }}
            <div class="col-md-6">
                <!-- notifications -->
                

                <!-- firstname -->
                <div class="form-group">

                    <label for="firstname" class="col-md-3 control-label">First Name</label>

                    <div class="col-md-3">

                        <input type="text" name="firstname" id="firstname" value="{{ Input::old('firstname') }}" />

                    </div>

                </div>
                <!-- end firstname -->

                <!-- lastname -->
                <div class="form-group">

                    <label for="lastname" class="col-md-3 control-label">Last Name</label>

                    <div class="col-md-3">

                        <input type="text" name="lastname" id="lastname" value="{{ Input::old('lastname') }}" />

                    </div>

                </div>
                <!-- end lastname -->

                <!-- email -->
                <div class="form-group">

                    <label for="email" class="col-md-3 control-label">Email</label>

                    <div class="col-md-3">

                        <input type="text" name="email" id="email" placeholder="user@mx15.com" value="{{ Input::old('email') }}" />
                        <span class="help-block"><small class="help-block">Must be a valid and active</small></span>

                    </div>

                </div>
                <!-- end email -->
            </div>
            <div class="col-md-6">
                <fieldset>



                    <!-- username -->
                    <div class="form-group">

                        <label for="username" class="col-md-3 control-label">Username</label>

                        <div class="col-md-3">

                            <input type="text" name="username" id="username" value="{{ Input::old('username') }}" />
                            <span class="help-block"><small class="help-block">It must be unique - this will log with</small></span>

                        </div>

                    </div>
                    <!-- end username -->

                    <!-- password -->
                    <div class="form-group">

                        <label for="password" class="col-md-3 control-label">Password</label>

                        <div class="col-md-3">

                            <input type="password" name="password" id="password" />

                        </div>

                    </div>
                    <!-- end password -->

                    <!-- repassword -->
                    <div class="form-group">

                        <label for="repassword" class="col-md-3 control-label">Confirm Password</label>

                        <div class="col-md-3">

                            <input type="password" name="repassword" id="repassword" />
                            <span class="help-block"><small class="help-block">The two passwords must match</small></span>

                        </div>

                    </div>
                    <!-- end repassword -->

            </div>

            </fieldset>
            <div class="form-group form-actions">

                <div class="col-md-8 col-md-offset-4">

                    <button type="submit" class="btn btn-success">{{ Helper::icon('plus') }} Create User</button>

                </div>

            </div>

            {{ Form::close() }}

        </div>
    </div>
</div>
<div class="table-responsive">
    <div class="block">

        <div class="block-title">

            <h4>Existing Users</h4>

        </div>

        <table class="table table-vcenter table-striped">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>User</th>
                    <th>Email</th>
                    <th>Changes</th>

                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstname . ' ' . $user->lastname }}<br /><small class="muted">{{ $user->username }}</small></td>
                    <td>{{ HTML::mailto($user->email) }}</td>
                    <td>
                        <div class="btn-group block center">
                            <a href="users/edit/{{ $user->id }}" class="btn" title="Edit">{{ Helper::icon('user') }}</a>
                            <a href="users/delete/{{ $user->id }}" class="btn" title="Delete">{{ Helper::icon('ban') }}</a>
                            <a href="users/password/{{ $user->id }}" class="btn" title="Change Password">{{ Helper::icon('key') }}</a>
                        </div>
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        {{ $users->links() }}

    </div>	

</div>

@stop

@section('postscripts')
<script src="{{ URL::asset('js/pages/bootbox.min.js') }}"></script>
@stop