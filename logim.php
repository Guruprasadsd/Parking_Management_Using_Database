

<?php

session_start();
if(isset($_SESSION['username']))
{
  //echo 'in session';
  if(isset($_GET['logout']))
  {
   // echo 'in get';
    session_destroy();
    session_abort();
  }
  else
  {
    header("Location: main.php");
  }

  }
 ?>
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <title>Login</title>
      <link rel="stylesheet" href="styles.css">
      
   </head>
    <body>
      <script type="text/javascript" src="js/main.js"> </script>
      <div >
<h1>PARKING MANAGEMENT</h1>

<h3>Login</h3>


      <form name="signupform" action="auth.php" onsubmit="return validateLogin()" method="post">
       E-Mail  <input type="email" name="email" value="" placeholder="example@gmail.com" required> <br>
       Password  <input type="password" name="password" placeholder="password" > <br>


  <?php
  if(isset($_GET['status']))
  {
    echo "<h3 class='links' > ERROR";
    echo '<p2 id="error" class="error"> Invalid Email or Password  <br></p2><br>';
  }else {
    echo '<p2 id="error" class="error">   <br></p2><br>';
  }
  ?>

  <button type="submit" name="Submit">Log In</button><br>
        

      </form>

</div>
   </body>


 </html>
