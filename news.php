<?php

include_once("commonlib.php");

/**
 *
 * @param type $searchTerm The term to search for in the Guardian Open API
 * @author Alexander Jegtnes <alexander2.jegtnes@live.uwe.ac.uk>
 * @version 1.0
 * @return array Returns an associative array of the news title, the url and the publication date
 */

function acquireNews($searchTerm) {
	
	//initialises variables
	$config = loadConfig();
    $returnContent="";
	
	//assembles the request URI to the API
    $newsUri = $config['news']['baseUri'] . "?format=xml" . "&q=" . urlencode($searchTerm) . "&order-by=" . urlencode($config['news']['orderBy']) . "&page-size=" . $config['news']['numberOfResults'] . "&date-id=" . urlencode("date/" . $config['news']['dates']);
	
	//loads all the XML data
    $newsData = simplexml_load_string(acquire_file($newsUri));
	
	//loops through the data as required
	foreach($newsData->results as $newsNode) {
		foreach ($newsNode as $newsDetail) {
			//the string casting is needed because SimpleXML objects are complex objects.
			//http://www.php.net/manual/en/ref.simplexml.php#91057
			$returnContent[] = array((string) 'title' => $newsDetail['web-title'], 'url' => ($newsDetail['web-url']), 'date' => $newsDetail['web-publication-date']);
		}
	}
	return $returnContent;
}
?>
