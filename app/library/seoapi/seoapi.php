<?php
namespace seoapi;

use seoapi\Common\seoapiException as E;
use seoapi\Config as Config;
use Helper as Helper;
use seoapi\Services as Service;


class seoapi
{

    protected static $_url,
                     $_host,
                     $_lastHtml,
                     $_lastLoadedUrl
                     = false;

    public function __construct($url = false)
    {
        if (false !== $url) {
            self::setUrl($url);
        }
    }

    public function Custom()
    {
        return new Service\Custom;
    }

    public function Mashable()
    {
        return new Service\Mashable;
    }

    public function Mozscape()
    {
        return new Service\Mozscape;
    }
        
    public function Thumbalizr()
    {
        return new Service\Thumbalizr;
    }
    public function SEMRush()
    {
        return new Service\SemRush;
    }

    public function Social()
    {
        return new Service\Social;
    }

    public static function getLastLoadedHtml()
    {
        return self::$_lastHtml;
    }

    public static function getLastLoadedUrl()
    {
        return self::$_lastLoadedUrl;
    }

    /**
     * Ensure the URL is set, return default otherwise
     * @return string
     */
    public static function getUrl($url = false)
    {
        $url = false !== $url ? $url : self::$_url;
        return $url;
    }

    public function setUrl($url)
    {
        if (false !== Helper\Url::isWebRfc($url)) {
            self::$_url  = $url;
            self::$_host = Helper\Url::parseWebsite($url);
        }
        else {
            throw new E('Invalid URL!');
            exit();
        }
        return true;
    }

    public static function getHost($url = false)
    {
        return Helper\Url::parseWebsite(self::getUrl($url));
    }
        
    public static function getDomain($url = false)
    {
        return 'http://' . self::getHost($url = false);
    }

    /**
     * @return DOMDocument
     */
    protected static function _getDOMDocument($html) {
        $doc = new \DOMDocument;
        @$doc->loadHtml($html);
        return $doc;
    }

    /**
     * @return DOMXPath
     */
    protected static function _getDOMXPath($doc) {
        $xpath = new \DOMXPath($doc);
        return $xpath;
    }

    /**
     * @return HTML string
     */
    protected static function _getPage($url) {
        $url = self::getUrl($url);
        if (self::getLastLoadedUrl() == $url) {
            return self::getLastLoadedHtml();
        }

        $html = Helper\HttpRequest::sendCurl($url);
        if ($html) {
            self::$_lastLoadedUrl = $url;
            self::_setHtml($html);
            return $html;
        }
        else {
            self::noDataDefaultValue();
        }
    }

    protected static function _setHtml($str)
    {
        self::$_lastHtml = $str;
    }

    protected static function noDataDefaultValue()
    {
        return Config\DefaultSettings::DEFAULT_NO_DATA;
    }
}
