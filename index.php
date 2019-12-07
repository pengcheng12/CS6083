<html>	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           
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

		ul{  
                background-color:#eee;  
                cursor:pointer;  
           }  
           li{  
                padding:12px;  
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
						<div id="countryList">  </div>
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



<script > 


   
	$(document).ready(function(){
		$('#streetInfo').keyup(function() {
			var query = $(this).val();
			if(query  != '') 
			{
				$.ajax({
					url : "searchAddress.php",
					data:{ "query" : query},  
					type: 'post',
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
				});
			}
		});
	});

	$(document).on('click', 'li', function(){  
           $('#streetInfo').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
 

	


</script>