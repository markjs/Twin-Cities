<?php

include_once("commonlib.php");


// https://api.instagram.com/v1/media/search?lat=48.858844&lng=2.294351&access_token=ACCESS-TOKEN

function instagramGetLatestPhotos($num) {
	
	$config = loadConfig();
	
	$instagramConfig = $config['instagram'];
	
}

print_r(instagramGetLatestPhotos(10));


?>
