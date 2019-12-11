<?php
if(isset($_POST['loginButton'])) {
	//Login button was pressed
	$email = $_POST['email'];
	$password = $_POST['password'];

	// echo $login_Obj->login($email, $password);
	$result = $login_Obj->login($email, $password);

	if($result == true) {
		$_SESSION['email'] = $email;
		header("Location: main.php");
	}

}
?>