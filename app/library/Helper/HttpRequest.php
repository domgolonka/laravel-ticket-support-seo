<?php
namespace Helper;

class HttpRequest
{
     /**
     * HTTP HEAD request with curl.
     *
     * @access        private
     * @param         String        $a        The request URL
     * @return        Array                   Returns an array containig the response
     *                                        header values.
     */
    public static function getHeaders($url)
    {

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_USERAGENT       => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_CONNECTTIMEOUT  => 10,
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_MAXREDIRS       => 2,
            CURLOPT_SSL_VERIFYPEER  => 0,
            CURLOPT_HEADER          => 1,
            CURLOPT_NOBODY          => 1,
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (200 == (int)$httpCode) ? self::_parse_headers($response) : false;
    }
    /**
     *  HTTP GET/POST request with curl.
     *  @access    public
     *  @param     String      $url        The Request URL
     *  @param     Array       $postData   Optional: POST data array to be send.
     *  @return    Mixed                   On success, returns the response string.
     *                                     Else, the the HTTP status code received
     *                                     in reponse to the request.
     */
    public static function sendCurl($url, $postData = false, $postJson = false, $header = 'Content-type: application/json')
    {

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_USERAGENT       => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_CONNECTTIMEOUT  => 30,
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_MAXREDIRS       => 2,
            CURLOPT_SSL_VERIFYPEER  => 0,
        ));

        if (false !== $postData) {
            if (false !== $postJson) {
                curl_setopt($ch, CURLOPT_HTTPHEADER,
                    array($header));
                $data = json_encode($postData);
            } else {
                $data = http_build_query($postData);
            }
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (200 == (int)$httpCode) ? $response : false;
    }

    /**
     * HTTP HEAD request with curl.
     *
     * @access        private
     * @param         String        $a        The request URL
     * @return        Integer                 Returns the HTTP status code received in
     *                                        response to a GET request of the input URL.
     */
    public static function getCode($url)
    {

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_USERAGENT       => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_CONNECTTIMEOUT  => 10,
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_MAXREDIRS       => 2,
            CURLOPT_SSL_VERIFYPEER  => 0,
            CURLOPT_NOBODY          => 1,
        ));

        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (int)$httpCode;
    }
    
   
  /**
     * HTTP File request with curl.
     *
     * @access        private
     * @param         String        $a        The request URL
     * @return        Array                   Returns an array containig the response
     *                                        header values.
     */
    public function getFile($url, $file)
    {

        $fp = fopen("$file", 'w');

        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_USERAGENT       => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_CONNECTTIMEOUT  => 30,
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_MAXREDIRS       => 2,
            CURLOPT_SSL_VERIFYPEER  => 0,
            CURLOPT_FILE            => $fp,
        ));

        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

        clearstatcache();
        return (bool)(false !== stat($file));
    }
      /**
     * Parse Header Helper
     *
     * @access        protect
     * @param         String        $url        The request URL
     * @return        Array                   Returns an array containig the response
     *                                        header values.
     */
    protected static function _parse_headers( $header )     
    {
        $retVal = array();
        $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));
        foreach( $fields as $field ) {
            if( preg_match('/([^:]+): (.+)/m', $field, $match) ) {
                $match[1] = preg_replace_callback('/(?<=^|[\x09\x20\x2D])./e',  function ($matches) {
            return strtoupper($matches[0]);
        }, strtolower(trim($match[1])));
                if( isset($retVal[$match[1]]) ) {
                    if (!is_array($retVal[$match[1]])) {
                        $retVal[$match[1]] = array($retVal[$match[1]]);
                    }
                    $retVal[$match[1]][] = $match[2];
                } else {
                    $retVal[$match[1]] = trim($match[2]);
                }
            }
        }
        return $retVal;
    } 
}
