@extends("clients")
@section("content")
<!-- Page content -->


<div id="page-content">
<!-- BEGIN MAIN CONTENT -->
<div class="page-title"><i class="icon-custom-left"></i>
    <h2>PROFILE
        <small>here you can update your info</small>
    </h2>
</div>
<div class="row">
<div class="col-md-12">

<?php
if (Auth::check()){
	$id = Auth::user()->getId();
}


if (isset($_POST['update'])) {
    $user = User::find($id);
    $user->firstname = $_POST['firstname'];
    $user->lastname = $_POST['lastname'];
    $user->email = $_POST['email'];
    $user->save();
    header("Refresh:0");
}
?>

<form method="POST" >
<?php echo Form::token(); ?>
<!-- BEGIN TABS -->
<div class="tabbable tabbable-custom form">
<div class="tab-content">
<div class="space20"></div>
<div class="tab-pane active" id="general_settings">
    <div class="row profile">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-unstyled profile-nav col-md-3">
                        <li>
                            <img src="{{  $avatar; }}" alt="avatar 4"/>
                        </li>
                    </ul>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12 profile-info">
                                <h1>{{  $name; }}</h1>
                                <div class="m-t-10"></div>
                                <div class="m-t-20"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!--<div class="alert alert-block alert-info fade in width-100p">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5>Your profile is visible by all users. <a href="#">Edit my parameters</a></h5>
                    </div>-->
                </div>
            </div>
            <div class="row profile-classic">
                <div class="col-md-12 m-t-20">
                    <div class="panel">
                        <div class="panel-title line">
                            <div class="caption">USER INFO</div>
                        </div>
                        <div class="panel-body">
						    <div class="row">
                                <div class="control-label c-gray col-md-3">First Name:</div>
                                <div class="col-md-6">
                                    <input type="text" name="firstname"  class="form-control" id="field-1" value="{{ $firstname; }}">
                                </div>
                            </div>
							<div class="row">
                                <div class="control-label c-gray col-md-3">Last Name:</div>
                                <div class="col-md-6">
                                    <input type="text" name="lastname"  class="form-control" id="field-1" value="{{ $lastname; }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="control-label c-gray col-md-3">Email:</div>
                                <div class="col-md-6">
                                    <input type="text" name="email" class="form-control" id="field-1" value="{{ $email; }}">
                                </div>
                            </div>
						
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="align-center">
                    <!--<button class="btn btn-primary m-r-20"> Change Contact Info </button>-->
					<input type="submit" class="btn btn-primary m-r-20" name="update" value = "UPDATE"/>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
</form>	
        </div>
    </div>
</div>
<!--<div class="tab-pane" id="email_settings">
    <p class="m-t-20">You will receive your notification here youremail@yahoo.fr <a href="#"><strong>Change my
                email</strong></a></p>

    <div class="m-t-10"></div>
    <table class="table">
        <thead>
        <tr>
            <th class="col-md-3"></th>
            <th class="col-md-3">
                <strong>INSTANTLY</strong><br/>
                <span>receive an email directly after update</span>
            </th>
            <th class="col-md-3"><strong>DAYLY</strong><br/>
                <span>receive one email by day with all updates</span>
            </th>
            <th class="col-md-3"><strong>NO EMAIL</strong><br/>
                <span>See updates only when I sign in.</span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="4"><strong>MESSAGES</strong></td>
        </tr>
        <tr>
            <td>My contacts</td>
            <td>
                <input type="radio" name="contacts" value="1" checked/>
            </td>
            <td>
                <input type="radio" name="contacts" value="2"/>
            </td>
            <td>
                <input type="radio" name="contacts" value="3"/>
            </td>
        </tr>
        <tr>
            <td>Other people</td>
            <td>
                <input type="radio" name="people" value="1"/>
            </td>
            <td>
                <input type="radio" name="people" value="2" checked/>
            </td>
            <td>
                <input type="radio" name="people" value="3"/>
            </td>
        </tr>
        <tr>
            <td>Smallads</td>
            <td>
                <input type="radio" name="smallads" value="1"/>
            </td>
            <td>
                <input type="radio" name="smallads" value="2" checked/>
            </td>
            <td>
                <input type="radio" name="smallads" value="3"/>
            </td>
        </tr>
        <tr>
            <td>News</td>
            <td>
                <input type="radio" name="news" value="1" checked/>
            </td>
            <td>
                <input type="radio" name="news" value="2"/>
            </td>
            <td>
                <input type="radio" name="news" value="3"/>
            </td>
        </tr>
        <tr>
            <td>Recommandations</td>
            <td>
                <input type="radio" name="recommandations" value="1"/>
            </td>
            <td>
                <input type="radio" name="recommandations" value="2"/>
            </td>
            <td>
                <input type="radio" name="recommandations" value="3" checked/>
            </td>
        </tr>
        <tr>
            <td>Important Alerts (<a href="#" class="c-blue">SMS</a>)</td>
            <td>
                <input type="radio" name="alerts" value="1" checked/>
            </td>
            <td>
                <input type="radio" name="alerts" value="2"/>
            </td>
            <td>
                <input type="radio" name="alerts" value="3"/>
            </td>
        </tr>
        <tr>
            <td>Messages sent by email</td>
            <td colspan="3">
                <label>
                    <input type="checkbox" checked>Send me a confirmation when I send an email.
                </label>
            </td>
        </tr>
        <tr>
            <td>Welcome message</td>
            <td colspan="3">
                <label>
                    <input type="checkbox" checked>Send a message when someone thanks me for my message.
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="4"><strong>MEMBERS</strong></td>
        </tr>
        <tr>
            <td>New members</td>
            <td colspan="3">
                <label>
                    <input type="checkbox" checked>Send me a confirmation when I send an email.
                </label>
            </td>
        </tr>
        <tr>
            <td>Contacts not verified</td>
            <td colspan="3">
                <label>
                    <input type="checkbox" checked>Send me a message.
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="4"><strong>PICTURES</strong></td>
        </tr>
        <tr>
            <td>New Pictures</td>
            <td>
                <input type="radio" name="pics" value="option1" checked/>
            </td>
            <td>
                <input type="radio" name="pics" value="option1"/>
            </td>
            <td>
                <input type="radio" name="pics" value="option1"/>
            </td>
        </tr>
        <tr>
            <td>Pictures from friends</td>
            <td colspan="3">
                <label>
                    <input type="checkbox" checked>Send me an email
                </label>
            </td>
        </tr>
        <tr>
            <td colspan="4"><strong>ANSWERS</strong></td>
        </tr>
        <tr>
            <td>New Answer from users</td>
            <td>
                <input type="radio" name="answers" value="1" checked/>
            </td>
            <td>
                <input type="radio" name="answers" value="2"/>
            </td>
            <td>
                <input type="radio" name="answers" value="3"/>
            </td>
        </tr>
        <tr>
            <td>Answer one of my message</td>
            <td colspan="3">
                <label>
                    <input type="checkbox" checked>Send me an email when someone answer one of my message.
                </label>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="row">

        <div class="col-sm-12">
            <div class="align-center m-t-20">
                <button class="btn btn-primary m-r-20">Validate</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>-->
</div>
</div>
<!--END TABS-->
</div>
</div>


</div>
<!-- END MAIN CONTENT -->
</div>
<!-- END Page Content -->
@stop