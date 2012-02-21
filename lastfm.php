<?php

include_once("commonlib.php");

/**
 *
 * @param type $num The number of top artists to return
 * @param type $lfmMetro The city to get the top artists from
 * @param type $lfmCountry The country the city is in
 * @author Alexander Jegtnes
 * @version 1.0
 * @return array Returns a simple, indexed array with the top artists
 */

function lastfmGetTopArtists($num, $lfmMetro, $lfmCountry) {
	
	$config = loadConfig();
	
	$count = 0;
	$ret =""; 
	
	$lastfmApiKey = $config['lastfm']['apiKey'];
	$lastfmMethod = $config['lastfm']['method'];
	
	//assembles the request URI for the API
	@$lastfmUri = "http://ws.audioscrobbler.com/2.0/?method=" . $lastfmMethod . "&metro=" . urlencode($lfmMetro) . "&country=" . urlencode($lfmCountry) . "&api_key=" . $lastfmApiKey;
	
	$lastfmData = simplexml_load_string(acquire_file($lastfmUri));
	foreach($lastfmData->topartists->artist as $artistName) {
		$count++;
		if ($count <= $num) {
			//the casting is needed because SimpleXML objects are complex objects.
			//http://www.php.net/manual/en/ref.simplexml.php#91057
			$ret[] = array((string) 'name' => $artistName->name[0], 'image' => $artistName->image[2]);
		}
	}
	return($ret);
}

//echo "<pre>";
//print_r(lastfmGetTopArtists(10, "Edinburgh", "United Kingdom"));
//echo "</pre>";


?>
