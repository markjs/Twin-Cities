

<?php
/* loads our common library */
include_once("commonlib.php");

/* Start Twitter function */
function twitterGetTweets($lat, $lng) { 

/* loads xml config file */
$config = loadConfig();

/* initialises my count and post variables */
$count = 0;
$post =""; 

/* fetches my xml query from twitter */
$twitterFeed = simplexml_load_string(acquire_file('http://search.twitter.com/search.atom?oauth_consumer_key=4wXTXMcxJbbMIakpRYg&geocode=' . $lat . "," . $lng . ',10mi&lang=en&include_entities=true&result_type=recent+exclude:retweets+exclude:replies'));

/* loops though returned xml and stores it in arrayception */
	foreach($twitterFeed->entry as $tweet) { 
	$count++;
        if ($count <= 6) { /* counts 6 tweets */
		$post[] = array('authorName' => (string) $tweet->author->name[0],'authorUrl' => (string) $tweet->author->uri[0],'content' => (string) $tweet->content[0],'tweetUrl' => (string) $tweet->link['href']);
        
        }     		

	}
return $post; /* returns the contents of $post */
}


?>

