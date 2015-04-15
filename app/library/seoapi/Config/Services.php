<?php
namespace seoapi\Config;


interface Services
{
    const PROVIDER = '["custom", "thumbalizr","semrush","mashable","mozscape","social"]';

    
    // Thumbalizr public API
    const THUMBALIZR_URL = 'https://api.thumbalizr.com/?url=%s&width=250&output=text&api_key=%s';
    
    //MASHABLE JSONWHOIS
    const MASH_JSONWHOIS = 'https://jsonwhois.p.mashape.com/whois?apiKey=%s&domain=%s';
    
    // Mashable WebpageAnalysis
    const MASH_SIMILAR = 'https://webpageanalyse-webpageanalyse.p.mashape.com/simsites?domain=%s&key=%s';
    const MASH_CATEGORY = "https://webpageanalyse-webpageanalyse.p.mashape.com/category?domain=%s&key=%s";
    
    // Mashable Trustlinker
    const MASH_TRUSTDOMAIN = 'https://trustlinker-de-trustlinkerde.p.mashape.com/domain.json?url=%s';
    
    // Mashable Technologies
    const MASH_TECH = 'https://ivbeg-get-website-technologies-information.p.mashape.com/site/info/?url=%s';
    
    // SEMrush API Endpoints.
    const SEMRUSH_BE_URL = 'http://%s.backend.semrush.com/?action=report&type=%s&domain=%s';
    const SEMRUSH_GRAPH_URL = 'http://semrush.com/archive/graphs.php?domain=%s&db=%s&type=%s&w=%s&h=%s&lc=%s&dc=%s&l=%s';
    const SEMRUSH_WIDGET_URL = 'http://widget.semrush.com/widget.php?action=report&type=%s&db=%s&domain=%s';

    // Mozscape (f.k.a. Seomoz) Link metrics API Endpoint.
    const MOZSCAPE_API_URL = 'http://lsapi.seomoz.com/linkscape/url-metrics/%s?Cols=%s&AccessID=%s&Expires=%s&Signature=%s';


    // Google +1 Fastbutton URL.
    const GOOGLE_PLUSONE_URL = 'https://plusone.google.com/u/0/_/+1/fastbutton?count=true&url=%s';

    // Facebook FQL API Endpoint.
    const FB_LINKSTATS_URL = 'https://api.facebook.com/method/fql.query?query=%s&format=json';

    // Twitter URL tweet count API Endpoint (Use of this Endpoint is actually not allowed (see link)!).
    // @link https://dev.twitter.com/discussions/5653#comment-11514
    const TWEETCOUNT_URL = 'http://cdn.api.twitter.com/1/urls/count.json?url=%s';

    // Delicious API Endpoint.
    const DELICIOUS_INFO_URL = 'http://feeds.delicious.com/v2/json/urlinfo/data?url=%s';

    // Digg API Endpoint.
    // @link http://widgets.digg.com/buttons.js
    const DIGG_INFO_URL = 'http://widgets.digg.com/buttons/count?url=%s&cb=_';

    // LinkedIn API Endpoint.
    // Replaces deprecated share count Url "http://www.linkedin.com/cws/share-count?url=%s".
    // @link http://developer.linkedin.com/forum/discrepancies-between-share-counts
    const LINKEDIN_INFO_URL = 'http://www.linkedin.com/countserv/count/share?url=%s&callback=_';

    // Pinterest API Endpoint.
    const PINTEREST_INFO_URL = 'http://api.pinterest.com/v1/urls/count.json?url=%s&callback=_';

    // StumbleUpon API Endpoint.
    const STUMBLEUPON_INFO_URL = 'http://www.stumbleupon.com/services/1.01/badge.getinfo?url=%s';
    
}
