<?php
namespace Helper;

class Url
{
     /**
     * Parses the host/URL
     *
     * @access        public
     * @param         string        $site        String containing the URL
     * @return        string                    Returns the parsed URL
     */
    public static function parseWebsite($site)
    {
        $site = @parse_url('http://' . preg_replace('#^https?://#', '', $site));
        return (isset($site['host']) && !empty($site['host'])) ? $site['host'] : false;
    }

    /**
     * Validates the URL syntax
     *
     * @access        public
     * @param         string        $site        String containing the URL
     * @return        string                    Returns string, containing the validation result.
     */
    public static function isWebRfc($site)
    {
        if(isset($site) && 1 < strlen($site)) {
            $webhost   = self::parseWebsite($site);
            $scheme = strtolower(parse_url($site, PHP_URL_SCHEME));
            if (false !== $webhost && ($scheme == 'http' || $scheme == 'https')) {
                $pattern  = '([A-Za-z][A-Za-z0-9+.-]{1,120}:[A-Za-z0-9/](([A-Za-z0-9$_.+!*,;/?:@&~=-])';
                $pattern .= '|%[A-Fa-f0-9]{2}){1,333}(#([a-zA-Z0-9][a-zA-Z0-9$_.+!*,;/?:@&~=%-]{0,1000}))?)';
                return (bool) preg_match($pattern, $site);
            }
        }
        return false;
    }
}
