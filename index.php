<?php
   include("includes/classes/userinfo.php");
   include("includes/classes/Constants.php");
   include("./searchAddress.php");
   // check for email and address 
   $index_Obj = new userinfo($con);
   include("includes/handlers/index-handler.php");
   ?>
<html>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   <!-- Latest compiled and minified JavaScript -->
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
   <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
   <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" type="text/css" href="assets/css/htmleaf-demo.css">
   <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" type="text/css" href="assets/css/input-style.css">
   <meta name="viewport" content="initial-scale=1.0">
   <meta charset="utf-8">
   <style>
      #myVideo {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      }
      /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
      #map {
      height: 60%;
      width: 60%;
      margin: 30 auto 20 auto; 
      z-index: 1 !important;   
      padding: 45px;
      border-radius: 20px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      color:#333;
      overflow-x:hidden;
      font-family: sans-serif;
      font-style: normal
      }
      ul{  
      z-index:30 !important; 
      position: absolute; 
      cursor: default;
      z-index:30 !important;
      background : black; 
      opacity: 0.9;
      border-top-left-radius: 10px;
      border-bottom-left-radius: 10px;
      border-top-right-radius: 10px;
      border-bottom-right-radius: 10px;
      }  
      li{  
      padding:34px;  
      }  
      input{
      border-radius: 5px;
      }
      h3.h3{
      margin: 40 auto 40px;
      padding: 25px;
      text-align: center;
      color : white;
      top:0;
      z-index:30;
      position:relative;
      font-size : 40;
      }
      div.main {
      background-color : rgba(0, 0, 0, 0.5);
      color: white;
      position: relative;
      z-index: 2;
      max-width: 720px;
      margin:  0 auto 0px;
      padding: 45px;
      text-align: left;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
      }

	
      .header-overlay{
      height:100%;
      position: absolute;
      top:0;
      left:0;
      width:100vw;
      z-index:1;
      background:#225470;
      opacity:0.8;
      }

      .navbar{
         z-index:1;
         min-height: 60px;
         text-align: right;
         padding: 15px;
      }
      .btn3{
          width:100px;
      }
      .btn4{
         width:200px;
      }

      


   </style>
   <body>
      <div class="header-overlay"></div>
      <!-- COMMENT -->
      <!--    
         <video autoplay muted loop id="myVideo">
         <source src="assets/media/background.mp4" type="video/mp4">
         </video> -->

         <nav class="navbar navbar-light" style="background-color: rgba(0, 0, 0, 0.5);"  z-index = 1>
         <form id = "loginForm" action = "login.php" method = "POST"> 
            <button  type = "submit" name = "check" class="btn btn-success btn3"> login </button>
         </form>
         </nav>
      <h3 class = "h3"> Discover your neighborhood </h3>
      <div class = "main">
        
         <form id = "loginForm"  method = "POST">
            <p color: white> Over 207,000 neighborhoods across the country use Nextdoor </p>
            </br>
            <p>
            <div class=" col-xs-8">
               <input id = "streetInfo" name = "streetInfo" type="text"  class="form-control"  placeholder = "street address" required>
               <div id="countryList">  </div>
               <span class="focus-border">
               <i></i>
               </span>
            </div>
            <div class="col-xs-3 ">
               <input id = "aptInfo" name = "aptInfo" class="form-control"  type="text" placeholder = "apt" >
               <span class="focus-border">
               <i></i>
               </span>
            </div>
            </p>
            </br></br>	
            <p>
            <div class=" col-xs-7 ">
               <input id = "email" name = "email" class="form-control"  type="text" placeholder = "email" required>
               <span class="focus-border">
               <i></i>
               </span>
            </div>
            <button type = "submit" name = "indexCheck" class="btn btn4 btn-success"> Find your neighbourhoods </button>
            </p>
         </form>
      </div>
      <div id="map" text-align="center" ></div>
   </body>
</html>
<!-- Map placeholder -->
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
   
        $(document).click(function() {
         $('#countryList').fadeOut();
   });
   
   $('input').each(function(){
      if($(this).attr('placeholder')=='' || $(this).attr('placeholder')==null){
         $('#countryList').fadeOut();
      }
   });
   
   
   
   
   
</script>