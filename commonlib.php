<?php

function isInUwe() {
    
    $currentUri = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    //If you're currently in UWE
    if(stristr($currentUri,'cems.uwe.ac.uk')) {
        return true;
    }
    else return false;
}

function acquire_file($uri) {
 
    if (isInUwe()) {
    $context = stream_context_create(
            //TODO: Use cURL
    array('http'=>
        array('proxy'=>'proxysg.uwe.ac.uk:8080',
              'header'=>'Cache-Control: no-cache'
             )
     ));  
    $contents = file_get_contents($uri,false,$context);
    return $contents;
    }
    
    else{
        file_get_contents($uri);
    }
};
?>