<?php

include_once("commonlib.php");


// https://api.instagram.com/v1/media/search?lat=48.858844&lng=2.294351&access_token=ACCESS-TOKEN

function instagramGetLatestPhotos($lat,$lng) {
	
	$config = loadConfig();
	
	$instagram = $config['instagram'];
	
	$request = $instagram['baseUri'] . "lat=" . $lat . "&lng=" . $lng . "&client_id=" . $instagram['clientId'];
	
	$response = json_decode(acquire_file($request));
	
	$html = "";

	$i = 0;

	foreach ($response->data as $entry) {
		if ($i < 4) {
			$html .= "<a href=\"" . $entry->images->standard_resolution->url . "\"><img src=\"" . $entry->images->thumbnail->url . "\" alt=\"" . $entry->caption->text . "\"/></a>";
		}
		$i++;
	}
	
	return $html;
}

?>
