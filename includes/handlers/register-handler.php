<?php 
   function sanitizeFormPassword($inputText) {
    // remove all html xml tag from string
   	$inputText = strip_tags($inputText);
   	return $inputText;
   }
   
   
   function sanitizeFormString($inputText) {
   	$inputText = strip_tags($inputText);
   	$inputText = str_replace(" ", "", $inputText);
   	$inputText = ucfirst(strtolower($inputText));
   	return $inputText;
   }
   
   
   if(isset($_POST['registerButton'])) {
   
   $username = sanitizeFormString($_POST['username']);
   $firstName = sanitizeFormString($_POST['firstName']);
   $lastName = sanitizeFormString($_POST['lastName']);
      $password = sanitizeFormPassword($_POST['password']);
      $introduction = $_POST['introduction'];
      $address = $_SESSION["street"];
      $email = $_SESSION["email"];
   
   
      //  echo $username .  $firstName . $lastName .  $password . $address. $email  ;
      $wasSuccessful = $register_Obj->register($username, $firstName, $lastName, $email,$password, $address, $introduction);
   
   
   
      if($wasSuccessful == true) {
         header("Location: main.php");
      }
   
   
   }
   
   
   ?>