<?php

include_once("commonlib.php");
$config = loadConfig("config.xml");
$city1 = $config['city1'];
$city2 = $config['city2'];


function renderMap($lat,$lng) {
	
	$divId = "map-" . md5($lat . $lng);
	$div = "<div class=\"map\" id=\"$divId\"></div>";
	
	$script = "<script type=\"text/javascript\">
	   //<![CDATA[
	   
	   if (GBrowserIsCompatible()) { 
	
	     var cityMap1 = new GMap2(document.getElementById(\"$divId\"));
	     cityMap1.addControl(new GLargeMapControl());
	     cityMap1.addControl(new GMapTypeControl());
	     cityMap1.setCenter(new GLatLng($lat,$lng), 13);
	
	     // Create the KML Overlay (hosted externally for Google to be able to tunnel in and retrieve the file)
			
	     var cityOverlay1 = new GGeoXml(\"http://www.charlietizard.com/places.kml\");
	     cityMap1.addOverlay(cityOverlay1);
	
	   }
	   
	   // display a warning if the browser was not compatible
	   else {
	     alert(\"Sorry, the Google Maps API is not compatible with this browser\");
	   }
	
	   //]]>
	   </script>";
	
	return $div . $script;
	
}

?>
