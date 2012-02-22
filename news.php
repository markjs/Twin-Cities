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
	$config = loadConfig();
    $returnContent="";
	
	//assembles the request URI to the API
    $newsUri = $config['news']['baseUri'] . "?format=xml" . "&q=" . urlencode($searchTerm) . "&order-by=" . urlencode($config['news']['orderBy']) . "&page-size=" . $config['news']['numberOfResults'] . "&date-id=" . urlencode("date/" . $config['news']['dates']);
	
    $newsData = simplexml_load_string(acquire_file($newsUri));
	
	foreach($newsData->results as $newsNode) {
		foreach ($newsNode as $newsDetail) {
			$returnContent[] = array((string) 'title' => $newsDetail['web-title'], 'url' => ($newsDetail['web-url']), 'date' => $newsDetail['web-publication-date']);
		}
	}
	return $returnContent;
}
?>
