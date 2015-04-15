<?php
/**
 * A simple class to access the Mozscape API.
 * 
 * This PHP class allows simple and quick access to the various API methods of the
 * Mozscape API (http://apiwiki.seomoz.org/). It currently includes the URL Metrics
 * API, Metadata API Calls, Top Pages API, the Link Metrics API and response fields
 * information.
 * 
 * PHP version 5
 * 
 * @package   MozscapeAPIClass
 * @author    Ben Marshall <me@benmarshall.me>
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version   1.1
 * @link      http://www.benmarshall.me/mozscape-api-class
 * @since     Class available since Release 1.0
 */
 
// public static function __autoload($class){
//	require $class; 
// }

class Mozscape_API_Class
{
	//my own function to store the results in DB ***************//
/*public function store($id, $url_searched, $url_metrics) {
		   		
			$research = new Research;
			$research->user_id    = $id;
			$research->site_url    = $url_searched;
			$research->site_info = $url_metrics;
			$research->save();

			// redirect
			return Redirect::to('clients/research'); 
    }	*/
	//my own function to store the results in DB ***************//
  /*
   * Your Mozscape API Access Id
   * 
   * Obtain a Access ID here: http://www.seomoz.org/api/keys
   * 
   * @var string
   * @access private
   * member-a2ba05c944
   */
  private $_accessID='member-a2ba05c944';
  
  /*
   * The Mozscape API Secret Key
   * 
   * Obtain a Secret Key here: http://www.seomoz.org/api/keys
   * 
   * @var string
   * @access private
   * fe14b1bdc8442b00909424f59b98bf91
   */
  private $_secretKey='fe14b1bdc8442b00909424f59b98bf91';
  
  /*
   * A unix timestamp
   * 
   * A unix timestamp which you generate indicating for how long the request should
   * be valid.
   * 
   * @var int
   * @access private
   */
  private $_expires='1406459630';
  
  /*
   * The generated Mozscape API Signatur
   * 
   * Get's generated based off the Access Id and Expires
   * 
   * @var string
   * @access private
   */
  private $_signature='BQacgDBDnzwD/is24+ljaPwsV/U=';
  
  /*
   * Mozscape's API URL
   * 
   * The beginning of the Mozscape API URL
   * 
   * @var string
   * @access private
   */
  private $_apiURL = 'http://lsapi.seomoz.com/linkscape/';
  
  /*
   * Registers the Mozscape API access credentials
   * 
   * @param string  $accessID   the Mozscape API Access Id
   * @param string  $secretKey  the Mozscape API Secret Key
   * @param int     $expires    the amount of time the request is valid
   * 
   * @access public
   * @since Method available since Release 1.0
   */
  public function __construct($accessID, $secretKey, $expires = 0)
  {
    // Sets the Mozscape API Access Id
    $this->_setAccessID($accessID);
    $this->_setSecretKey($secretKey);
    $this->_setExpires($expires);
    $this->_setSignature();
  }
  
  /*
   * Sets the Mozscape API Access Id
   * 
   * @param string  $accessID   the Mozscape API Access Id
   * 
   * @access private
   * @since Method available since Release 1.0
   */
  private function _setAccessID($accessID) {
    $this->_accessID = $accessID;
  }
  
  /*
   * Sets the Mozscape API Secret Key
   * 
   * @param string  $secretKey   the Mozscape API Secret Key
   * 
   * @access private
   * @since Method available since Release 1.0
   */
  private function _setSecretKey($secretKey) {
    $this->_secretKey = $secretKey;
  }
  
  
  /*
   * Set the amount of time the request is valid
   * 
   * @param int  $expires   a unix timestamp
   * 
   * @access private
   * @since Method available since Release 1.0
   */
  private function _setExpires($expires) {
    if(!$expires) {
      // Sets a default of five minutes if one is not given
      $this->_expires = time() + 300;
    } else {
      // Sets the expires to the specificed time
      $this->_expires = $expires;
    }
  }
  
  /*
   * Sets the Mozscape API signature
   * 
   * @access private
   * @since Method available since Release 1.0
   */
  private function _setSignature() {
    // A new linefeed is necessary between your AccessID and Expires
    $string_to_sign = $this->_accessID."\n".$this->_expires;
    
    // Get the "raw" or binary output of the hmac hash
    $binary_signature = hash_hmac('sha1', $string_to_sign, $this->_secretKey, true);
    
    // We need to base64-encode it and then url-encode that
    $url_safe_signature = urlencode(base64_encode($binary_signature));
    
    // Set the authenticated signature
    $this->_signature = $url_safe_signature;
  }
  
