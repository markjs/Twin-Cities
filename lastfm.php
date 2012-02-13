<?php

include_once("commonlib.php");

echo "<pre>";


/**
 *
 * @global type $lastfmApiKey The last.fm API key.
 * @global type $lastfmMethod The API method used
 * @param type $num How many results are returned
 * @param type $lfmMetro The city to use.
 * @param type $lfmCountry The country the city is in.
 * @return array
 * @author Alexander Jegtnes
 * 
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
