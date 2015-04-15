@extends('support.layouts.default')

@section('ticket')

<div class="row">

    <div class="block">

        <div class="block-title">

            <h2>Departments</h2>

        </div>

        <!-- notifications -->
        {{ Notification::show() }}

        <!-- new department -->
        {{ Form::open(array('url'=>'admin/departments/add', 'method'=>'POST', 'class' => 'form-horizontal form-bordered')) }}

        <div class="form-group">

            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" id="example-input2-group2" name="department" class="form-control" placeholder="New Department" >
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary">Submit</button>
                    </span>
                </div>
            </div>
        </div>

        {{ Form::close() }}

        <div class="tabbable">

            <ul class="nav nav-tabs">

                @foreach($departments as $department)

                <li><a class="active"></a><a href="#{{ $department->id }}" data-toggle="tab">{{ $department->name }}</a></li>
                @endforeach
            </ul>


            <div class="tab-content">
                @foreach($departments as $department)
                <!-- admins -->
                <div class="tab-pane active" id="{{ $department->id }}">

                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td><small class="muted"><strong>Members:</strong> {{ $members[$department->id] }}</small></td>
                        </tr>


                    </table>
                </div>
                @endforeach
            </div>


        </div>

    </div>

    <div class="span8">

        <div class="page-header">

            <h4>Modify Users</h4>

        </div>

        {{ Form::open(array('url'=>'admin/departments/update/users', 'method'=> 'PUT', 'class' => 'form-horizontal')) }}

        <!-- departments to add users -->
        <div class="form-group">

            <label for="to" class="col-md-3 control-label">Assing Department</label>

            <div class="col-md-9">

                <select id="to" name="to" class="form-control" size="5" multiple>

                    @foreach($departments as $department) 

                    <option value="{{ $department->id }}">{{ $department->name }}</option>

                    @endforeach

                </select>

            </div>

        </div>
        <!-- end companies -->

        <!-- users -->
        <div class="form-group">

            <label for="users" class="col-md-3 control-label">To these users</label>

            <div class="col-md-9">

                <select id="users" name="users[]" class="form-control" size="5" multiple>

                    @foreach($users as $user) 

                    <option value="{{ $user->id }}">
                        {{ $user->firstname . ' ' . $user->lastname }}
                    </option>

                    @endforeach

                </select>
                <span class="help-block"><small class="muted"><strong>Notice:</strong> They overwrite all assignments to departments</small></span>

            </div>

        </div>
        <!-- end users -->

        <div class="form-actions">
            <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-sm btn-warning">Add {{ Helper::icon('plus') }}</button>
            </div>
        </div>

        {{ Form::close() }}

    </div>

</div>

@stop