  /*
   * Returns the Mozscape API signature
   * 
   * @return  string  the generated Mozscape API signature
   * 
   * @access public
   * @since Method available since Release 1.0
   */
  public function getSignature() {
    return $this->_signature;
  }
  
  /*
   * Sends a Curl request
   * 
   * @param   string  $request_url  The URI to send the Curl request to
   * 
   * @return  string  the response of the Curl request
   * 
   * @access private
   * @since Method available since Release 1.0
   */
  private function _curlRequest($request_url) {
    $options = array(
      CURLOPT_RETURNTRANSFER => true
    );
    
    $ch = curl_init($request_url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    curl_close($ch);
    
    // Check if error
    $r = json_decode($content);
    if( isset($r->error_message) ) {
      echo '<p>'.$r->error_message.'<p>';
    }
    
    return $content;
  }
  
  /*
   * Returns the response field information
   * Learn more here: http://apiwiki.seomoz.org/response-fields
   * 
   * @param   string  $field    The response field key
   * @param   string  $return   The data to return (name, slug, bit_flag, description, free)
   * 
   * @return  array   The response field data
   * 
   * @access public
   * @since Method available since Release 1.0
   */
  public function responseFields($field, $return = '') {
    switch($field) {
      case 'ut':
        $array = array(
          'name'        =>  'Title',
          'slug'        =>  'title',
          'bit_flag'    =>  1,
          'description' =>  'The title of the page if available. For example: "Request-Response Format"',
          'free'        =>  'yes'
        );
        break;
      case 'uu':
        $array = array(
          'name'        =>  'URL',
          'slug'        =>  'url',
          'bit_flag'    =>  4,
          'description' =>  'The canonical form of the URL. For example: "www.seomoz.org"',
          'free'        =>  'yes'
        );
        break;
      case 'ufq':
        $array = array(
          'name'        =>  'Subdomain',
          'slug'        =>  'subdomain',
          'bit_flag'    =>  8,
          'description' =>  'The subdomain of the URL. For example: "apiwiki.seomoz.org"',
          'free'        =>  'no'
        );
        break;
      case 'upl':
        $array = array(
          'name'        =>  'Root Domain',
          'slug'        =>  'root_domain',
          'bit_flag'    =>  16,
          'description' =>  'The subdomain of the URL. For example: "apiwiki.seomoz.org"',
          'free'        =>  'no'
        );
        break;
      case 'ueid':
        $array = array(
          'name'        =>  'External Links',
          'slug'        =>  'external_links',
          'bit_flag'    =>  32,
          'description' =>  'The number of juice-passing external links to the URL.',
          'free'        =>  'yes'
        );
        break;
      case 'feid':
        $array = array(
          'name'        =>  'Subdomain External Links',
          'slug'        =>  'subdomain_external_links',
          'bit_flag'    =>  64,
          'description' =>  'The number of juice-passing external links to the subdomain of the URL.',
          'free'        =>  'no'
        );
        break;
      case 'peid':
        $array = array(
          'name'        =>  'Root Domain External Links',
          'slug'        =>  'root_domain_external_links',
          'bit_flag'    =>  128,
          'description' =>  'The number of juice-passing external links to the root domain of the URL.',
          'free'        =>  'no'
        );
        break;
      case 'ujid':
        $array = array(
          'name'        =>  'Juice-Passing Links',
          'slug'        =>  'juice_passing_links',
          'bit_flag'    =>  256,
          'description' =>  'The number of juice-passing links (internal or external) to the URL.',
          'free'        =>  'no'
        );
        break;
      case 'uifq':
        $array = array(
          'name'        =>  'Subdomains Linking',
          'slug'        =>  'subdomains_linking',
          'bit_flag'    =>  512,
          'description' =>  'The number of subdomains with any pages linking to the URL.',
          'free'        =>  'no'
        );
        break;
      case 'uipl':
        $array = array(
          'name'        =>  'Root Domains Linking',
          'slug'        =>  'root_domains_linking',
          'bit_flag'    =>  1024,
          'description' =>  'The number of root domains with any pages linking to the URL.',
          'free'        =>  'no'
        );
        break;
      case 'uid':
        $array = array(
          'name'        =>  'Links',
          'slug'        =>  'links',
          'bit_flag'    =>  2048,
          'description' =>  'The number of links (juice-passing or not, internal or external) to the URL.',
          'free'        =>  'yes'
        );
        break;
      case 'fid':
        $array = array(
          'name'        =>  'Subdomain Subdomains Linking',
          'slug'        =>  'subdomain_subdomains_linking',
          'bit_flag'    =>  4096,
          'description' =>  'The number of subdomains with any pages linking to the subdomain of the URL.',
          'free'        =>  'no'
        );
        break;
      case 'pid':
        $array = array(
          'name'        =>  'Root Domain Root Domains Linking',
          'slug'        =>  'subdomain_subdomains_linking',
          'bit_flag'    =>  8192,
          'description' =>  'The number of root domains with any pages linking to the root domain of the URL.',
          'free'        =>  'no'
        );
        break;
      case 'umrp':
      case 'umrr':
        $array = array(
          'name'        =>  'MozRank',
          'slug'        =>  'mozrank',
          'bit_flag'    =>  16384,
          'description' =>  'The mozRank of the URL. Requesting this metric will provide both the pretty 10-point score (in umrp) and the raw score (umrr).',
          'free'        =>  'yes'
        );
        break;
      case 'fmrp':
      case 'fmrr':
        $array = array(
          'name'        =>  'Subdomain MozRank',
          'slug'        =>  'subdomain_mozrank',
          'bit_flag'    =>  32768,
          'description' =>  'The mozRank of the subdomain of the URL. Requesting this metric will provide both the pretty 10-point score (fmrp) and the raw score (fmrr).',
          'free'        =>  'yes'
        );
        break;
      case 'pmrp':
      case 'pmrr':
        $array = array(
          'name'        =>  'Root Domain MozRank',
          'slug'        =>  'root_domain_mozrank',
          'bit_flag'    =>  65536,
          'description' =>  'The mozRank of the Root Domain of the URL. Requesting this metric will provide both the pretty 10-point score (pmrp) and the raw score (pmrr).',
          'free'        =>  'no'
        );
        break;
      case 'utrp':
      case 'utrr':
        $array = array(
          'name'        =>  'MozTrust',
          'slug'        =>  'moztrust',
          'bit_flag'    =>  131072,
          'description' =>  'The mozTrust of the URL. Requesting this metric will provide both the pretty 10-point score (utrp) and the raw score (utrr).',
          'free'        =>  'no'
        );
        break;
      case 'ftrp':
      case 'ftrr':
        $array = array(
          'name'        =>  'Subdomain MozTrust',
          'slug'        =>  'subdomain_moztrust',
          'bit_flag'    =>  262144,
          'description' =>  'The mozTrust of the subdomain of the URL. Requesting this metric will provide both the pretty 10-point score (ftrp) and the raw score (ftrr).',
          'free'        =>  'no'
        );
        break;
      case 'ptrp':
      case 'ptrr':
        $array = array(
          'name'        =>  'Root Domain MozTrust',
          'slug'        =>  'root_domain_moztrust',
          'bit_flag'    =>  524288,
          'description' =>  'The mozTrust of the root domain of the URL. Requesting this metric will provide both the pretty 10-point score (ptrp) and the raw score (ptrr).',
          'free'        =>  'no'
        );
        break;
      case 'uemrp':
      case 'uemrr':
        $array = array(
          'name'        =>  'External MozRank',
          'slug'        =>  'external_mozrank',
          'bit_flag'    =>  1048576,
          'description' =>  'The portion of the URL\'s mozRank coming from external links. You get both the pretty 10-point score (uemrp) and the raw score (uemrr).',
          'free'        =>  'no'
        );
        break;
      case 'fejp':
      case 'fejr':
        $array = array(
          'name'        =>  'Subdomain External Domain Linking Juice',
          'slug'        =>  'subdomain_external_domain_linking_juice',
          'bit_flag'    =>  2097152,
          'description' =>  'The portion of the mozRank of all pages on the subdomain coming from external links. You get both the pretty 10-digit score (pejp) and the raw source.',
          'free'        =>  'no'
        );
        break;
      case 'pejp':
      case 'pejr':
        $array = array(
          'name'        =>  'Root Domain External Domain Juice',
          'slug'        =>  'root_domain_external_domain_juice',
          'bit_flag'    =>  4194304,
          'description' =>  'The portion of the mozRank of all pages on the root domain coming from external links. You get both the pretty 10-digit score (pejp) and the raw source.',
          'free'        =>  'no'
        );
        break;
      case 'fjp':
      case 'fjr':
        $array = array(
          'name'        =>  'Subdomain Domain Juice',
          'slug'        =>  'subdomain_domain_juice',
          'bit_flag'    =>  8388608,
          'description' =>  'The mozRank of all pages on the subdomain combined. You get the pretty 10-point score (fjp) and the raw score (fjr).',
          'free'        =>  'no'
        );
        break;
      case 'pjp':
      case 'pjr':
        $array = array(
          'name'        =>  'Root Domain Domain Juice',
          'slug'        =>  'root_domain_domain_juice',
          'bit_flag'    =>  16777216,
          'description' =>  'The mozRank of all pages on the root domain combined. You get both the pretty 10-point score (pjp) and the raw score (pjr).',
          'free'        =>  'no'
        );
        break;
      case 'us':
        $array = array(
          'name'        =>  'HTTP Status Code',
          'slug'        =>  'http_status_code',
          'bit_flag'    =>  536870912,
          'description' =>  'The HTTP status code recorded by Mozscape for this URL (if available).',
          'free'        =>  'yes'
        );
        break;
      case 'fuid':
        $array = array(
          'name'        =>  'Links to Subdomain',
          'slug'        =>  'links_to_subdomain',
          'bit_flag'    =>  4294967296,
          'description' =>  'Total links (including internal and nofollow links) to the subdomain of the URL.',
          'free'        =>  'no'
        );
        break;
      case 'puid':
        $array = array(
          'name'        =>  'Links to Root Domain',
          'slug'        =>  'links_to_root_domain',
          'bit_flag'    =>  8589934592,
          'description' =>  'Total links (including internal and nofollow links) to the root domain of the URL.',
          'free'        =>  'no'
        );
        break;
      case 'fipl':
        $array = array(
          'name'        =>  'Root Domains Linking to Subdomain',
          'slug'        =>  'root_domains_linking_to_subdomain',
          'bit_flag'    =>  17179869184,
          'description' =>  'The number of root domains with at least one link to the subdomain of the URL.',
          'free'        =>  'no'
        );
        break;
      case 'upa':
        $array = array(
          'name'        =>  'Page Authority',
          'slug'        =>  'page_authority',
          'bit_flag'    =>  34359738368,
          'description' =>  'A score out of 100 points representing the likelihood of a page to rank well, regardless of content.',
          'free'        =>  'yes'
        );
        break;
      case 'pda':
        $array = array(
          'name'        =>  'Domain Authority',
          'slug'        =>  'domain_authority',
          'bit_flag'    =>  68719476736,
          'description' =>  'A score out of 100 points representing the likelihood of a domain to rank well, regardless of content.',
          'free'        =>  'yes'
        );
        break;
      case 'lrid':
        $array = array(
          'name'        =>  'Internal Link ID (Link)',
          'slug'        =>  'internal_link_id',
          'description' =>  'Internal ID of the link (Link)'
        );
        break;
      case 'lsrc':
        $array = array(
          'name'        =>  'Internal Source URL ID (Link)',
          'slug'        =>  'internal_source_url_id',
          'description' =>  'Internal ID of the source URL (Link)'
        );
        break;
      case 'ltgt':
        $array = array(
          'name'        =>  'Internal Target URL ID (Link)',
          'slug'        =>  'internal_target_url_id',
          'description' =>  'Internal ID of the target URL (Link)'
        );
        break;
      case 'lufeid':
        $array = array(
          'name'        =>  'External Juice-Passing Links (Target)',
          'slug'        =>  'external_juice_passing_links',
          'description' =>  'The number of external (from other subdomains), juice-passing links to pages on this subdomain (Target)'
        );
        break;
      case 'lufid':
        $array = array(
          'name'        =>  'Domain Links to Subdomain (Target)',
          'slug'        =>  'domain_links_subdomain',
          'description' =>  'The number of domains with at least one link to any page on the subdomain of the target URL (Target)'
        );
        break;
      case 'lufmrp':
        $array = array(
          'name'        =>  'Subdomain mozRank of URL (Target)',
          'slug'        =>  'subdomain_mozrank_url',
          'description' =>  'The pretty (ten-point, logarithmically-scaled) measure of the mozRank of the subdomain of the target URL in the Mozscape index (Target)'
        );
        break;
      case 'lufmrr':
        $array = array(
          'name'        =>  'Raw Subdomain mozRank of URL (Target)',
          'slug'        =>  'raw_subdomain_mozrank_url',
          'description' =>  'The raw (zero to one, linearly-scaled) measure of the mozRank of the subdomain of the target URL in the Mozscape index (Target)'
        );
        break;
      case 'lufrid':
        $array = array(
          'name'        =>  'Internal Response Code',
          'slug'        =>  'internal_response_code',
          'description' =>  'This response code is for internal use and subject to change.'
        );
        break;
      case 'lupeid':
        $array = array(
          'name'        =>  'External Juice-Passing Links to Root Domain (Target)',
          'slug'        =>  'external_juice_passing_links_root',
          'description' =>  'The number of external (from other root domains), juice-passing links to pages on this root domain (Target)'
        );
        break;
      case 'lupid':
        $array = array(
          'name'        =>  'Domains with Links to PL Domain (Target)',
          'slug'        =>  'domains_links_pl_domain',
          'description' =>  'The number of domains with at least one link to any page on the PL domain of the target URL (Target)'
        );
        break;
      case 'lupmrp':
        $array = array(
          'name'        =>  'PL Domain mozRank (Target)',
          'slug'        =>  'pl_domain_mozrank',
          'description' =>  'The pretty (ten-point, logarithmically-scaled) measure of the mozRank of the PL domain of target URL in the Mozscape index (Target)'
        );
        break;
      case 'lupmrr':
        $array = array(
          'name'        =>  'Raw PL Domain mozRank (Target)',
          'slug'        =>  'raw_pl_domain_mozrank',
          'description' =>  'The raw (zero to one, linearly-scaled) measure of the mozRank of the PL domain of the target URL in the Mozscape index (Target)'
        );
        break;
      case 'luprid':
        $array = array(
          'name'        =>  'Internal Response Code 2',
          'slug'        =>  'internal_response_code_2',
          'description' =>  'This response code is for internal use and subject to change.'
        );
        break;
      case 'luufq':
        $array = array(
          'name'        =>  'Fully Qualified Domain Subdomain (Target)',
          'slug'        =>  'fully_qualified_domain_subdomain',
          'description' =>  'The fully qualified domain (subdomain) as it\'s identified in the Mozscape index (Target)'
        );
        break;
      case 'luuid':
        $array = array(
          'name'        =>  'Internal &amp; External Juice/Non-Juice Passing Links (Target)',
          'slug'        =>  'internal_external_passing_links',
          'description' =>  'The number of internal and external, juice and non-juice passing links to the target URL in the Mozscape index (Target)'
        );
        break;
      case 'luuifq':
        $array = array(
          'name'        =>  'Subdomain with Links to URL (Target)',
          'slug'        =>  'subdomain_links_to_url',
          'description' =>  'The number of subdomains with at least one link to the target URL in the Mozscape index (Target)'
        );
        break;
    }
    if($return) {
      return $array[$return];
    } else {
      return $array;
    }
  }
  
  /*
   * Performs a lookup using the Mozscape URL Metrics API
   * Learn more here: http://apiwiki.seomoz.org/url-metrics
   * URL Metrics Bit Flags, see http://apiwiki.seomoz.org/url-metrics
   * 
   * @param     string  $url    The URL to request information for
   * @param     int     $bits   The bit flags of the information to retrieve
   * 
   * @return  json  the response of the Mozscape URL Metrics API
   * 
   * @access public
   * @since Method available since Release 1.0
   */
  public function urlMetrics($url, $bits) {
    $request_url = $this->_apiURL.'url-metrics/'.urlencode($url).'?Cols='.$bits.'&AccessID='.$this->_accessID.'&Expires='.$this->_expires.'&Signature='.$this->_signature;
    
    $result = $this->_curlRequest($request_url);
    
    return $result;
  }

  /*
   * Performs a lookup using the Metadata API Call
   * Learn more here: http://apiwiki.seomoz.org/metadata-api-calls
   * 
   * @param     string  $data    Either last_update or next_update
   * 
   * @return  int  a unix timestamp
   * 
   * @access public
   * @since Method available since Release 1.1
   */
  public function metadata($data) {
    $request_url = $this->_apiURL.'metadata/'.$data.'?AccessID='.$this->_accessID.'&Expires='.$this->_expires.'&Signature='.$this->_signature;

    $result = $this->_curlRequest($request_url);
    
    return $result;
  }
  
  /*
   * Performs a lookup using the Top Pages API
   * This paid call returns the metrics about many URLs on a given subdomain.
   * Learn more here: http://apiwiki.seomoz.org/top-pages-api
   * 
   * @param   string  $url      The URL to return metrics for
   * @param   int     $offset   Set's the offset number
   * @param   int     $limit    Set's the number of records to return
   * @param   int     $bits     The bit flags of the information to retrieve
   * 
   * @return  int  a unix timestamp
   * 
   * @access public
   * @since Method available since Release 1.1
   */
  public function topPages($url, $offset = 0, $limit = 1000, $bits = 4) {
    $request_url = $this->_apiURL.'top-pages/'.urlencode($url).'?Offset='.$offset.'&Limit='.$limit.'&Cols='.$bits.'&AccessID='.$this->_accessID.'&Expires='.$this->_expires.'&Signature='.$this->_signature;

    $result = $this->_curlRequest($request_url);
    
    return $result;
  }

  /*
   * Performs a lookup using the Mozscape Link Metrics API
   * Learn more here: http://apiwiki.seomoz.org/link-metrics
   * Link Metrics Bit Flags, http://apiwiki.seomoz.org/link-metrics
   * 
   * @param     array  $args    An array of configurable options,
   *                            see http://apiwiki.seomoz.org/link-metrics under
   *                            Call Format.
   * 
   * @return  json  the response of the Mozscape URL Metrics API
   * 
   * @access public
   * @since Method available since Release 1.0
   */
  /* public function linkMetrics($args) {
    // Call format options
    $url = $args['url'];
    $scope = isset($args['scope']) ? $args['scope'] : 'page_to_page';
    $sort = isset($args['sort']) ? $args['sort'] : 'page_authority';
    $filter = isset($args['filter']) ? $args['filter'] : '';
    $targetCols = isset($args['targetCols']) ? $args['targetCols'] : 130015;
    $sourceCols = isset($args['sourceCols']) ? $args['sourceCols'] : '';
    $linkCols = isset($args['linkCols']) ? $args['linkCols'] : '';
    $limit = isset($args['limit']) ? $args['linkCols'] : 25;

    $request_url = $this->_apiURL.'links/'.urlencode($url).'?Scope='.$scope.'&Sort='.$sort.'&Filter='.$filter.'&TargetCols='.$targetCols.'&SourceCols='.$sourceCols.'&LinkCols='.$linkCols.'&Limit='.$limit.'&AccessID='.$this->_accessID.'&Expires='.$this->_expires.'&Signature='.$this->_signature;

    $result = $this->_curlRequest($request_url);
    
    return $result;
  } */
  
  /*
   * Returns the required attribution link for the Mozscape API
   * Learn more here: http://apiwiki.seomoz.org/attribution-requirements
   * 
   * @param   string  $type     The type of image to use (icn, logo)
   * @param   string  $size     The size of image to use (lg, med, sm, xlg)
   * @param   string  $img_dir  The directory where the Mozscape images are located
   * 
   * @return  string  the html for the attribution link
   * 
   * @access public
   * @since Method available since Release 1.0
   */
  public function attributionLink($type, $size, $img_dir = 'img/mozscape/') {
    $url = $img_dir;
    switch($type) {
      case 'icn':
        $url .= 'icn/';
        break;
      case 'logo':
        $url .= 'logo/';
        break;
    }
    switch($size) {
      case 'lg':
        $url .= 'Large_Powered(full).png';
        break;
      case 'med':
        $url .= 'Med_Powered(full).png';
        break;
      case 'sm':
        $url .= 'Small_Powered(full).png';
        break;
      case 'xlg':
        $url .= 'XtraLrg_Powered(full).png';
        break;
    }
    return '<a href="http://www.seomoz.org" rel="nofollow" target="_blank"><img src="'.$url.'" alt="Powered by Mozscape"></a>';
  }
  
  
}
//spl_autoload_register(Mozscape_API_Class::__autoload);
?>