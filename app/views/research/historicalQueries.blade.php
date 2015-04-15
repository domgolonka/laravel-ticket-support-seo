@extends('clients')
@section('content') 
<!-- Intro -->
<!-- <section class="site-section site-section-light site-section-top themed-background-flatie">
   
</section> -->
<!-- END Intro -->
<div class="container-fluid" >
	<h2>Past Searches</h2>
	<div class="researchForm"  >
		<?php
		//echo $id;
		
		echo "<br>";
		//$id = 16;
		$urls = DB::table('users_site')->where('user_id', $id)->select('site_url')->distinct()->get();
		$siteInfo = DB::table('users_site')->where('user_id', $id)->select('site_info')->distinct()->get();
		$creationTimes = DB::table('users_site')->where('user_id', $id)->select('created_at')->distinct()->get();
		
		$infor = DB::table('users_site')->where('user_id', $id)->select('site_url', 'site_info', 'created_at')->get();
		
		foreach($urls as $value){
		if(!isset($_POST['submit'])) {
				echo "
					<form method='post'>
						<input type='hidden' name='url' value = $value->site_url  class='refreshResearch'>
						<h3>$value->site_url</h3>
						<input name = 'submit' type='submit' value='Display' class='inputUrlSubmit'>		
					</form>	
				";
				
			} else { 
				
				$url = $_POST['url'];
				$inform = DB::table('users_site')->where('user_id', $id )->where('site_url', $url)->select('site_url', 'site_info', 'created_at')->orderBy('created_at', 'desc')->get();
				foreach ($inform as $inf){
					$thisSiteURL = $inf->site_url;					
					//echo '<br>';
					$thisCreationTime = $inf->created_at;
					//echo '<br>';
					$thisSiteInfo = $inf->site_info;
					//echo '<br>';
					$decoded = json_decode($inf->site_info, true);
					//var_dump($decoded);
					//echo '<br>';
					//it's working fine now cheers.
								
				echo "<div class='container-fluid' id='historicalSearches'>";
					echo '<h4>'; echo $inf->site_url; echo '<h4>';
					echo '<h6>'; echo $inf->created_at; echo '<h6>'; 
									
		
		?> 
		<div class="container-fluid" id="historicalSearchesTable">		
						<div class="col-md-9">
							<table>
							<h1 id="ranking">Ranking</h1>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="PageRank (commonly called PR) is a link analysis algorithm used by Google™ to assess the popularity/authority of a website. The PageRank goes from 0 to 10. New websites start at PR0 and authority websites, like Twitter.com, have a PR10.">Page Rank</div>
									</th>
									<td><?php echo $decoded['google']['rank']; ?></td>
								</tr>
                                                                <tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The normalized 10-point MozRank score of the URL.">Moz Rank</div>
									</th>
									<td><?php echo $decoded['mozrank']; ?></td>
								</tr>
                                                                <tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Rating of sites based on the number of visitors coming from the first 20 Google search results.">Sem Rank</div>
									</th>
									<td><?php echo $decoded['semrank']['Rk']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Your Alexa Rank is a good estimate of the worldwide traffic to your website, although it is not 100 percent accurate.">Traffic Rank</div>
									</th>
									<td><?php echo $decoded['alexa']['rank']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The number of people that are able to reach your website. That is, an approximate audience of your website">Traffic Reach</div>
									</th>
									<td><?php echo $decoded['alexa']['reach']; ?></td>
								</tr>
							</table>
							</div class="col-md-9">

							<div class="col-md-9">
							<table>	
								<tr><h1 id="optimize">Optimize</h1>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Web of Trust data based on how trustworthly your website is"> Web of Trust Ranking</div>
									</th>
									<td><?php echo $decoded['data']['WOT']; ?></td>
                                                                </tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="A normalized 100-point score representing the likelihood of the URL to rank well in search engine results."> Page Authority</div>
									</th>
									<td><?php echo $decoded['pmozauth']; ?></td>
                                                                 </tr>
                                                                 <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="A normalized 100-point score representing the likelihood of the domain of the URL to rank well in search engine results."> Domain Authority</div>
									</th>
									<td><?php echo $decoded['dmozauth']; ?></td>
								</tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Equity describes how central a URL is to the Internet. Equity describes the search engine results-boosting effect of any particular link between URLs."> Equity Links</div>
									</th>
									<td><?php echo $decoded['equitylinkcount']; ?></td>
								</tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Equity links boost a link target's search engine rating, potentially at the cost of some of the source page's equity."> External Equity Links</div>
									</th>
									<td><?php echo $decoded['mozexteneral']; ?></td>
								</tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The number of links (equity or nonequity or not, internal or external) to the URL."> Link Count</div>
									</th>
									<td><?php echo $decoded['linkcount']; ?></td>
								</tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Keywords bringing users to the website via Google top 20 organic search results."> Organic Keywords</div>
									</th>
									<td><?php echo $decoded['semrank']['Or']; ?></td>
								</tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Traffic brought to the website via Google top 20 organic search results."> Search Result Traffic</div>
									</th>
									<td><?php echo $decoded['semrank']['Or']; ?></td>
								</tr>
                                                                 <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Estimated price of organic keywords in Google AdWords.">Organic Keyword Price</div>
									</th>
									<td><?php echo $decoded['semrank']['Ot']; ?></td>
								</tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Keywords the website is buying in Google AdWords for ads that appear in paid search results.">Bought Search Traffic</div>
									</th>
									<td><?php echo $decoded['semrank']['Ad']; ?></td>
								</tr>
                                                                <tr>
                                                                        <th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Traffic brought to the website via Google AdWords paid search results.">Bought Traffic</div>
									</th>
									<td><?php echo $decoded['semrank']['At']; ?></td>
								</tr>

							</table>	
							</div>
							<div class="col-md-9">
							<table>
							<h1 id="misc">Misc</h1>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="A sitemap lists URLs that are available for crawling and can include additional information like your site's latest updates, frequency of changes and importance of the URLs. This allows search engines to crawl the site more intelligently.">Has a SiteMap</div>
									</th>
									<td><?php echo $decoded['hasSiteMap']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="A robots.txt file allows you to restrict the access of search engine robots that crawl the web and it can prevent these robots from accessing specific directories and pages. It also specifies where the XML sitemap file is located.">Has a robot text</div>
									</th>
									<td><?php echo $decoded['hasRobotTxt']; ?></td>
								</tr>
                                                                <tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="While Google treats hyphens (these-are-hyphens) as word separators, it does not treat underscores as word separators.">Has Underscore in Domain</div>
									</th>
									<td><?php echo $decoded['hasUnderScore']; ?></td>
								</tr>
							</table>	
							</div>
							<div class="col-md-9">
							<table>
							<h1 id="tech">Technology - Server Information</h1>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Your IP address has limited Geographical impact on Search results.">IPv4</div>
									</th>
									<td><?php echo $decoded['data']['ipv4']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Your IP address has limited Geographical impact on Search results.">IPv6</div>
									</th>
									<td><?php echo $decoded['data']['ipv6']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="Your Country has limited Geographical impact on Search results.">Country</div>
									</th>
									<td><?php echo $decoded['data']['countrycode']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The age of the domain has some impact on search results. The older the more authority it has.">Age</div>
									</th>
									<td><?php echo $decoded['data']['age']; ?></td>
								</tr>
							</table>
							</div>
							<div class="col-md-9">
							<table>
							<h1 id="social">Social</h1>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Google Plus Shares. These metrics have limited impact on search results.">Google Plus Shares</div>
									</th>
									<td><?php echo $decoded['googleplus']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Facebook fans. These metrics have limited impact on search results.">Facebook Total</div>
									</th>
									<td><?php echo $decoded['facebook']['total_count']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Facebook Shares. These metrics have limited impact on search results.">Facebook Shares</div>
									</th>
									<td><?php echo $decoded['facebook']['share_count']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Facebook Likes. These metrics have limited impact on search results.">Facebook Likes</div>
									</th>
									<td><?php echo $decoded['facebook']['like_count']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of facebook comments. These metrics have limited impact on search results.">Facebook Comments</div>
									</th>
									<td><?php echo $decoded['facebook']['comment_count']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Facebook Ad Clicks. These metrics have limited impact on search results.">Facebook Click Count</div>
									</th>
									<td><?php echo $decoded['facebook']['click_count']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total count of Twitter mentions for a URL. These metrics have limited impact on search results.">Twitter Shares</div>
									</th>
									<td><?php echo $decoded['twitter']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The Total number of Delicious Shares. These metrics have limited impact on search results.">Delicious Shares</div>
									</th>
									<td><?php echo $decoded['delicious']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Digg.com Shares. These metrics have limited impact on search results.">Digg Shares</div>
									</th>
									<td><?php echo $decoded['digg']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Linkedin Shares. These metrics have limited impact on search results.">Linkedin Shares</div>
									</th>
									<td><?php echo $decoded['linkedin']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of Pinterest Shares. These metrics have limited impact on search results.">Pinterest Shares</div>
									</th>
									<td><?php echo $decoded['pinterest']; ?></td>
								</tr>
								<tr>
									<th>
										<div class="enable-tooltip" data-toggle="tooltip" title="The total number of SumbleUpon Shares. These metrics have limited impact on search results.">Stumbleupon Shares</div>
									</th>
									<td><?php echo $decoded['stumbleupon']; ?></td>
								</tr>						
							</table>
							</div>
							</br>
							</br>
							<div class="col-md-9">	
							<?php	
							if (array_key_exists('lastUpdated', $decoded)){		
								echo "<p>LAST UPDATED : ".$decoded['lastUpdated']."<p>";
							} 
							?>

							<?php	
							if (array_key_exists('created', $decoded)){		
								echo "<p>CREATION DATE : ".$decoded['created']."<p>";
							} 
							?>
							</div>	                          
						</div>
					</div>	
		<?php }	
		break;}//
		
		//echo '<br>';
	}
		?> 
		</div>
	</div>
 
		



@stop

@section('postscripts')
<script src="{{ URL::asset('js/pages/index-front.js') }}"></script>
<script>$(function() {
Index.init();
});</script>

@stop