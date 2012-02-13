

<?php

include("commonlib.php");
loadConfig("config.xml");

$ed = $city1Lat . "," . $city1Lng;

$sd = $city2Lat . "," . $city2Lng;

$twitter2 = simplexml_load_string(acquire_file('http://search.twitter.com/search.atom?geocode=' . $sd . ',10mi&lang=en&include_entities=true&result_type=recent'));

/* $twitter = simplexml_load_string(acquire_file('http://search.twitter.com/search.atom?geocode=32.71533,-117.157256,10mi&lang=en&include_entities=true&result_type=recent')); */

print_r ($twitter);

?>