<?php
namespace seoapi\Config;


/**
 * Default client settings
 * @package    seoapi
 */
interface DefaultSettings
{
    const DEFAULT_NO_DATA = '0';

    const HTTP_HEADER_ACCEPT_LANGUAGE = 'en-us;q=0.8,en;q=0.3';


    // You can get any country from the database. We will be using CANADA (CA).
    const SEMRUSH_DB = 'ca';
}
