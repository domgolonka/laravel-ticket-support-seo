<?php
namespace seoapi\Services;

/*
 * Credit: http://apiwiki.moz.com/php
 */
use seoapi\Common\seoapiException as E;
use seoapi\seoapi as seoapi;
use seoapi\Config as Config;
use Helper as Helper;

class Mozscape extends seoapi
{
    // A score based on 100 points
    public static function getPageAuthority($url = false)
    {
        $data = self::getCols('34359738368', $url);
        return (parent::noDataDefaultValue() == $data) ? $data :
            $data['upa'];
    }

    // A score for the domain based on 100 points
    public static function getDomainAuthority($url = false)
    {
        $data = self::getCols('68719476736', Helper\Url::parseWebsite($url));
        return (parent::noDataDefaultValue() == $data) ? $data :
            $data['pda'];
    }

    // The external Equity for Moz
    // http://apiwiki.moz.com/glossary#equity
    public static function getEquityLinkCount($url = false)
    {
        $data = self::getCols('2048', $url);
        return (parent::noDataDefaultValue() == $data) ? $data :
            $data['uid'];
    }

    // The number of internal and external links a domain has
    public static function getLinkCount($url = false)
    {
        $data = self::getCols('2048', $url);
        return (parent::noDataDefaultValue() == $data) ? $data :
            $data['uid'];
    }

    // A MozRank based on 10 points.
    public static function getMozRank($url = false)
    {
        $data = self::getCols('16384', $url);
        return (parent::noDataDefaultValue() == $data) ? $data :
            $data['umrp'];
    }
    // The number of  http://apiwiki.moz.com/glossary#equity
    public static function getExternalEquityLinks($url = false)
    {
        $data = self::getCols('32', $url);
        return (parent::noDataDefaultValue() == $data) ? $data :
            $data['ueid'];
    }

    /**
     * Return Link metrics from the (free) Mozscape (f.k.a. Seomoz) API.
     *
     * @access        public
     * @param   cols  string     The bit flags you want returned.
     * @param   url   string     The URL to get metrics for.
     */
    public static function getCols($cols, $url = false)
    {
        if ('' == Config\ApiKeys::MOZSCAPE_ACCESS_ID ||
            '' == Config\ApiKeys::MOZSCAPE_SECRET_KEY) {
            throw new E('In order to use the Mozscape API, you must obtain
                and set an API key first (see seoapi\Config\ApiKeys.php).');
            exit(0);
        }

        $expires = time() + 300;

        $apiEndpoint = sprintf(Config\Services::MOZSCAPE_API_URL,
            urlencode(Helper\Url::parseWebsite(parent::getUrl($url))),
            $cols,
            Config\ApiKeys::MOZSCAPE_ACCESS_ID,
            $expires,
            urlencode(self::_getUrlSafeSignature($expires))
        );

        $ret = parent::_getPage($apiEndpoint);

        return (!$ret || empty($ret) || '{}' == (string)$ret)
                ? parent::noDataDefaultValue()
                : Helper\Json::decodeJson($ret, true);
    }

    private static function _getUrlSafeSignature($expires)
    {
        $data = Config\ApiKeys::MOZSCAPE_ACCESS_ID . "\n{$expires}";
        $sig  = self::_hmacsha1($data, Config\ApiKeys::MOZSCAPE_SECRET_KEY);

        return base64_encode($sig);
    }

    private static function _hmacsha1($data, $key)
    {
        // Use PHP's built in functionality if available
        // (~20% faster than the custom implementation below).
        if (function_exists('hash_hmac')) {
            return hash_hmac('sha1', $data, $key, true);
        }

        $blocksize = 64;
        $hashfunc  = 'sha1';

        if (strlen($key) > $blocksize) {
            $key = pack('H*', $hashfunc($key));
        }

        $key  = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        $hmac = pack('H*', $hashfunc(($key^$opad) .
                    pack('H*', $hashfunc(($key^$ipad) . $data))));
        return $hmac;
    }
}
