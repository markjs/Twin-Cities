<?php

include("commonlib.php");

loadConfig("config.xml");

global $city1;
global $city1Country;
global $city2;
global $city2Country;

echo "<pre>";

function getTopArtists($num, $lfmMetro, $lfmCountry) {
	$count = 0;
	$ret =""; 
	
	$lastfmMethod;
	global $lastfmApiKey;
	global $lastfmMethod;
	
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

print_r(getTopArtists(10,$city1,$city1Country));
?>
