<?php
	include 'db_connection.php';

	$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
  $state = mysqli_real_escape_string($conn, $_POST['state']);
  $city = mysqli_real_escape_string($conn, $_POST['city']);
  $street_num = mysqli_real_escape_string($conn, $_POST['street_num']);
  $street_name = mysqli_real_escape_string($conn, $_POST['street_name']);

	$sql = "INSERT users INTO user (aid, firstname, lastname, pwd, email)
          SELECT (SELECT aid FROM address NATURAL JOIN blocks_info NATURAL JOIN hoods 
          WHERE street_num = '$street_num' AND  street_name = '$street_name' AND city = '$city' AND state = '$state'),
          '$firstname','$lastname','$pwd','$email'
          FROM dual
          WHERE  NOT EXISTS (SELECT * FROM users WHERE email = '$email');";
          
	mysqli_query($conn, $sql);

	header("Location: index.php?signup=success");
  
  
