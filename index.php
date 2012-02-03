<?php
include("commonlib.php");

$configFile = "config.xml";

if (file_exists($configFile)) {
	$configXml = simplexml_load_file($configFile);
	print_r($configXml);
	echo "<br /><pre>";
	
	$city1 = $configXml->shared->city1->name;
	$city2 = $configXml->shared->city2->name;
	$city1Country = $configXml->shared->city1->country;
	$city2Country = $configXml->shared->city2->country;
	
	$lastfmMethod = $configXml->lastfm->method;
	$lastfmApiKey = $configXml->lastfm->apiKey;
}

else die("Can't access configuration file.");

?>
