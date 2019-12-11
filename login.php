<?php
   
   include("includes/config.php");
   include("includes/classes/userinfo.php");
   include("includes/classes/Constants.php");
   $login_Obj = new userinfo($con);
   include("includes/handlers/login-handler.php");


?>

<html>
   <body>
      <div id = "inputContainer">
         <form id = "loginForm" method = "POST">
            <h2> Login to your account </h2>
            <p>
               <input id = "email" name = "email" type="text" placeholder = "email " required>
            </p>
            <p>
               <input id = "password" name = "password" type="text" placeholder = "password" required>
            </p>
            <button type = "submit" name = "loginButton"> Sign in </button>
         </form>
      </div>
   </body>
</html>