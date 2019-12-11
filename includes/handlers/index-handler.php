<?php
if(isset($_POST['indexCheck'])) {
	//Login button was pressed
	$email = $_POST['email'];
	$street = $_POST['streetInfo'];


	// echo $login_Obj->login($email, $password);
	$result1 = $index_Obj->validateEmail($email);
	$result2 = $index_Obj->validateAddress($street);

	if($result1 == false )  {
		$message = 'The email already exists / Your email format is incorrect!';

		echo "<SCRIPT type='text/javascript'> //not showing me this
			alert('$message');
			window.location.replace(\"index.php\");
		</SCRIPT>";

	}

	else if ($result2 == false )  {
		echo "<SCRIPT type='text/javascript'> //not showing me this
			alert('Your selected address is not in our map');
			window.location.replace(\"index.php\");
		</SCRIPT>";

	}


	else if ($result1 == true && $result2 == true )  {
		$_SESSION['email'] = $email;
		$_SESSION['street'] = $street;
		header("Location: register.php");
	}



	






}
?>