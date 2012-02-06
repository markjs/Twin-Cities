<?php

include("commonlib.php");

?><details>
<?php loadConfig();
?>
</details>
<?php

echo "<pre>";

// https://api.instagram.com/v1/media/search?lat=48.858844&lng=2.294351&access_token=ACCESS-TOKEN

global $city1Lat;
global $city1Lng;
global $instagramClientId;

print_r(acquire_file("https://api.instagram.com/v1/media/search?lat=".$city1Lat."&lng=".$city1Lng."&client_id=".$instagramClientId));

?>
