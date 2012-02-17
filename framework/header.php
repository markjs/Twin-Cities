<?php
 
date_default_timezone_set("GMT"); // Set default time zone
 
$time = date("H"); // Set the time in 24 hour format
 
if (00 <= $time && $time < 05) // 12:00am to 5:00am   Night
   {
   echo
'<link rel="stylesheet" href="stylesheets/header/night.css">';
   }
 
elseif (05 <= $time && $time < 11) // 5:00am to 11:00am   Morning
   {
   echo
'<link rel="stylesheet" href="stylesheets/header/morning.css">';
   }
 
elseif (11 <= $time && $time < 15) // 11:00am to 3:00pm   Midday
   {
   echo
'<link rel="stylesheet" href="stylesheets/header/midday.css">';
   }
   
   elseif (15 <= $time && $time < 18) // 3:00pm to 6:00pm   Afternoon
   {
   echo
'<link rel="stylesheet" href="stylesheets/header/afternoon.css">';
   }
   
   elseif (18 <= $time && $time < 20) // 6:00pm to 8:00pm   Evening
   {
   echo
'<link rel="stylesheet" href="stylesheets/header/evening.css">';
   }
 
else // all other hours   Night
   {
   echo
'<link rel="stylesheet" href="stylesheets/header/night.css">';
   }
 
?>