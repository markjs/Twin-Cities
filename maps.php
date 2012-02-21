<?php

include_once("commonlib.php");
$config = loadConfig("config.xml");
$city1 = $config['city1'];
$city2 = $config['city2'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCmsUrnImKjRK8QTKOhXvSWW-wPXsvIvxU&sensor=false">
    </script>
    
    <script type="text/javascript">
      function initialize() {
        var myOptions = {
          center: new google.maps.LatLng(<?php echo $city1['lat'] . "," . $city1['lng'] ?>),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions)
            
        var myOptions = {
          center: new google.maps.LatLng(<?php echo $city2['lat'] . "," . $city2['lng'] ?>),
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas2"),
            myOptions)
      }     
    </script>
   
      
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width:500px; height:500px"></div>
    
   <div id="map_canvas2" style="width:500px; height:500px"></div>
  </body>
</html>