<?php
include_once("commonlib.php");
loadConfig("config.xml");

function acquireNews($searchTerm) {
	$config = loadConfig();
    $returnContent="";
	
	
	$newsConfig = $config['news'];
    global $newsBaseUri, $newsOrderBy, $newsResultNum, $newsDates;
    $newsUri = $newsConfig['baseUri'] . "?format=xml&q=" . urlencode($searchTerm) . "&order-by=" . urlencode($newsConfig['orderBy']) . "&page-size=" . $newsConfig['numberOfResults'] . "&date-id=" . urlencode("date/" . $newsConfig['dates']);
    $newsData = simplexml_load_string(acquire_file($newsUri));
	echo $newsUri . "<pre>";
	//print_r($newsdata->results)
	foreach($newsData->results as $newsNode) {
		foreach ($newsNode as $newsDetail) {
			$returnContent[] = (string) ($newsDetail['web-title']);
		}
	}
	return $returnContent;
}

print_r(acquireNews("Edinburgh"));

?>
