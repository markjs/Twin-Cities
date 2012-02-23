<?php
include_once("commonlib.php");
include_once("instagram.php");
include_once("lastfm.php");
include_once("maps.php");
include_once("news.php");
include_once("twitter.php");
include_once("weather.php");
$config = loadConfig();
$city1 = $config['city1']['name'];
$country1 = $config['city1']['country'];
$city2 = $config['city2']['name'];
$country2 = $config['city2']['country'];
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Twin Cities</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">
	<link rel="stylesheet" href="stylesheets/style.css">
	<?php include("header.php"); ?>
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
	
	<!-- Maps Script
	================================================== -->
	<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyCmsUrnImKjRK8QTKOhXvSWW-wPXsvIvxU" type="text/javascript"></script>
	
</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->

	<div class="container">
	
		<header class="sixteen columns nomargin">
			<h1 class="remove-bottom" id="title">Twin Cities</h1>
			<h5 id="subtitle">San Diego &amp; Edinburgh</h5>
			<div id="skyline"></div>
		</header>

		<div class="eight columns" id="ed">
			<h3>Edinburgh</h3>
			<p>Edinburgh is the capital city of Scotland, the second largest city in Scotland, and the eighth most populous in the United Kingdom. The City of Edinburgh Council governs one of Scotland's 32 local government council areas. The council area includes urban Edinburgh and a 30 square miles (78 km2) rural area. Located in the south-east of Scotland, Edinburgh lies on the east coast of the Central Belt.</p>			
			
			<section>
			<!-- Weather - Mark Smith -->
			<h4>Current Weather</h4>
			<?php echo weatherGetCurrentWeather($city1); ?>
			<h4>Weather Forecast</h4>
			<ul>
				<?php for ($i=0; $i < 4; $i++) { 
					echo "<li>" . weatherGetFutureWeather($city1,$i) . "</li>";
				} ?>
			</ul>
			<!-- End Weather -->
			</section>
			
			<section>
			<!-- News - Alex Jegtnes -->
			<h4>Latest News</h4>
			<ul>
			<?php
				foreach(acquireNews($city1) as $news) {
					echo "<li><a href=\"" . $news['url'] . "\">" . $news['title'] . "</a></li>";
				}
			?>
			</ul>
			<!-- End News -->
			</section>
			
			<section>
			<!-- Google Maps - Charlie Tizard -->
			<h4>Street Map</h4>
			<?php echo renderMap($config['city1']['lat'],$config['city1']['lng']); ?>
			<!-- End Google Maps -->
			</section>
			
			<section>
			<!-- Twitter - Charlie Tizard -->
			<h4>Tweets from Town</h4>
			<?php
			foreach(twitterGetTweets($config['city1']['lat'],$config['city1']['lng']) as $c2t) {
				echo "<p class=\"tweet\"><a href='" . $c2t['authorUrl'] . "'>" . $c2t['authorName'] . ":</a> " . $c2t['content'] . "</p>";
			}
			?>
			<!-- End Twitter -->
			</section>
			
			<section>
			<!-- Instagram - Mark Smith -->
			<h4>Local Instagram Posts</h4>

			<?php echo instagramGetLatestPhotos($config['city1']['lat'],$config['city1']['lng']); ?>

			<!-- End Instagram -->
			</section>
			
			<section>
			<!-- Last.fm - Alex Jegtnes -->
			<h4>Top Last.fm Artists</h4>
			<ul class="lastfm"><?php 
			foreach(lastfmGetTopArtists(10, $city1, $country1) as $lfm) {
				echo("<li><a href=\"" . $lfm['url'] . "\">" . "<img alt=\"A picture of " . $lfm['name'] . "\" src=\"" . $lfm['image'] . "\" />" . $lfm['name'] . "</a></li>");
			}
			?></ul>
			<!-- End Last.fm -->
			</section>
			
		</div>
		
		<div class="eight columns" id="sd">
			<h3>San Diego</h3>
			<p>San Diego is the eighth-largest city in the United States and second-largest city in California. The city is located on the coast of the Pacific Ocean in Southern California, immediately adjacent to the Mexican border. The birthplace of California, San Diego is known for its mild year-round climate and its natural deep-water harbor.</p>
			
			<section>
			<!-- Weather - Mark Smith -->		
			<h4>Current Weather</h4>
			<?php echo weatherGetCurrentWeather($city2); ?>
			<h4>Weather Forecast</h4>
			<ul>
				<?php for ($i=0; $i < 4; $i++) { 
					echo "<li>" . weatherGetFutureWeather($city2,$i) . "</li>";
				} ?>
			</ul>
			<!-- End Weather -->	
			</section>
			
			<section>
			<!-- News - Alex Jegtnes -->
			<h4>Latest News</h4>
			<ul>
			<?php
				foreach(acquireNews($city2) as $news) {
					echo "<li><a href=\"" . $news['url'] . "\">" . $news['title'] . "</a></li>";
				}
			?>
			<!-- End News -->
			</ul>
			</section>
			
			<section>
			<!-- Google Maps - Charlie Tizard -->
			<h4>Street Map</h4>
			<?php echo renderMap($config['city2']['lat'],$config['city2']['lng']); ?>
			<!-- End Google Maps -->
			</section>
			
			<section>
			<!-- Twitter - Charlie Tizard -->
			<h4>Tweets from Town</h4>
			<?php
			foreach(twitterGetTweets($config['city2']['lat'],$config['city2']['lng']) as $c2t) {
				echo "<p class=\"tweet\"><a href='" . $c2t['authorUrl'] . "'>" . $c2t['authorName'] . ":</a> " . $c2t['content'] . "</p>";
			}
			?>
			<!-- End Twitter -->
			<div class=\"clear\"></div>
			</section>
			
			<section>
			<!-- Instagram - Mark Smith -->
			<h4>Local Instagram Posts</h4>
			
			<?php echo instagramGetLatestPhotos($config['city2']['lat'],$config['city2']['lng']); ?>
			
			<!-- End Instagram -->
			</section>
			
			<section>
			<!-- Last.fm - Alex Jegtnes -->
			<h4>Top Last.fm Artists</h4>
			<ul class="lastfm"><?php 
			foreach(lastfmGetTopArtists(10, $city2, $country2) as $lfm) {
				echo("<li><a href=\"" . $lfm['url'] . "\">" . "<img alt=\"A picture of " . $lfm['name'] . "\" src=\"" . $lfm['image'] . "\" />" . $lfm['name'] . "</a></li>");
			}
			?></ul>
			<!-- End Last.fm -->
			</section>
		</div>
		
		<footer class="sixteen columns nomargin">
			<div id="undercity">
				
			</div>
			
			<div class="eight columns" id="footerl">
			<h6><a href="http://www.cems.uwe.ac.uk/~c2-tizard/">10029701</a>, <a href="http://www.cems.uwe.ac.uk/~as2-jegtnes/">10029052</a>, <a href="http://www.cems.uwe.ac.uk/~mj7-smith/">10012517</a>.</h6>
			</div>
			
			<div class="eight columns" id="footerr">
			<h6><a href="http://www.twitter.com/CharlieTizard">@CharlieTizard</a>, <a href="http://www.twitter.com/Jegtnes">@Jegtnes</a>, <a href="http://www.twitter.com/Mark_JS">@Mark_JS.</a></h6>
			</div>
			
		</footer>

	</div><!-- container -->
	
	



	<!-- JS
	================================================== -->
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="javascripts/tabs.js"></script>
	
  

<!-- End Document
================================================== -->
</body>
</html>