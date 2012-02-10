<?php
include_once("commonlib.php");
loadConfig("config.xml");

function acquireNews($searchTerm) {
    global $newsBaseUri, $newsOrderBy, $newsResultNum, $newsDates;
    $uriString = $newsBaseUri . "?format=xml&q=" . urlencode($searchTerm) . "&order-by=" . urlencode($newsOrderBy) . "&page-size=" . $newsResultNum . "&date-id=" . urlencode("date/" . $newsDates);
}

echo acquireNews("Edinburgh");

?>
