<?php
namespace seoapi;

if (!ini_get('date.timezone') && function_exists('date_default_timezone_set')) {
    date_default_timezone_set('PST');
}

// Disable the Zend garabage collecter if PHP is greater than 5.4+.
if (version_compare(PHP_VERSION, '5.4', '>=') && gc_enabled()) {
    gc_disable();
}

require_once realpath(__DIR__ . '/Common/AutoLoader.php');

$loader = new \seoapi\Common\AutoLoader(__NAMESPACE__, dirname(__DIR__));

$loader->register();
