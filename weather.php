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
	
	$html = "<img src=\"$imgUrl\" alt=\"$summary\" class=\"weatherpicture\"/><h5 class=\"summary\">$summary, $temp&#8451;</h5>";
		
	return $html;
}


function weatherGetFutureWeather($cityName,$daysFromNow) {
	
	$config = loadConfig();
	$weather = $config['weather'];
				
	$request = $weather['baseUri'] . urlencode($cityName);
	
	$response = simplexml_load_string(acquire_file($request));
	
	$conditions = $response->weather->forecast_conditions[$daysFromNow];
	
	$summary = $conditions->condition['data'];
	$day = $conditions->day_of_week['data'];
	$temp_low = farenheitToCelcius($conditions->low['data']);
	$temp_high = farenheitToCelcius($conditions->high['data']);
	$imgUrl = "http://google.com/" . $conditions->icon['data'];
	
	$html = "<p>$day</p><img src=\"$imgUrl\" alt=\"$summary\" class=\"weatherpicture\"/><h5 class=\"summary\">$summary, $temp_low&#8451; - $temp_high&#8451;</h5>";
		
	return $html;
}

function farenheitToCelcius($temp) {
	return round(($temp-32)*(5/9));
}

?>
