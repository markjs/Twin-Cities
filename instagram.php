<?php

include("commonlib.php");

loadConfig("config.xml");

echo "<pre>";

// https://api.instagram.com/v1/media/search?lat=48.858844&lng=2.294351&access_token=ACCESS-TOKEN

print_r(acquire_file("https://api.instagram.com/v1/media/search?lat=$city1Lat&lng=$city2Long&client_id=$instagramClientId"));

?>
