<?php

include_once("commonlib.php");


function weatherGetCurrentWeather($cityName) {
	
	$config = loadConfig();
	$weather = $config['weather'];
				
	$request = $weather['baseUri'] . urlencode($cityName);
	
	$response = simplexml_load_string(acquire_file($request));
	
	$conditions = $response->weather->current_conditions;
	
	$summary = $conditions->condition['data'];
	$temp = $conditions->temp_c['data'];
	$imgUrl = "http://google.com/" . $conditions->icon['data'];
	
	$html = "<img src=\"$imgUrl\" alt=\"$summary\"/><p>$summary</p><p>$temp</p>";
		
	return $html;
}


function weatherGetFutureWeather($cityName,$daysFromNow) {
	
	$config = loadConfig();
	$weather = $config['weather'];
				
	$request = $weather['baseUri'] . urlencode($cityName);
	
	$response = simplexml_load_string(acquire_file($request));
	
	$conditions = $response->weather->forecast_conditions[$daysFromNow];
	
	$summary = $conditions->condition['data'];
	$temp_low = farenheitToCelcius($conditions->low['data']);
	$temp_high = farenheitToCelcius($conditions->high['data']);
	$imgUrl = "http://google.com/" . $conditions->icon['data'];
	
	$html = "<img src=\"$imgUrl\" alt=\"$summary\"/><p>$summary</p><p>$temp_low</p><p>$temp_high</p>";
		
	return $html;
}

function farenheitToCelcius($temp) {
	return round(($temp-32)*(5/9));
}

?>
