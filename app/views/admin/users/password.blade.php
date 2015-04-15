@extends('support.layouts.default')

@section('ticket')

<div class="row">

    <div class="col-md-12">
        <div class ='block'>
            <div class="block-title">

                <h4>Edit User</h4>

            </div>

            {{ Form::open(array('url'=>'admin/users/password/'. $id, 'method'=> 'POST', 'class' => 'form-horizontal form-bordered')) }}
            <div class="col-md-6">
                <!-- notifications -->
                {{ Notification::show() }}

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