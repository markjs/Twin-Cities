<?php

include("commonlib.php");

loadConfig("config.xml");

$lastfmMethod;
$lastfmApiKey;
$city1;
$city1Country;
$city2;
$city2Country;

echo $city1;

function getTopArtists($num, $lfmMetro, $lfmCountry) {
    $ret ="";
    
    $lastfmUri = "http://ws.audioscrobbler.com/2.0/?method=" . $lastfmMethod . "&metro=" . urlencode($lfmMetro) . "&country=" . urlencode($lfmCountry) . "&api_key=" . $lastfmApiKey;
    $lastfmData = simplexml_load_string(acquire_file($lastfmUri));
	foreach($lastfmData->topartists->artist as $artistName) {
		$ret .= $artistName->name . " ";
	}
	return(var_dump($ret));
}
getTopArtists(10,"Edinburgh","United Kingdom");
?>
