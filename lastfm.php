<?php

include_once("commonlib.php");

/**
 * @
 * @param type $num The number of top artists to return
 * @param type $lfmMetro The city to get the top artists from
 * @param type $lfmCountry The country the city is in
 * @author Alexander Jegtnes <alexander2.jegtnes@live.uwe.ac.uk>
 * @version 2.0
 * @return array Returns an associative array with the top artists, the artist picture and the artist URL
 */

function lastfmGetTopArtists($num, $lfmMetro, $lfmCountry) {
	
	//loads configuration and sets up initial variables
	$config = loadConfig();
	$count = 0;
	$ret =""; 
	$lastfmApiKey = $config['lastfm']['apiKey'];
	$lastfmMethod = $config['lastfm']['method'];
	
	//assembles the request URI for the API
	@$lastfmUri = "http://ws.audioscrobbler.com/2.0/?method=" . $lastfmMethod . "&metro=" . urlencode($lfmMetro) . "&country=" . urlencode($lfmCountry) . "&api_key=" . $lastfmApiKey;
	
	//gets the XML data
	$lastfmData = simplexml_load_string(acquire_file($lastfmUri));
	
	//loops through it and makes sure to only get as many artists as is specified
	//the count is needed because the last.fm API doesn't easily provide the ability to return a set number of artists
	
	foreach($lastfmData->topartists->artist as $artistName) {
		$count++;
		if ($count <= $num) {
			
			//the casting is needed because SimpleXML objects are complex objects.
			//http://www.php.net/manual/en/ref.simplexml.php#91057
			$ret[] = array((string) 'name' => $artistName->name[0], 'image' => $artistName->image[2], 'url' => $artistName->url[0]);
		}
	}
	return($ret);
}

?>
