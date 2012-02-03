<?php

function getTopArtists($num, $lfmMetro, $lfmCountry) {
    $ret ="";
    global $lastfmMethod;
    global $lastfmApiKey;
    $lastfmUri = "http://ws.audioscrobbler.com/2.0/?method=" . $lastfmMethod . "&metro=" . urlencode($lfmMetro) . "&country=" . urlencode($lfmCountry) . "&api_key=" . $lastfmApiKey;
    $lastfmData = simplexml_load_string(acquire_file($lastfmUri));
	foreach($lastfmData->topartists->artist as $artistName) {
		$ret .= $artistName->name . " ";
	}
	return(var_dump($ret));
}
getTopArtists(10,"Edinburgh","United Kingdom");
?>
