

<?php

include_once("commonlib.php");
$config = loadConfig();

function twitterGetTweets($lat, $lng) { 

$config = loadConfig();
$count = 0;
$post =""; 
$twitterFeed = simplexml_load_string(acquire_file('http://search.twitter.com/search.atom?oauth_consumer_key=4wXTXMcxJbbMIakpRYg&geocode=' . $lat . "," . $lng . ',10mi&lang=en&include_entities=true&result_type=recent+exclude:retweets+exclude:replies'));
	foreach($twitterFeed->entry as $tweet) { 
	$count++;
        if ($count <= 6) {
		$post[] = array('authorname' => (string) $tweet->author->name[0],'authorurl' => (string) $tweet->author->uri[0],'content' => (string) $tweet->content[0],'tweeturi' => (string) $tweet->link['href']);
        
        }     		

	}
return $post;
}

 /* $twitter = simplexml_load_string(acquire_file('http://search.twitter.com/search.atom?geocode=32.71533,-117.157256,10mi&lang=en&include_entities=true&result_type=recent')); */
?>

