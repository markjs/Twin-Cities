<?php

include_once("commonlib.php");


function weatherGetCurrentWeather($cityName) {
	
	$config = loadConfig();
	$weather = $config['weather'];
				
	$request = $weather['baseUri'] . urlencode($cityName);
	
	$response = simplexml_load_string(acquire_file($request));
		
	return $response->weather->current_conditions->condition['data'];
}

echo weatherGetCurrentWeather("edinburgh");

?>
