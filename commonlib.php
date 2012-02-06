<?php

$configFile = "config.xml";

function isInUwe() {
    $currentUri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	 
    //If you're currently in UWE
    if(stristr($currentUri,'cems.uwe.ac.uk')) {
        return true;
    }
    else return false;
}

function acquire_file($uri) {
	if (isInUwe()) {
		$context = stream_context_create(
		 //TODO: Use cURL
		 array('http'=>
			  array('proxy'=>'proxysg.uwe.ac.uk:8080',
					  'header'=>'Cache-Control: no-cache'
					 )
		  ));  

		 $contents = file_get_contents($uri,false,$context);
		 return $contents;
    }
    
    else{
		 file_get_contents($uri);
    }
};

function loadConfig($configFile) {

	if (file_exists($configFile)) {
	$configXml = simplexml_load_file($configFile);
	
	// this is for testing, remove before submission!
	print_r($configXml);
	echo "<br /><pre>";
	 
	global $city1, $city2, $city1Country, $city2Country, $lastfmMethod, $lastfmApiKey, $lastfmResults;

	$city1 = $configXml->shared->city1->name;
	$city2 = $configXml->shared->city2->name;
	$city1Country = $configXml->shared->city1->country;
	$city2Country = $configXml->shared->city2->country;

	$city1Lat = $configXml->shared->city1->lat;
	$city1Long = $configXml->shared->city1->long;
	$city2Lat = $configXml->shared->city2->lat;
	$city2Long = $configXml->shared->city2->long;
	
	
	$lastfmMethod = $configXml->lastfm->method;
	$lastfmApiKey = $configXml->lastfm->apiKey;
	$lastfmResults = $configXml->lastfm->results;
	
	$instagramClientId = $configXml->instagram->clientId;
	$instagramClientSecret = $configXml->instagram->clientSecret;
}

else die("Can't access configuration file.");
	
}

?>