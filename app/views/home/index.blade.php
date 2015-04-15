@extends('index')
@section('content') 
<!-- Intro -->
<section class="site-section site-section-light site-section-top themed-background-flatie">
    <div class="container">
        <h1 class="text-center animation-slideDown"><i class="fa fa-flash"></i> <strong>Site Explorer</strong></h1>
        <h2 class="h3 text-center animation-slideUp push">Success with SEO</h2>
        <div class="text-center">
            {{ Form::open(array('url'=>'site-explorer', 'class'=>'form-signup')) }}
            <div id="middle-wizard">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="data-list">
                            <li>{{ Form::text('website', null, array('class'=>'required form-control', 'placeholder'=>'Enter a website..')) }}</li>
                        </ul>
                    </div><!-- END col-md-6 -->
                </div><!-- END row -->
                <div class="submit step" id="complete">
                    <i class="icon-check"></i>
                    <button type="submit" name="process" class="submit">Try it now!</button>
                </div><!-- END submit step -->

            </div><!-- END middle-wizard -->
            {{ Form::close() }}
        </div>
    </div>
</section>
<!-- END Intro -->

<!-- Promo #1 -->
            <section class="site-content site-section site-slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                            <img src="{{ URL::asset('img/promo.png') }}" alt="Research" class="img-responsive">
                        </div>
                        <div class="col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                            <h3 class="h2 site-heading site-heading-promo"><strong>Elegant</strong> SEO reports</h3>
                            <p class="promo-content">MX15 will insure you get the best possible SEO reports for you business.</p>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Promo #1 -->

            <!-- Promo #2 -->
            <section class="site-content site-section site-slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-5 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                            <h3 class="h2 site-heading site-heading-promo"><strong>Track</strong> your websites</h3>
                            <p class="promo-content">With MX15 you will be able to track your websites in our control panel. <a href="/clients">Learn More..</a></p>
                        </div>
                        <div class="col-sm-6 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                            <img src="{{ URL::asset('img/promo2.png') }}" alt="Track" class="img-responsive">
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Promo #2 -->

            <!-- Promo #3 -->
            <section class="site-content site-section site-slide-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInRight" data-element-offset="-180">
                            <img src="{{ URL::asset('img/promosupport.png') }}" alt="Support" class="img-responsive">
                        </div>
                        <div class="col-sm-6 col-md-5 col-md-offset-1 site-block visibility-none" data-toggle="animation-appear" data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                            <h3 class="h2 site-heading site-heading-promo"><strong>Excellent</strong> Support</h3>
                            <p class="promo-content">We offer full service support in case you have any issues with your SEO <a href="/support">Learn More..</a></p>
                        </div>
                    </div>
                    <hr>
                </div>
            </section>
            <!-- END Promo #3 -->

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
                        <img src="{{ URL::asset('img/avatar_round.png') }}" alt="Avatar" class="img-circle">
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

@stop
