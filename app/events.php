<?php

Event::listen('auth.login', function($user)
{
    $user->lastlogin = new DateTime;
    $user->ip = Request::getClientIp();
    $user->host =  gethostname();
    $user->save();
});