<?php
namespace seoapi\Services;


use seoapi\seoapi as seoapi;
use seoapi\Config as Config;
use Helper as Helper;

class Social extends seoapi
{

    /**
     * Treturn the number of shares on Google+.
     *
     * @access        public
     * @param   url   string     Site
     * @return        integer    Returns the total count of Plus Ones for a URL.
     */
    public static function getGooglePlusShares($site = false)
    {
        $site     = parent::getUrl($site);
        $dataSite = sprintf(Config\Services::GOOGLE_PLUSONE_URL, urlencode($site));
        $html    = parent::_getPage($dataSite);
        @preg_match_all('/window\.__SSR\s\=\s\{c:\s(\d+?)\./', $html, $match, PREG_SET_ORDER);

        return (1 === sizeof($match) && 2 === sizeof($match[0])) ? intval($match[0][1]) : parent::noDataDefaultValue();
    }

    /**
     * Returns an array of Facebook Shares/Likes/Comments/Outgoing links.
     *
     * @access        public
     * @link          http://developers.facebook.com/docs/reference/fql/link_stat/
     * @param   url   string     Site
     * @return        array      An array of facebook links, shares, outgoing links
     */
    public static function getFacebookShares($site = false)
    {
        $site     = parent::getUrl($site);
        $sqlstring     = sprintf('SELECT total_count, share_count, like_count, comment_count, commentsbox_count, click_count FROM link_stat WHERE url="%s"', $site);
        $dataSite = sprintf(Config\Services::FB_LINKSTATS_URL, rawurlencode($sqlstring));

        $jsonD = parent::_getPage($dataSite);
        $siteArr = Helper\Json::decodeJson($jsonD, true);

        return isset($siteArr[0]) ? $siteArr[0] : parent::noDataDefaultValue();
    }

    /**
     * Returns the total number of twitter shares
     *
     * @access       public
     * @param   url  string             Site
     * @return       integer            Returns the number of twitter shares
     * @link         https://dev.twitter.com/discussions/5653#comment-11514
     */
    public static function getTwitterShares($site = false)
    {
        $site     = parent::getUrl($site);
        $dataSite = sprintf(Config\Services::TWEETCOUNT_URL, urlencode($site));

        $jsonD = parent::_getPage($dataSite);
        $siteArr = Helper\Json::decodeJson($jsonD, true);

        return isset($siteArr['count']) ? intval($siteArr['count']) : parent::noDataDefaultValue();
    }

    /**
     * Returns the number of Delicious shares
     *
     * @access        public
     * @param   url   string     Site
     * @return        integer    Returns the number of Delicious shares
     */
    public static function getDeliciousShares($site = false)
    {
        $site     = parent::getUrl($site);
        $dataSite = sprintf(Config\Services::DELICIOUS_INFO_URL, urlencode($site));

        $jsonD = parent::_getPage($dataSite);
        $siteArr = Helper\Json::decodeJson($jsonD, true);

        return isset($siteArr[0]['total_posts']) ? intval($siteArr[0]['total_posts']) : parent::noDataDefaultValue();
    }

    /**
     * Returns the number of Digg Shares
     *
     * @access        public
     * @param   url   string     Site
     * @return        integer    Returns the number of Digg Shares
     */
    public static function getDiggShares($site = false)
    {
        $site     = parent::getUrl($site);
        $dataSite = sprintf(Config\Services::DIGG_INFO_URL, urlencode($site));

        $jsonD = parent::_getPage($dataSite);
        $siteArr = Helper\Json::decodeJson(substr($jsonD, 2, -2), true);

        return isset($siteArr['diggs']) ? intval($siteArr['diggs']) : parent::noDataDefaultValue();
    }

    /**
     *  Returns the number of LinkedinShares
     *
     * @access        public
     * @param   url   string     Site
     * @return        integer    Returns the number of linkedin shares
     */
    public static function getLinkedInShares($site = false)
    {
        $site     = parent::getUrl($site);
        $dataSite = sprintf(Config\Services::LINKEDIN_INFO_URL, urlencode($site));

        $jsonD = parent::_getPage($dataSite);
        $siteArr = Helper\Json::decodeJson(substr($jsonD, 2, -2), true);

        return isset($siteArr['count']) ? intval($siteArr['count']) : parent::noDataDefaultValue();
    }

    /**
     * Returns the number of pinterest shares
     *
     * @access        public
     * @param   url   string     URL
     * @return        integer    Returns the number of pinterest shares.
     */
    public static function getPinterestShares($site = false)
    {
        $site     = parent::getUrl($site);
        $dataSite = sprintf(Config\Services::PINTEREST_INFO_URL, urlencode($site));

        $jsonD = parent::_getPage($dataSite);
        $siteArr = Helper\Json::decodeJson(substr($jsonD, 2, -1), true);

        return isset($siteArr['count']) ? intval($siteArr['count']) : parent::noDataDefaultValue();
    }

    /**
     * Returns the number of StumbleUpon Shares
     *
     * @access        public
     * @param   url   string     URL.
     * @return        integer    Returns the number of StumbleUpon Shares
     */
    public static function getStumbleUponShares($site = false)
    {
        $site     = parent::getUrl($site);
        $dataSite = sprintf(Config\Services::STUMBLEUPON_INFO_URL, urlencode($site));

        $jsonD = parent::_getPage($dataSite);
        $siteArr = Helper\Json::decodeJson($jsonD, true);

        return isset($siteArr['result']['in_index']) && true == $siteArr['result']['in_index']
            ? intval($siteArr['result']['views']) : parent::noDataDefaultValue();
    }

  
}
