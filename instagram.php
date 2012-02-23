<?php

function instagramGetLatestPhotos($lat,$lng) {
	
	// Loading configxml into variable
	$config = loadConfig();
	// Storing instagram specific configs for more readable access
	$instagram = $config['instagram'];
	
	// Forming the request URI
	$request = $instagram['baseUri'] . "lat=" . $lat . "&lng=" . $lng . "&client_id=" . $instagram['clientId'];
	
	// Requesting the URI and decoding the response into a PHP object
	$response = json_decode(acquire_file($request));
	
	// Initialises $html variable so it can be appended to with the loop
	$html = "";
	// Initialises counter for the loop so the count can be limited
	$i = 0;

	// Foreach used so that if less than 4 items are returned the loop will stop
	foreach ($response->data as $entry) {
		if ($i < 4) {
			// Ensures image still has alt-text even if no instagram caption is provided
			if ($entry->caption->text == "") {
				$alt = "Instagram Image";
			} else {
				$alt = $entry->caption->text;
			}
			// Image data appended to $html, ready to be printed
			$html .= "<a href=\"" . $entry->link . "\"><img src=\"" . $entry->images->thumbnail->url . "\" alt=\"" . $alt . "\"/></a>";
		}
		$i++;
	}

	// $html returned, to be printed when the function is called
	return $html;
}

?>