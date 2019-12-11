<?php 
   include("includes/config.php");
   include("includes/classes/Constants.php");
   include("includes/classes/userinfo.php");
   $register_Obj = new userinfo($con);
   include("includes/handlers/register-handler.php");
   ?>
<html>
   <body>
      <form id="registerForm" method="POST">
         <h2>Create your free account</h2>
         <p>
            <input id="firstName" name="firstName" type="text" placeholder="first name" required>
            <input id="lastName" name="lastName" type="text" placeholder="last name" required>
         </p>
         <p>
		 	<input id="username" name="username" type="text" placeholder="user name" required>
            <input id="password" name="password" type="password" placeholder="Your password" required>
         </p>
         <p>
         <textarea name="introduction" rows="5" cols="40" placeholder = "Please brief introduce yourself"> </textarea><p>
         <button type="submit" name="registerButton">Sign Up</button>
      </form>
      </div>
   </body>
</html>