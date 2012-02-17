<?php
include_once("commonlib.php");
loadConfig("config.xml");

function acquireNews($searchTerm) {
	$config = loadConfig();
    $returnContent="";
	$newsConfig = $config['news'];
	
    $newsUri = $newsConfig['baseUri'] . "?format=xml&q=" . urlencode($searchTerm) . "&order-by=" . urlencode($newsConfig['orderBy']) . "&page-size=" . $newsConfig['numberOfResults'] . "&date-id=" . urlencode("date/" . $newsConfig['dates']);
    $newsData = simplexml_load_string(acquire_file($newsUri));
	
	foreach($newsData->results as $newsNode) {
		foreach ($newsNode as $newsDetail) {
			$returnContent[] = array((string) 'title' => $newsDetail['web-title'], 'url' => ($newsDetail['web-url']), 'date' => $newsDetail['web-publication-date']);
		}
	}
	return $returnContent;
}

?>
