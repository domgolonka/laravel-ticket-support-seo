<?php
namespace seoapi\Services;


use seoapi\Common\seoapiException as E;
use seoapi\seoapi as seoapi;
use seoapi\Config as Config;
use Helper as Helper;

class Thumbalizr extends seoapi {
    
    
    /**
     * Get a screenshot of the URL (we can switch it to page using the API config). It's set at 250px x 250px 
     * @return String
     */
    public static function getScreenshot($url = false)
    {
         if ('' == Config\ApiKeys::THUMBALIZR_API) {
            throw new E('In order to use the THUMBALIZR, you must obtain
                and set an API key first (see seoapi\Config\ApiKeys.php).');
            exit(0);
        }
        $url     = Helper\Url::parseWebsite(parent::getUrl($url));
        $domain =sprintf(Config\Services::THUMBALIZR_URL, $url, Config\ApiKeys::JSONWHOIS_API);

        //$imgTag = '<img src="%s"  alt="Screenshot for %s"/>';
		$imgTag = '<img src="'.$domain."\"  alt=Screenshot for \"".$url."\"/>";
            
        //return sprintf($imgTag,$domain,$url);
		
		$result = array("screenshot_url" => $imgTag);
        return $result;
        
    }

    
}