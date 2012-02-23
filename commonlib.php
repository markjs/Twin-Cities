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
	if (isInUwe() == true) {
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
		 return file_get_contents($uri);
    }
};

function loadConfig() {
	
	global $configFile;
	if (file_exists($configFile)) {
	$configXml = simplexml_load_file($configFile);

	// This pulls all the fields from the XML file and stores them in the config array, ready to be accessed by the other functions.
	$config['city1'] = array(
		'name'=>$configXml->shared->city1->name,
		'country'=>$configXml->shared->city1->country,
		'lat'=>$configXml->shared->city1->lat,
		'lng'=>$configXml->shared->city1->long);
	$config['city2'] = array(
		'name'=>$configXml->shared->city2->name,
		'country'=>$configXml->shared->city2->country,
		'lat'=>$configXml->shared->city2->lat,
		'lng'=>$configXml->shared->city2->long);
	$config['news'] = array(
		'baseUri'=>$configXml->news->baseUri,
		'orderBy'=>$configXml->news->orderBy,
		'numberOfResults'=>$configXml->news->resultNum,
		'dates'=>$configXml->news->dates);
	$config['lastfm'] = array(
		'method'=>$onfigXml->lastfm->method,
		'apiKey'=>$configXml->lastfm->apiKey,
		'numberOfResults'=>$configXml->lastfm->results);
	$config['instagram'] = array(
		'clientId'=>$configXml->instagram->clientId,
		'clientSecret'=>$configXml->instagram->clientSecret,
		'baseUri'=>$configXml->instagram->baseUri);
	$config['weather'] = array(
		'baseUri'=>$configXml->weather->baseUri);
	
	// The config array is then returned so it can be accessed for use by the other functions
	return $config;
}

else die("Can't access configuration file.");
	
}
?>