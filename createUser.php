

<?php
require 'dbConnect.php';
  $conn = getConnection();
  if($conn->connect_error)
  {
  header("Location: signUp.php?status=&failed" );
  }

  $fName=$_POST['fName'];
  $mName=$_POST['mName'];
  $lName=$_POST['lName'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $confirmPasss=$_POST['confirm'];
  $mobile=$_POST['mobile'];
  $isWritten=false;
  $errorcode=-1;


  //echo $fName."<br>".$mName."<br>".$lName."<br>".$email."<br>".$password."<br>".$confirmPasss;

if(!empty($fName)&&!empty($mName)&&!empty($lName)&&!empty($email)&&!empty($password)&&!empty($confirmPasss))
{
  $stmt = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, ph_no, email, password) VALUES (?, ?, ? , ? , ? , ?)");
  $stmt->bind_param("sssssi", $fName, $mName, $lName, $mobile, $email ,$password);
  if($stmt->execute())
  {
       $isWritten=true;
       $errorcode=100;
  }else {
    $isWritten=false;
    $errorcode=100;

  }


}
else {
//echo "Am i joke to you";
}


?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<style>

</style>
</head>
<body>
<div class="card">
   <?php

   if($isWritten)
    {
        echo "<h2 >Your Account is Created successfully</h2>";
        header("Location: authSucess.php?user=$fName&useremail=$email");
    }else {
      echo "<h2 class='error'>Something went wrong please try later</h2>";
      echo '<a href="mystore.php">Take me to Home </a>';

    }
    if($errorcode<0)
    {
      echo "<h2 >Creating Your Account Please Wait </h2>";
     
    }

     ?>

    </div>



</div>

</div>



</body>
</html>
