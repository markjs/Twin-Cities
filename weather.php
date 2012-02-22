<?php

include_once("commonlib.php");


function weatherGetCurrentWeather($cityName) {
	
	$config = loadConfig();
	$weather = $config['weather'];
				
	$request = $weather['baseUri'] . urlencode($cityName);
	
	$response = simplexml_load_string(acquire_file($request));
	
	$summary = $response->weather->current_conditions->condition['data'];
	$temp = $response->weather->current_conditions->temp_c['data'];
	$imgUrl = "http://google.com/" . $response->weather->current_conditions->icon['data'];
	
	$html = "<img src=\"$imgUrl\" alt=\"$summary\"/><p>$summary</p><p>$temp</p>";
		
	return $html;
}

echo weatherGetCurrentWeather("san diego");

?>
