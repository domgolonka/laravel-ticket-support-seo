<?php

class HomepageController extends Controller {

    public function terms() {
        return View::make('home.terms-privacy')
                        ->with('title', 'Terms and Condition | Privacy');
    }

    public function siteExplorer() {
        $parsed = parse_url(Input::get('website'));
        if (!isset($parsed["host"])) {
            $parsed["host"] = $parsed["path"];
        }

        $parsed["host"] = preg_replace('#^https?://#', '', $parsed["host"]);
        if (substr($parsed["host"], 0, 4) === 'www.') {
            $parsed['host'] = preg_replace('#^www\.(.+\.)#i', '$1', $parsed['host']);
        }

        $path_parts = pathinfo($parsed["host"]);
		
		if (isset($path_parts['extension'])){
			$url_extension = $path_parts['extension'];
		}
		else {
			$url_extension = false;
		}
		
        if (substr($parsed["host"], 0, 3) === 'www' or $url_extension == "com") {
            $website = 'https://' . $parsed["host"];
        } else {
            $website = 'https://www.' . $parsed["host"];
        }

        $handle = @fopen($website, 'r');
        if ($handle !== false) {
            $path_parts = pathinfo($website);
            $url_extension = $path_parts['extension'];
            $allowed_urls = array('com', 'ca', 'net');

            if (in_array($url_extension, $allowed_urls)) {
                $url = $website;
                if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
                    $url = "https://" . $url;
                }

                $keyword = "school";
                $seoapi = new seoapi\seoapi;
                if ($seoapi->setUrl($url)) {
                    $isJsonWhois = seoapi\Services\Mashable::getJsonWhois()->raw_body;
                    $thumbalizr = seoapi\Services\Thumbalizr::getScreenshot(false);
                    $isSiteMap = seoapi\Services\Custom::getSiteMap();
                    $isRobotTxt = seoapi\Services\Custom::getRobots();
                    $isUnderScore = seoapi\Services\Custom::getDomainChar();
                    //$isSimilar = seoapi\Services\Mashable::getSimilarWebsites() -> raw_body;
                    $domainInfo = seoapi\Services\Mashable::getTrustDomain()->raw_body;
                    //Social
                    $isGooglePlus = seoapi\Services\Social::getGooglePlusShares();
                    $isFacebookShares = seoapi\Services\Social::getFacebookShares();
                    $isTwitterShares = seoapi\Services\Social::getTwitterShares();
                    $isDeliciousShares = seoapi\Services\Social::getDeliciousShares();
                    $isDiggShares = seoapi\Services\Social::getDiggShares();
                    $isLinkedInShares = seoapi\Services\Social::getLinkedInShares();
                    $isPinterestShares = seoapi\Services\Social::getPinterestShares();
                    $isStumbleUponShares = seoapi\Services\Social::getStumbleUponShares();
                    //Moz
                    $isPageAuth = seoapi\Services\Mozscape::getPageAuthority();
                    $isDomainAuth = seoapi\Services\Mozscape::getDomainAuthority();
                    $isExternal = seoapi\Services\Mozscape::getExternalEquityLinks();
                    $isEquityLinkCount = seoapi\Services\Mozscape::getEquityLinkCount();
                    $isMozRank = seoapi\Services\Mozscape::getMozRank();
                    $isLinkCount = seoapi\Services\Mozscape::getLinkCount();
                    //Semrush
                    $isSemRank = seoapi\Services\SEMRush::getDomainRank();
                    //$isOrganicKeyWords = seoapi\Services\SEMRush::getOrganicKeywords();
                }

                //Clean out garbage data in API

                $data_to_remove = array("_id", "social", "owner", '__v', "raw");
                $sem = array("semrank" => $isSemRank);

                $jsonWhois = json_decode($isJsonWhois, true);
                $thumb = $thumbalizr;
                $sitemap = array("hasSiteMap" => $isSiteMap);
                //$similar = json_decode($isSimilar, true);
                $domainTypes = array("hasRobotTxt" => $isRobotTxt,
                    "hasUnderScore" => $isUnderScore,
                );
                $moz = array("mozrank" => $isMozRank,
                    "pmozauth" => $isPageAuth,
                    "dmozauth" => $isDomainAuth,
                    "mozexteneral" => $isExternal,
                    "equitylinkcount" => $isEquityLinkCount,
                    "linkcount" => $isLinkCount,
                );
                $social = array("googleplus" => $isGooglePlus,
                    "facebook" => $isFacebookShares,
                    "twitter" => $isTwitterShares,
                    "delicious" => $isDeliciousShares,
                    "digg" => $isDiggShares,
                    "linkedin" => $isLinkedInShares,
                    "pinterest" => $isPinterestShares,
                    "stumbleupon" => $isStumbleUponShares
                );

                $domainInfo = json_decode($domainInfo, true);

                foreach ($data_to_remove as $attri) {
                    unset($jsonWhois[$attri]);
                }

                $final_result = json_encode(array_merge($jsonWhois, $thumb, $sitemap, $domainTypes, $domainInfo, $social, $moz, $sem));
                /*
                 *
                 * SCORING ALGORITHM
                 *
                 */

                $jsonDecoded = json_decode($final_result, true);

                if(!empty($jsonDecoded['alexa']) || !empty($jsonDecoded['alexa']['rank']) || !empty($jsonDecoded['alexa']['reach'])){
                    $rank = $jsonDecoded['alexa']['rank'];
                    $reach = $jsonDecoded['alexa']['reach'];
                }
                if(!empty($jsonDecoded['google']['rank'])) {
                    $google = $jsonDecoded['google']['rank'];
                }

                $googleplus = $jsonDecoded['googleplus'];
                $facebook = $jsonDecoded['facebook']['total_count'];
                $twitter = $jsonDecoded['twitter'];
                $delicious = $jsonDecoded['delicious'];
                $digg = $jsonDecoded['digg'];
                $linkedin = $jsonDecoded['linkedin'];
                $pinterest = $jsonDecoded['pinterest'];
                $stumbleupon = $jsonDecoded['stumbleupon'];

                // Normalize the reach score to be an inverse exponential
                // Relation from 0.0 to 1.0, then multiply it by a constant
                if(!empty($jsonDecoded['alexa']['reach'])){
                    $reachScore = (sqrt($reach / 1000000)) * 100000;
                }
                // Create a value that increases as rank decreases, and
                // Multiply it by a constant
                $rankScore =0;
                if(!empty($jsonDecoded['alexa']['rank'])){
                    $rankScore += (1 / $rank) * 100000;
                }
                if(!empty($jsonDecoded['google']['rank'])){
                    $rankScore += (1 / $google) * 100000;
                }
                

                $rankScore += (1 / ($isPageAuth / 100)) * 100000;
                $rankScore += (1 / ($isDomainAuth / 100)) * 100000;
                $rankScore += (1 / $sem['semrank']['Rk']) * 100000;
                //Links are worth not as much
                $linkscore = $isLinkCount * 0.5;
                $linkscore += $isExternal * 0.7;
                $linkscore += $isEquityLinkCount * 0.7;
                // Worth half as much
                if ($isUnderScore == "No") {
                    $rankScore += 50000;
                }
                $socialSum = $googleplus + $facebook + $twitter +
                        $delicious + $digg + $linkedin +
                        $pinterest + $stumbleupon;
                
                if(isset($reachScore) && isset($rankScore)) {
                    $score = $reachScore + $rankScore + $socialSum + $linkscore;
                } else {
                    $score = $socialSum + $linkscore;
                }
                /*
                 * END SCORING ALGORITHM
                 */

                $score_array = array("score" => $score);
                $final_result = json_decode($final_result, true);
                $final_result = json_encode(array_merge($final_result, $score_array));

                if (Auth::check()) {
                    $id = Auth::user()->getId();
                    $user = new Userssite;
                    $user->user_id = $id;
                    $user->site_url = $url;
                    $user->site_info = $final_result;
                    $user->save();
                }
                //$last_updated = $mashable["lastUPDATED"];
            } else {
                $final_result = false;
                $score = 0;
            }

            return View::make("home/site-explorer")->with("website", $final_result)->with("score", $score);
            //return View::make("home/site-explorer")->with("website" , $final_result);
            //return View::make("home/site-explorer")->with(array("website" =>  'http://'.$parsed["host"]));
        } else {
            $final_result = false;
            $score = 0;
            return View::make("home/site-explorer")->with("website", $final_result)->with("score", $score);
        }
    }

}

?>