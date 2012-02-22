<?php

include_once("commonlib.php");
$config = loadConfig("config.xml");
$city1 = $config['city1'];
$city2 = $config['city2'];

?>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyCmsUrnImKjRK8QTKOhXvSWW-wPXsvIvxU" type="text/javascript"></script>

<style>
	body > div {
		width:500px;
		height:500px;
	}
</style>

<?php

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
	
	     // Create the KML Overlay
	   
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
