@extends('support.layouts.default')

@section('ticket')

<div class="row">

    <div class="col-md-12">
        <div class ='block'>
            
                            {{ Notification::show() }}
            <div class="block-title">

                <h4>Edit User</h4>

            </div>

            {{ Form::open(array('url'=>'admin/users/edit/'. $id, 'method'=> 'POST', 'class' => 'form-horizontal form-bordered')) }}
            <div class="col-md-6">
                <!-- notifications -->


                <!-- firstname -->
                <div class="form-group">

                    <label for="firstname" class="col-md-3 control-label">First Name</label>

                    <div class="col-md-3">

                        <input type="text" name="firstname" class="form-control"  value="{{ $user->firstname }}" />

                    </div>

                </div>
                <!-- end firstname -->

                <!-- lastname -->
                <div class="form-group">

                    <label for="lastname" class="col-md-3 control-label">Last Name</label>

                    <div class="col-md-3">

                        <input type="text" name="lastname" class="form-control"  value="{{ $user->lastname }}" />

                    </div>

                </div>
                <!-- end lastname -->

                <!-- email -->
                <div class="form-group">

                    <label for="email" class="col-md-3 control-label">Email</label>

                    <div class="col-md-3">

                        <input type="text" name="email" class="form-control"  placeholder="user@mx15.com" value="{{ $user->email }}" />
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

                            <input type="text" name="username" class="form-control"  value="{{ $user->username }}" />
                            <span class="help-block"><small class="help-block">It must be unique - this will log with</small></span>

                        </div>

                    </div>
                    <!-- end username -->
            </div>

            </fieldset>
            <div class="form-actions">

                <div class="btn-group">

                    <button type="submit" class="btn btn-success">{{ Helper::icon('plus') }} Update User</button>

                </div>

            </div>

            {{ Form::close() }}

        </div>
    </div>
</div>
@stop