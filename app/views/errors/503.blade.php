@extends("errors")
<!-- Error Container -->
<div id="error-container">
    <div class="error-options">
        <h3><i class="fa fa-chevron-circle-left text-muted"></i> <a href="javascript: history.go(-1)">@lang('errors.go_back')</a></h3>
    </div>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <h1 class="animation-tossing"><i class="fa fa-bullhorn text-success"></i> 503</h1>
            <h2 class="h3">@lang('errors.503')</h2>
        </div>
        <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <form action="/clients/search" method="post">
                <input type="text" id="search-term" name="search-term" class="form-control input-lg" placeholder="Search">
            </form>
        </div>
    </div>
</div>
<!-- END Error Container -->
