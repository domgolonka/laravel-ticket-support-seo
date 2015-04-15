<?php
 
class ResearchController extends BaseController
{
   public function index()
	{
		if(Auth::check()) {
			
			$id = Auth::user()->getId();
			$name = Auth::user()->getFullName();
				
		$view = View::make('research.index')->with('id', $id);
		$view->firstName = Auth::user()->firstname;
		$view->lastName = Auth::user()->lastname;
		$view->name = $name;
		$view->email = Auth::user()->email;
		$view->username = Auth::user()->username;
		
		return $view; 
		
		}	else{

			return Redirect::to('clients');
		}
	}
	
	//controller for research/historical-queries by farzin  
	public function historicalQueries() 
    {
    	if(Auth::check()) {
			
			$id = Auth::user()->getId();
			$name = Auth::user()->getFullName();
			$urls = Research::all();	
		$view = View::make('research.historicalQueries')->with('id', $id); 
							
		$view->firstName = Auth::user()->firstname;
		$view->lastName = Auth::user()->lastname;
		$view->name = $name;
		$view->email = Auth::user()->email;
		$view->username = Auth::user()->username;
		
		return $view; 
		
		}	else{

			return Redirect::to('clients');
		}
    	
    }
    
    public function trends()
    {
        //Build user-site dictionary key'd on site
        $userId = Auth::user()->getId();
        $jsonData = UsersSite::where('user_id', $userId)->take(100)->get();
        $jsonDecoded = json_decode($jsonData, true);
                
        if (empty($jsonDecoded))
        {
            return View::make('research.trendsBlank');  
        }
        
        $sitesArray = [];
        
        foreach ($jsonDecoded as $entry)
        {
            //Add query and time to a single array
            $queryAndTime = [
                "query" => $entry["site_info"],
                "time" => $entry["created_at"],
            ];
            
            //Add the query time array to the 'dict' with site_url as the key
            if (isset($sitesArray[$entry["site_url"]])) //if an entry for that site already exists
            {   
                array_push($sitesArray[$entry["site_url"]], $queryAndTime);
            }
              else
            {
                $sitesArray[$entry["site_url"]] = [$queryAndTime];
            } 
           
       } 
        
        //Build the highchart site data from dict for both alexa and google ranks
        $dateString = "";
        $googleSeriesString = "";
        $alexaSeriesString = "";
        $mx15SeriesString = "";
        foreach($sitesArray as $siteName => $siteInfo)
        {
            $nameString = "{name: '" . $siteName . "', data: [";
            $googleSeriesString .= $nameString;
            $alexaSeriesString .= $nameString;
            $mx15SeriesString .= $nameString;
            
            // Build each individual query data entry
            foreach($siteInfo as $entry)
            {
               //Get the y-axis data, and check null data
               $siteInfo = $entry['query'];
               $decodedSiteInfo = json_decode($siteInfo, true);
               
               if (isset($decodedSiteInfo['google']))
                    $googleData = $decodedSiteInfo['google']['rank'];
               else
                    break;
                    
               if (isset($decodedSiteInfo['score']))
                    $mx15Data = $decodedSiteInfo['score'];
               else
                    break;
                    
                if (isset($decodedSiteInfo['alexa']))
                    $alexaData = $decodedSiteInfo['alexa']['rank'];
               else
                    break;
               
               $dateString = "[";
            
               //Build date string component
               //   * Format: Date.UTC( <year>, <month>, <day>, <hour>, <minute> ),
               $splitDateArray = preg_split( '/[- :]/', $entry['time']);
               $dateString .= "Date.UTC(";
               $dateString .= $splitDateArray['0'];
               $dateString .= ", ";
               $dateString .= $splitDateArray['1'];
               $dateString .= ", ";
               $dateString .= $splitDateArray['2'];
               $dateString .= ", ";
               $dateString .= $splitDateArray['3'];
               $dateString .= ", ";
               $dateString .= $splitDateArray['4'];
               $dateString .= "), ";
               
               $googleSeriesString .= $dateString;
               $alexaSeriesString .= $dateString;
               $mx15SeriesString .= $dateString;
               
               $googleSeriesString .= $googleData;
               $alexaSeriesString .= $alexaData;
               $mx15SeriesString .= $mx15Data;
               
               $googleSeriesString .= "],";
               $alexaSeriesString .= "],";
               $mx15SeriesString .= "],";
            }
            $googleSeriesString .= "]},";
            $alexaSeriesString .= "]},";
            $mx15SeriesString .= "]},";
        }
        
        return View::make('research.trends')->with('alexaSeries', $alexaSeriesString)->with('googleSeries', $googleSeriesString)->with('mx15Series', $mx15SeriesString);    
    }
 }

