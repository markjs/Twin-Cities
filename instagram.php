<?php

include_once("commonlib.php");


// https://api.instagram.com/v1/media/search?lat=48.858844&lng=2.294351&access_token=ACCESS-TOKEN

function instagramGetLatestPhotos($lat,$lng) {
	
	$config = loadConfig();
	
	$instagram = $config['instagram'];
	
	$request = $instagram['baseUri'] . "lat=" . $lat . "&lng=" . $lng . "&client_id=" . $instagram['clientId'];
	
	$response = json_decode(acquire_file($request));
	
	$html = "";
	
	for ($i=0; $i < 5; $i++) { 
		$entry = $response[$i];
		$html .= "<img src=\"" . $entry->images->standard_resolution->url . "\" alt=\"" . $entry->caption->text . "\"/>";
	}
	
	// foreach ($response->data as $entry) {
	// 	$html .= "<img src=\"" . $entry->images->standard_resolution->url . "\" alt=\"" . $entry->caption->text . "\"/>";
	// }
	
	return $html;
}
echo "<pre>";

print_r(instagramGetLatestPhotos(32.7153292,-117.1572551));


?>
