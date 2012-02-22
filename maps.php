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


    <div id="map" style="width: 768px; height: 512px"></div>

    <script type="text/javascript">
    //<![CDATA[
    
    if (GBrowserIsCompatible()) { 


 
      var map = new GMap2(document.getElementById("map"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng(53.763325,-2.579041), 9);

      // ==== Create a KML Overlay ====
    
      var kml = new GGeoXml("http://econym.org.uk/gmap/lancashire.kml");
      map.addOverlay(kml);


    }
    
    // display a warning if the browser was not compatible
    else {
      alert("Sorry, the Google Maps API is not compatible with this browser");
    }

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/

    //]]>
    </script>
  </body>

</html>