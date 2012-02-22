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
	
	$html = "<img src=\"$imgUrl\" alt=\"$summary\" class=\"weatherpicture\"/><h5 class=\"summary\">$summary, $temp&#176;C</h5><div class=\"clear\"></div>";
		
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
	$temp_low = farenheitToCelsius($conditions->low['data']);
	$temp_high = farenheitToCelsius($conditions->high['data']);
	$imgUrl = "http://google.com/" . $conditions->icon['data'];
	
	$html = "<h5 class=\"day\">$day</h5><img src=\"$imgUrl\" alt=\"$summary\" class=\"weatherpicturesmall\"/><p class=\"summarysmall\">Outlook: $summary, Low: $temp_low&#176;C, High: $temp_high&#176;C</p>";
		
	return $html;
}

function farenheitToCelsius($temp) {
	return round(($temp-32)*(5/9));
}

?>
