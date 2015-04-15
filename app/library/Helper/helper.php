<?php

class Helper {

    /**
    * Creates an icon with markup
    *
    * @param	string	- the name of the icon
    * @return	string	- the markup of the icon
    * @access	public
    */
    public static function icon($icon) {
    	return '<i class="fa fa-' . $icon . '"></i>';
    }

    /**
    * Parses a ticket status (needed for update ticket class)
    *
    * @param    string  - the status
    * @return   string  - a formatted HTML string
    * @access   public
    */
    public static function status($status, $type = 'text') {
        switch ($type) {
            case 'text':
                switch($status) {
                    case 'open':           $status = 'Open';     $type = 'warning';  break;
                    case 'closed':         $status = 'Closed';     $type = 'success';  break;
                    case 'hold':           $status = 'Pending';   $type = 'info';     break;
                    case 'in-progress':    $status = 'In Process';  $type = 'default';  break;
                }

                return '<span class="highlight highlight-' . $type . '">' . $status . '</span>';
            break;
        }
    }

    /**
    * Turns into a SQL time or date stamp or both.
    *
    * @param    int     - unix time()
    * @param    string  - the time of string needed: 
    **/
    public static function sqltime($time, $type = 'date') {
        switch ($type) {
            case 'date':    return date('Y-m-d', $time);       break;
            case 'time':    return date('H:i:s', $time);       break;
            default:        return date('Y-m-d H:i:s', $time); break;
        }
    }
   
    /**
    * Stores the research to model
    *
    * @param    int     - $id 
    * @param    string  - $url_searched The URL searched
    * @param    string  - $url_metrics Metrics of the URL
    * @return   string  - the original base64 string
    */
    public static function store($id, $url_searched, $url_metrics) {
		   		
			$research = new Research;
			$research->user_id    = $id;
			$research->site_url    = $url_searched;
			$research->site_info = $url_metrics;
			$research->save();

			// redirect
			return Redirect::to('clients/research'); 
    }
}