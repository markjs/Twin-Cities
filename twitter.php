

<?php

include_once("commonlib.php");
echo "<pre>";
$config = loadConfig();

function twitterGetTweets($lat, $lng) { 

$config = loadConfig();
$count = 0;
$post =""; 
$twitterFeed = simplexml_load_string(acquire_file('http://search.twitter.com/search.atom?geocode=' . $lat . "," . $lng . ',10mi&lang=en&include_entities=true&result_type=recent+exclude:retweets+exclude:replies'));
	foreach($twitterFeed->entry as $tweet) {
		
		$post[] = (string) $tweet->author->name[0];
		$post[] = (string) $tweet->author->uri[0];
		$post[] = (string) $tweet->content[0];

		

	}
return $post;
}

print_r (twitterGetTweets($config['city1']['lat'], $config['city1']['lng']));









 /* $twitter = simplexml_load_string(acquire_file('http://search.twitter.com/search.atom?geocode=32.71533,-117.157256,10mi&lang=en&include_entities=true&result_type=recent')); */
?>

