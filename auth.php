<?php
    require 'dbConnect.php';

    $conn = getConnection();

    if($conn->connect_error)
    {
      header("Location: signUp.php?status=&failed" );
    }

    $password=$_POST['password'];
    $email=$_POST['email'];

    
    $sql = "SELECT * from users where email='$email'";
    $result = $conn->query($sql);
   // echo $result->num_rows;

   
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            /*cho "email: " . $row["email"]. " - Name: " . $row["fName"]. " " . $row["password"]. "<br>";*/
             $gotEmail=$row["email"];
             $gotPassword=$row["password"];
             $gotName=$row["first_name"];
             $user_id=$row['i_d'];
            if($gotPassword!=$password)
            {
              header("Location: login.php?status=&failed");

            }else {
              /*session_start();
              $_SESSION['userName']=$gotName;
              $_SESSION['userEmail']=$gotEmail;*/

              header("Location: authSucess.php?user=$gotName&useremail=$gotEmail&userid=$user_id");
            }
        }
    } else {

      //header("Location: authSucess.php?user=$gotName&useremail=$gotEmail");
         header("Location: login.php?status=&failed");
    }

 ?>
