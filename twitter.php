

<?php

include("commonlib.php");
loadConfig("config.xml");

if (file_exists( acquire_file('http://search.twitter.com/search.atom?geocode=32.71533,-117.157256,10mi&lang=en&include_entities=true&result_type=recent'))) {
    $sdtwitterxml = simplexml_load_file(acquire_file('http://search.twitter.com/search.atom?geocode=32.71533,-117.157256,10mi&lang=en&include_entities=true&result_type=recent'));
 
    print_r($sdtwitterxml);
	
} else {
    exit('Failed to open test.xml.');
}
?>