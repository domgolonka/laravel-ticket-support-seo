<?php
namespace seoapi\Services;


use seoapi\Common\seoapiException as E;
use seoapi\seoapi as seoapi;
use seoapi\Config as Config;
use Helper as Helper;

class Mashable extends seoapi {
    
    
    /**
     * Get JsonWHois function using unirest-php
     * @return Array
     */
    public static function getJsonWhois($url = false)
    {
         if ('' == Config\ApiKeys::MASHABLE_API ||
            '' == Config\ApiKeys::JSONWHOIS_API) {
            throw new E('In order to use the MASHABLE & JSONWHOIS API, you must obtain
                and set an API key first (see seoapi\Config\ApiKeys.php).');
            exit(0);
        }
        $url     = Helper\Url::parseWebsite(parent::getUrl($url));
        // These code snippets use an open-source library. http://unirest.io/php
        $domain =sprintf(Config\Services::MASH_JSONWHOIS, Config\ApiKeys::JSONWHOIS_API,$url);
        $response = \Unirest::get($domain,
          array(
            "X-Mashape-Key" => Config\ApiKeys::MASHABLE_API
          )
        );
        return $response;
        
    }
     /**
     * Get Similar Websites from webpageanalyse
     * @return Array
     */
    public static function getSimilarWebsites($url = false)
    {
         if ('' == Config\ApiKeys::MASHABLE_API ) {
            throw new E('In order to use the MASHABLE & JSONWHOIS API, you must obtain
                and set an API key first (see seoapi\Config\ApiKeys.php).');
            exit(0);
        }
        $url     = Helper\Url::parseWebsite(parent::getUrl($url));
        $domain =sprintf(Config\Services::MASH_SIMILAR, $url,Config\ApiKeys::WEBPAGEANALYSE_API);
        $response = \Unirest::get($domain,
          array(
            "X-Mashape-Key" => Config\ApiKeys::MASHABLE_API
          )
        );
        return $response;
        
    }
    
     /**
     * Get Website category from webpageanalyse
     * @return Array
     */
    public static function getCategory($url = false)
    {
         if ('' == Config\ApiKeys::MASHABLE_API ) {
            throw new E('In order to use the MASHABLE & JSONWHOIS API, you must obtain
                and set an API key first (see seoapi\Config\ApiKeys.php).');
            exit(0);
        }
        $url     = Helper\Url::parseWebsite(parent::getUrl($url));
        $domain =sprintf(Config\Services::MASH_CATEGORY, $url,Config\ApiKeys::WEBPAGEANALYSE_API);
        $response = \Unirest::get($domain,
          array(
            "X-Mashape-Key" => Config\ApiKeys::MASHABLE_API
          )
        );
        return $response;
        
    }
     /**
     * Get Age, domain page rank, trust, IPv4, Ipv6, domainpopularity, WOT, country
     * @return Array
     */
    public static function getTrustDomain($url = false)
    {
         if ('' == Config\ApiKeys::MASHABLE_API ) {
            throw new E('In order to use the MASHABLE, you must obtain
                and set an API key first (see seoapi\Config\ApiKeys.php).');
            exit(0);
        }
        $url     = Helper\Url::parseWebsite(parent::getUrl($url));
        $domain =sprintf(Config\Services::MASH_TRUSTDOMAIN, $url);
        $response = \Unirest::get($domain,
          array(
            "X-Mashape-Key" => Config\ApiKeys::MASHABLE_API
          )
        );
        return $response;
        
    }
     /**
     * Get Website's technologies
     * @return Array
     */
    public static function getTech($url = false)
    {
         if ('' == Config\ApiKeys::MASHABLE_API ) {
            throw new E('In order to use the MASHABLE, you must obtain
                and set an API key first (see seoapi\Config\ApiKeys.php).');
            exit(0);
        }
        $url     = Helper\Url::parseWebsite(parent::getUrl($url));
        $domain =sprintf(Config\Services::MASH_TECH, $url);
        $response = \Unirest::get($domain,
          array(
            "X-Mashape-Key" => Config\ApiKeys::MASHABLE_API
          )
        );
        return $response;
        
    }
   
    
}