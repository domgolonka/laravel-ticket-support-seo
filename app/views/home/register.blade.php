@extends('index')
@section('content') 
<!-- Intro -->
<section class="site-section site-section-light site-section-top" id="top-area-register">
    @if(Session::has('success'))
    @else
    <div class="container">
        <h1 class="text-center animation-slideDown"><i class="fa fa-trophy"></i> <strong>Create your free account today!</strong></h1>
    </div>
    @endif
</section>
<!-- END Intro -->
<section class="container">
    <div id="survey_container">
        @if(Session::has('success'))
        <div id="top-wizard"></div>
        <div id="middle-wizard">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-lg-offset-3">
                    <h3 class="sub-header text-center"><strong>Thank you for registering with us!</strong></h3>
                    <p class="clearfix"><i class="fa fa-clock-o fa-5x text-danger pull-left animation-pulse"></i>You can now <span class="text-success"><strong>login</strong></span> to the control panel.</p>
                    <p>
                        <a href="/clients/login" class="btn btn-lg btn-success btn-block">Login Now</a>
                    </p>
                </div>
            </div>
        </div>
        <div id="bottom-wizard"></div>
        @else
        <div id="top-wizard">
            <strong>Progress <span id="location"></span></strong>
            <div id="progressbar"></div>
            <div class="shadow"></div>
        </div><!-- end top-wizard -->
        {{ Form::open(array('url'=>'clients/create', 'class'=>'form-signup')) }}
        <div id="middle-wizard">
            <div class="step">
                <div class="row">
                    @if( $errors->count() > 0 )
                    <div class="col-md-10">
                         <p><strong>The following errors have occurred:</strong></p>
                         <ul id="form-errors">
                             {{ $errors->first('email', '<li>:message</li>') }}
                             {{ $errors->first('firstname', '<li>:message</li>') }}
                             {{ $errors->first('lastname', '<li>:message</li>') }}
                             {{ $errors->first('country', '<li>:message</li>') }}
                             {{ $errors->first('password', '<li>:message</li>') }}
                             {{ $errors->first('language', '<li>:message</li>') }}
                             {{ $errors->first('question_1', '<li>:message</li>') }}
                             </ul>
                    </div>
                     @endif
                    <h3 class="col-md-10">Enter your personal info</h3>

                    <div class="col-md-6">
                        <ul class="data-list">
                            <li>{{ Form::text('firstname', null, array('class'=>'required form-control', 'placeholder'=>'First Name')) }}</li>
                            <li>{{ Form::text('lastname', null, array('class'=>'required form-control', 'placeholder'=>'Last Name')) }}</li>
                            <li>{{ Form::text('email', null, array('class'=>'required form-control', 'placeholder'=>'Email Address')) }}</li>

                        </ul>
                    </div><!-- end col-md-6 -->

                    <div class="col-md-6">

                        <ul class="data-list">
                            <li>
                                <div class="styled-select">
                                    {{ Form::select('country', $countries , Input::old('country'),array('class'=>'required form-control')) }}
                                </div>
                            </li>
                        </ul>

                        <ul class="data-list">
                            <li>
                                <div class="styled-select">
                                    {{ Form::select('language',  array('de'=>'German','en' => 'English', 'es' => 'Spanish'), 'en',array('class'=>'required form-control')) }}
                                </div>
                            </li>
                        </ul>



                    </div><!-- end col-md-6 -->
                </div><!-- end row -->

                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <ul class="data-list" id="terms">
                            <li>
                                <strong>Do you accept {{link_to('/terms-conditions', 'terms and conditions') }} ?</strong>
                                <label class="switch-light switch-ios ">
                                    <input type="checkbox" name="terms" class="required fix_ie8" value="yes">
                                    <span>
                                        <span class="ie8_hide">No</span>
                                        <span>Yes</span>
                                    </span>
                                    <a></a>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>

            </div><!-- end step-->

            <div class="step row">
                <h3 class="col-md-10">Please enter a Username and Password</h3>
                <div class="col-md-6">
                    <ul class="data-list">
                        <li>{{ Form::text('username', null, array('class'=>'required form-control', 'placeholder'=>'Username')) }}</li>
                        <li>{{ Form::password('password', array('class'=>'required form-control', 'placeholder'=>'Password')) }}</li>
                        <li>{{ Form::password('password_confirmation', array('class'=>'required form-control', 'placeholder'=>'Confirm Password')) }}</li>
                    </ul>
                </div><!-- end col-md-6 -->
                <div class="col-md-6">
                    <ul class="data-list">
                        <li><p class="tip">The Username must be between 4-15 characters.</p></li>
                        <li><br /><br /></li>
                        <li><p class="tip">The Password must be between 6-20 characters.</p></li>
                    </ul>
                </div><!-- end col-md-6 -->
            </div><!-- end step -->

            <div class="step row">
                <div class="col-md-10">
                    <h3>How did you hear about MX15?</h3>
                    <ul class="data-list-2">
                        <li><input name="question_1[]" type="checkbox" class="required check_radio" value="Google"><label>Google</label></li>
                        <li><input name="question_1[]" type="checkbox" class="required check_radio" value="Friend"><label>A friend of mine</label></li>
                        <li><input name="question_1[]" type="checkbox" class="required check_radio" value="Forum"><label>Forum</label></li>
                        <li><input name="question_1[]" type="checkbox" class="required check_radio" value="Blog"><label>Blog</label></li>
                        <li><input name="question_1[]" type="checkbox" class="required check_radio" value="Other"><label>Other</label></li>
                    </ul>
                </div>
            </div><!-- end step -->

            <div class="submit step" id="complete">
                <i class="icon-check"></i>
                <h3>Thank you for registering. An email will be sent shortly after registration.</h3>
                <button type="submit" name="process" class="submit">Register Now</button>
            </div><!-- end submit step -->

        </div><!-- end middle-wizard -->

        <div id="bottom-wizard">
            <button type="button" name="backward" class="backward">Backward</button>
            <button type="button" name="forward" class="forward">Forward </button>
        </div><!-- end bottom-wizard -->
        {{ Form::close() }}
        @endif
    </div><!-- end form container -->
