<html>	
<meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 50%;
		width: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	  </style>

	
	<body>
		<div id = "inputContainer"> 
			<form id = "loginForm" method = "POST">
				<h2> Discover your neighborhood </h2> 
					<p> Over 207,000 neighborhoods across the country use Nextdoor </p>
					<p>
						<input id = "streetInfo" name = "streetInfo" type="text" placeholder = "street address" required>
						<input id = "aptInfo" name = "aptInfo" type="text" placeholder = "apt" required>
					</p>

					<p>
						<input id = "password" name = "password" type="text" placeholder = "email" required>
						<button type = "submit" name = "check"> Find your neighbourhoods </button>
					</p>



					<!-- Map placeholder -->
					<div id="map"></div>
					<script>
					var map;
					function initMap() {
						map = new google.maps.Map(document.getElementById('map'), {
						center: {lat: 40.87166318, lng:  -73.0996},
						zoom: 14
						});
					}
					</script>
					<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFUMQ0fGX7mx1H4BwtB6gwCM2JFcz9ZCg&callback=initMap"
				async defer></script>

					
					
			</form>

		</div>
	</body>
</html>