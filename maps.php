<?php

include_once("commonlib.php");
$config = loadConfig("config.xml");
$city1 = $config['city1'];
$city2 = $config['city2'];
?>

<!DOCTYPE html>     
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Google Maps</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyCmsUrnImKjRK8QTKOhXvSWW-wPXsvIvxU" type="text/javascript"></script>
  </head>
  <body onunload="GUnload()">


    <div id="cityMap1" style="width: 768px; height: 512px"></div>
	<div id="cityMap2" style="width: 768px; height: 512px"></div>
   <script type="text/javascript">
    //<![CDATA[
    
    if (GBrowserIsCompatible()) { 

      var cityMap1 = new GMap2(document.getElementById("cityMap1"));
      cityMap1.addControl(new GLargeMapControl());
      cityMap1.addControl(new GMapTypeControl());
      cityMap1.setCenter(new GLatLng(<?php echo $city1['lat'] . "," . $city1['lng']; ?>), 13);

      // Create the KML Overlay
    
      var cityOverlay1 = new GGeoXml("http://www.charlietizard.com/places.kml");
      cityMap1.addOverlay(cityOverlay1);

    }
    
    // display a warning if the browser was not compatible
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }

    //]]>
    </script>
	
	<script type="text/javascript">
    //<![CDATA[
    
    if (GBrowserIsCompatible()) { 

      var cityMap2 = new GMap2(document.getElementById("cityMap2"));
      cityMap2.addControl(new GLargeMapControl());
      cityMap2.addControl(new GMapTypeControl());
      cityMap2.setCenter(new GLatLng(<?php echo $city2['lat'] . "," . $city2['lng']; ?>), 13);

      // Create the KML Overlay
    
      var cityOverlay2 = new GGeoXml("http://www.charlietizard.com/places.kml");
      cityMap2.addOverlay(cityOverlay2);

    }
    
    // display a warning if the browser was not compatible
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }

    //]]>
    </script>
	


	
  </body>

</html>