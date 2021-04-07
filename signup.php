
<?php
if(isset($_SESSION['userName']))
{
  header("Location: hello.php");

  }
  if(isset($_GET['status']))
  {
    header("Location:login.php");
  
    }
    
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Sign Up</title>
      <link rel="stylesheet" href="styles.css">
      
   </head>
    <body>
      <script type="text/javascript" src="js/main.js"> </script>
      <div >

<h3>Register To MyStore</h3>


      <form name="signupform" action="createUser.php" onsubmit="return validateForm()" method="post">


        <p>First Name  </p><input type="text" name="fName" value="" required><br>
        <p>Middle Name  </p><input type="text" name="mName" value="" required><br>
        <p>Last Name </p><input type="text" name="lName" value="" required><br>
        <p>Mobile Phone  </p><input type="number" name="mobile" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" required ><br>
       <p>E-Mail  </p><input type="email" name="email" value="" placeholder="example@gmail.com" required><br>
       <p>Password  </p> <input type="password" name="password" value="" required><br>
      <p>Confirm Password  </p><input type="password" name="confirm" value="" required><br>

  <p id="error" class="error">   <br></p><br>
  <button type="submit" name="Submit">Register Me</button><br>




      </form>
</div>
   </body>


 </html>
