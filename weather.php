<?php

function weatherGetCurrentWeather($cityName) {
	
	// Loading configxml into variable
	$config = loadConfig();
	// Storing weather specific configs for more readable access
	$weather = $config['weather'];
	
	// Forming the request URI
	$request = $weather['baseUri'] . urlencode($cityName);
	
	// Requesting the URI and decoding the response into a PHP object
	$response = simplexml_load_string(acquire_file($request));
	
	// Storing current conditions into a variable for more readable code
	$conditions = $response->weather->current_conditions;
	
	// Getting specific data and storing into variables ready for printing
	$summary = $conditions->condition['data'];
	$temp = $conditions->temp_c['data'];
	$imgUrl = "http://google.com/" . $conditions->icon['data'];
	
	// Forming the $html variable to be printed
	$html = "<img src=\"$imgUrl\" alt=\"$summary\" class=\"weatherpicture\"/><h5 class=\"summary\">$summary, $temp&#176;C</h5><div class=\"clear\"></div>";

	// $html returned, to be printed when the function is called		
	return $html;
}


function weatherGetFutureWeather($cityName,$daysFromNow) {
	
	// Loading configxml into variable
	$config = loadConfig();
	// Storing weather specific configs for more readable access
	$weather = $config['weather'];
	
	// Forming the request URI					
	$request = $weather['baseUri'] . urlencode($cityName);

	// Requesting the URI and decoding the response into a PHP object	
	$response = simplexml_load_string(acquire_file($request));
	
	// Storing the forecast conditions into a variable for more readable code
	// Including $daysFromNow variable to return forecast for a specific day
	$conditions = $response->weather->forecast_conditions[$daysFromNow];

	// Getting specific data and storing into variables ready for printing	
	$summary = $conditions->condition['data'];
	$day = $conditions->day_of_week['data'];
	// Passing temperatures through the unit conversion function
	$temp_low = fahrenheitToCelsius($conditions->low['data']);
	$temp_high = fahrenheitToCelsius($conditions->high['data']);
	$imgUrl = "http://google.com/" . $conditions->icon['data'];
	
	// Forming the $html variable to be printed
	$html = "<h5 class=\"day\">$day</h5><img src=\"$imgUrl\" alt=\"$summary\" class=\"weatherpicturesmall\"/><p class=\"summarysmall\">Outlook: $summary, Low: $temp_low&#176;C, High: $temp_high&#176;C</p>";
	
	// $html returned, to be printed when the function is called	
	return $html;
}

function fahrenheitToCelsius($temp) {
	// Simply reads in a number and returns the converted and rounded value
	return round(($temp-32)*(5/9));
}

?>