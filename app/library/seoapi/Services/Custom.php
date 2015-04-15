<?php
namespace seoapi\Services;


use seoapi\Common\seoapiException as E;
use seoapi\seoapi as seoapi;
use seoapi\Config as Config;

class Custom extends seoapi {
    
    /**
     * Checks if there is a sitemap.xml
     * @return Bool
     */
    public static function getSiteMap($url = false)
    {
        $url = parent::getUrl($url);
        $exists = self::remoteFileExists("$url/sitemap.xml");
        if($exists){
            return "Yes"; 
        }else{
            return "No";
        }
        
    }
    /**
     * Checks if there is a robots.txt
     * @return Bool
     */
    public static function getRobots($url = false)
    {
        $url = parent::getUrl($url);
        $exists = self::remoteFileExists("$url/robots.txt");
        if($exists){
            return "Yes";
        }else{
            return "No";
        }
        
    }
    
    /**
     * Checks for characters in the URL (example for underscore)
     * @params $url  The URL, checks for specific character
     * @return Bool
     */
    public static function getDomainChar($url = false, $char = '_')
    {
        $url = parent::getUrl($url); 
        $pos = strpos($url, $char);
        if($pos){
            return "Yes"; //needs to be changed
        }else{
            return "No";
        }
        
    }
    
    /**
     * Checks if the page passes the W3C markup validator
     * @return Bool
     */
    public static function getValidation($url = false)
    {
        $url = parent::getUrl($url);
        $request_url = "http://validator.w3.org/check?uri=" . $url;
        $headers = HttpRequest::getHeaders($request_url);
        
        if ($headers["X-W3c-Validator-Status"] == 'Valid'){
            return "Valid"; //needs to be changed
        }else{
            return "Not Valid";
        }
        
    }
    
    /**
     * Helper function
     */
    private static function remoteFileExists($url){
    $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        $result = curl_exec($curl);
        $ret = false;
        if ($result !== false) {
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);  
            if ($statusCode == 200) {
                $ret = true;   
            }
        }
        curl_close($curl);
        return $ret;
    }
}

