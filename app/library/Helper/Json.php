<?php
namespace Helper;


class Json
{
   /**
    * Decodes JSON format
    *
    * @param    string  $string    Json format
    * @param    boolean $arrays  true if an associate array
    * @return   mixed   any formart is returned including array, string, int
    */
    public static function decodeJson($string, $arrays = false)
    {
        if (!function_exists('json_decode')) {
            $j = self::getJson();
            return $j->decodeJson($string);
        }
        else {
            return $arrays ? json_decode($string, true) : json_decode($string); // if array return decode and true else return decode
        }
    }

   /**
    * Encodes Json Format
    *
    * @param    mixed   $vars    any value can be encoded
    * @return   mixed   JSON    returns an error or problem if not properly decoded
    */
    public static function encodeJson($vars)
    {
        if (!function_exists('json_encode')) { // if native PHP doesn't exist
            $j = self::getJson();
            return $j->encode($vars);
        }
        else {
            return json_encode($vars);
        }
    }

    /**
     * Helper class Services\Json if PHP native is not found
     */
    private static function getJson()
    {
        return new \Services_JSON();
    }

}
