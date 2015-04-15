<?php

class IndexController extends BaseController {
         /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{                	
		if (Auth::check())
		{
			 /* $id = Auth::user()->getId(); //don't need declared in base already
			$name = Auth::user()->getFullName(); //don't need declared in base already
			 $role = Auth::user()->role()->first()->role_id; // declared in Base
			  
			  */
		}
		
		$id = Auth::user()->getId();
		$jsonData = UsersSite::where('user_id', $id)->take(100)->get();
		$jsonDecoded = json_decode($jsonData, true);
		
		$maxEntry = null;
		$minEntry = null;
		
		if (empty($jsonDecoded))
		{
			return View::make("clients/index")->with('maxEntry', $maxEntry)->with('minEntry', $minEntry);
		}
		
		$maxEntry = $jsonDecoded[0];
		$minEntry = $jsonDecoded[0];
		
		foreach ($jsonDecoded as $entry)
		{
			$siteInfo = json_decode($entry['site_info'], true);			
			$maxInfo = json_decode($maxEntry['site_info'], true); 
			$minInfo = json_decode($minEntry['site_info'], true); 
			
			if ($siteInfo['score'] > $maxInfo['score'])
			{
				$maxEntry = $entry;
			}
			
			if ($siteInfo['score'] < $minInfo['score'])
			{
				$minEntry = $entry;
			}
		}
		
		
		return View::make("clients/index")->with('maxEntry', $maxEntry)->with('minEntry', $minEntry);
	}
       
	


}