</section>


<!-- Testimonials -->
<section class="site-content site-section">
    <div class="container">
        <!-- Testimonials Carousel -->
        <div id="testimonials-carousel" class="carousel slide carousel-html" data-ride="carousel" data-interval="4000">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#testimonials-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#testimonials-carousel" data-slide-to="1"></li>
                <li data-target="#testimonials-carousel" data-slide-to="2"></li>
                <li data-target="#testimonials-carousel" data-slide-to="3"></li>
            </ol>
            <!-- END Indicators -->

            <!-- Wrapper for slides -->
            <div class="carousel-inner text-center">
                <div class="active item">
                    <p>
                        <img src="{{ URL::asset('img/avatar_round.png') }}" alt="Avatar" class="img-circle">
                    </p>
                    <blockquote class="no-symbol">
                        <p>I gained 100% traffic!</p>
                        <footer><strong>Farzin Fakhraei</strong>, google.com</footer>
                    </blockquote>
                </div>
                <div class="item">
                    <p>
                        <img src="{{ URL::asset('img/avatar_round.png') }}" alt="Avatar" class="img-circle">
                    </p>
                    <blockquote class="no-symbol">
                        <p>Never has my website been so active!</p>
                        <footer><strong>John Zwiep</strong>, yahoo.com</footer>
                    </blockquote>
                </div>
                <div class="item">
                    <p>
                        <img src="{{ URL::asset('img/avatar_round.png') }}" alt="Avatar" class="img-circle">
                    </p>
                    <blockquote class="no-symbol">
                        <p>I boosted my sales up 1000%</p>
                        <footer><strong>Erik Ross</strong>, example.com</footer>
                    </blockquote>
                </div>
                <div class="item">
                    <p>
                        <img src="{{ URL::asset('img/avatar_round.png') }}"" alt="Avatar" class="img-circle">
                    </p>
                    <blockquote class="no-symbol">
                        <p>It saved my life!</p>
                        <footer><strong>Duy Vo</strong>, sfu.ca</footer>
                    </blockquote>
                </div>
            </div>
            <!-- END Wrapper for slides -->
        </div>
        <!-- END Testimonials Carousel -->
    </div>
</section>
<!-- END Testimonials -->

@section('prescripts')          
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
<script src="{{ URL::asset('js/pages/jquery.wizard.js') }}"></script>
@stop
@section('postscripts')
<!-- Load and execute javascript code used only in this page -->
<script src="{{ URL::asset('js/pages/register.js') }}"></script>
@stop
@section('poststyle')
<link rel="stylesheet" href="{{ URL::asset('css/pages/front/jquery.switch.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/pages/front/aero.css') }}">
@stop



@stop