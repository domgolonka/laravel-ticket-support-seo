<?php
include("class.MozscapeAPIclass.php");

class Researchurl
{
public static function searchMyUrl($url){
$url_searched = $url;
				echo"<h3>"; echo $url_searched; echo "</h3>"; 
				$api = new Mozscape_API_Class('member-a2ba05c944','fe14b1bdc8442b00909424f59b98bf91');
				$url_metrics = json_decode($api->urlMetrics($url_searched, 133714411517));
				ob_start();				
				var_dump($url_metrics);
				$site_info = ob_get_clean();
				$date = new \DateTime;				
				//store() in DB***************************************************************************	
				$research = new Research;
				$research->user_id    = $id;
				$research->site_url    = $url_searched;
				$research->site_info = $site_info;
				$research->created_at = $date;
				$research->save();
				//store() in DB***************************************************************************	
				echo "<br>";
				echo "
				<table>
    <tr>
      <th>"; 
        echo $api->responseFields('ut', 'name');
        echo "<p>"; echo $api->responseFields('ut', 'description'); echo "</p>
      </th>
      <td>"; echo $url_metrics->ut; echo "</td>
    </tr>
    <tr>
      <th>";
        echo $api->responseFields('uu', 'name'); echo "
        <p>"; echo $api->responseFields('uu', 'description'); echo "</p>
      </th>
      <td>"; echo $url_metrics->uu; echo "</td>
    </tr>
    <tr>
      <th>
        "; echo $api->responseFields('ueid', 'name'); echo "
        <p>"; echo $api->responseFields('ueid', 'description'); echo "</p>
      </th>
      <td>"; echo number_format($url_metrics->ueid); echo "</td>
    </tr>
    
    <tr>
      <th>";
         echo $api->responseFields('uid', 'name'); echo "
        <p>"; echo $api->responseFields('uid', 'description'); echo "</p>
      </th>
      <td>"; echo number_format($url_metrics->uid); echo "</td>
    </tr>
    <tr>
      <th>
        "; echo $api->responseFields('umrp', 'name'); echo "
        <p>"; echo $api->responseFields('umrp', 'description'); echo "</p>
      </th>
      <td>"; echo number_format($url_metrics->umrp); echo "</td>
    </tr>
    <tr>
      <th>
        "; echo $api->responseFields('fmrp', 'name'); echo "
        <p>"; echo $api->responseFields('fmrp', 'description'); echo "</p>
      </th>
      <td>"; echo number_format($url_metrics->fmrp); echo "</td>
    </tr>
    <tr>
      <th>
        "; echo $api->responseFields('us', 'name'); echo "
        <p>"; echo $api->responseFields('us', 'description'); echo "</p>
      </th>
      <td>"; echo $url_metrics->us; echo "</td>
    </tr>
    <tr>
      <th>
        "; echo $api->responseFields('upa', 'name'); echo "
        <p>"; echo $api->responseFields('upa', 'description'); echo "</p>
      </th>
      <td>"; echo number_format($url_metrics->upa); echo "</td>
    </tr> 
    <tr>
      <th>
        "; echo $api->responseFields('pda', 'name'); echo "
        <p>"; echo $api->responseFields('pda', 'description'); echo "</p>
      </th>
      <td>"; echo number_format($url_metrics->pda); echo "</td>
    </tr>        
</table> ";

return true;

}	
	

}
?>