<?php
	class Userinfo{

		private $con;
		private $errorArray; 

		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($em, $pw) {
			$pw = md5($pw);
			$query = mysqli_query($this->con, "SELECT * FROM users WHERE  email='$em' AND pwd='$pw'");

			if(mysqli_num_rows($query) == 1) {
				return true;
			}

			else {
				array_push($this->errorArray, Constants::$loginFailed);
				echo Constants::$loginFailed;
				return false;
			}

		}

		public function register($un, $fn, $ln, $em,  $pw, $address, $introduction) {
			$this->validateUsername($un);
			$this->validateEmail($em);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validatePassword($pw);
			$this->validateAddress($address);



			echo '<pre>'; print_r($this->errorArray); echo '</pre>';
		
			if(empty($this->errorArray) == true) {
				

				$query = mysqli_query($this->con, " SELECT  aid
				From (SELECT 
					CONCAT(street_num, ' ', street_name, ', ' , city, ', ', state) AS result, aid
					FROM address NATURAL JOIN blocks_info NATURAL JOIN hoods
				) AS addressString
				WHERE addressString.result = '$address' " );

				$row = mysqli_fetch_array($query);
				$aid = $row[0];
				
				return $this->insertUserDetails($un, $fn, $ln, $pw, $em, $aid, $introduction);
			}
			else {
				return false;
			}
		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $pw, $em, $aid, $introduction) {
			$encryptedPw = md5($pw);
			$photo = "assets/images/profile-pics/head_emerald.png";
			$notify = 'no';

			$result = mysqli_query($this->con,
			 "INSERT INTO users VALUES ( DEFAULT, '$un', '$fn', '$ln',  '$encryptedPw', '$em', $aid, '$introduction', '$photo', '$notify' )");


			 echo mysqli_error($this->con);
	//		echo $un. ' '. $fn. ' '. $ln.' '.$encryptedPw . ' ' .$em . ' ' . $aid . ' ' . $introduction . ' ' . $photo . ' ' . $notify;
			return $result;
		}

		private function validateUsername($un) {

			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, Constants::$usernameCharacters);
				return;
			}

			$checkUsernameQuery = mysqli_query($this->con, "SELECT username FROM users WHERE username='$un'");
			if(mysqli_num_rows($checkUsernameQuery) != 0) {
				array_push($this->errorArray, Constants::$usernameTaken);
				return;
			}

		}

		private function validateFirstName($fn) {
			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, Constants::$firstNameCharacters);
				return;
			}
		}

		private function validateLastName($ln) {
			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, Constants::$lastNameCharacters);
				return;
			}
		}

		public function validateEmail($em) {
			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, Constants::$emailInvalid);
				return false;
			}

			$checkEmailQuery = mysqli_query($this->con, "SELECT * FROM users WHERE email='$em'");

			if(mysqli_num_rows($checkEmailQuery) != 0) {
				array_push($this->errorArray, Constants::$emailTaken);
				return false;
			}
			return true;
		}


		public function validateAddress($address) {
			$checkAddress = mysqli_query($this->con, " SELECT *
			From (SELECT 
				CONCAT(street_num, ' ', street_name, ', ' , city, ', ', state) AS result
				FROM address NATURAL JOIN blocks_info NATURAL JOIN hoods
			) AS addressString
			WHERE addressString.result = '$address' " );
	
			if(mysqli_num_rows($checkAddress) == 0) {
				array_push($this->errorArray, Constants::$emailTaken);
				return false;
			}
			return true;
		}

		private function validatePassword($pw) {
			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
				return;
			}

			if(strlen($pw) > 30 || strlen($pw) < 5) {
				array_push($this->errorArray, Constants::$passwordCharacters);
				return;
			}

		}


	}
?>