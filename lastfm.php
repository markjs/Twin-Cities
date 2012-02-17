<?php

include_once("commonlib.php");

/**
 *
 * @param type $num The number of top artists to return
 * @param type $lfmMetro The city to get the top artists from
 * @param type $lfmCountry The country the city is in
 * @author Alexander Jegtnes
 * @version 1.0
 * @return array 
 */

function lastfmGetTopArtists($num, $lfmMetro, $lfmCountry) {
	
	$config = loadConfig();
	
	$count = 0;
	$ret =""; 
	
	$lastfmApiKey = $config['lastfm']['apiKey'];
	$lastfmMethod = $config['lastfm']['method'];
	
	@$lastfmUri = "http://ws.audioscrobbler.com/2.0/?method=" . $lastfmMethod . "&metro=" . urlencode($lfmMetro) . "&country=" . urlencode($lfmCountry) . "&api_key=" . $lastfmApiKey;
	$lastfmData = simplexml_load_string(acquire_file($lastfmUri));
	foreach($lastfmData->topartists->artist as $artistName) {
		$count++;
		if ($count <= $num) {
			//the casting is needed because SimpleXML objects are complex objects.
			//http://www.php.net/manual/en/ref.simplexml.php#91057
			$ret[] = (string) $artistName->name[0];
		}
	}
	
	return($ret);
}

?>
