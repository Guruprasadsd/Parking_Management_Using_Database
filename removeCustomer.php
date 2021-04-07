
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>remove customer</title>
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript" src="js/main.js">  </script>
    
  </head>
  <body>

<h1>parking management</h1>

           <?php
                session_start();
                if(isset($_SESSION['username']))
                echo 'Signed In as '.$_SESSION['username'].'<a href="userlog.php?userid='.$_SESSION['userid'].'&type=logout">  Log Out</a>';
              else
              {
                echo "not logged in, please log in!!!!<br> <a href=\"login.php\">login</a>";
                die();
              }
          ?> 
          <h3>remove customer</h3>
         <form  action="removecustomer.php" name="searchForm" method="get">
           <input type="text" name="ph_no" value="" placeholder="mobile number" required>
                     <button type="submit">Search</button>
         </form>
         <br><br><br><br><a href="main.php">Go To Home</a>

         <?php

         require 'dbConnect.php';
         $conn=getConnection();
         $isgot=0;
           if(isset($_GET['ph_no']))
          {
            $ph_no=$_GET['ph_no'];
              //echo $fName."<br>".$mName."<br>".$lName."<br>".$email."<br>".$password."<br>".$confirmPasss;
               $stmt = $conn->prepare("DELETE FROM customer WHERE contact_no='$ph_no'");
                $iswritten=false;
                  if($stmt->execute())
                {  
                    $isWritten=true;
                    $errorcode=100;
                }
                else 
                {
                    $isWritten=false;
                    $errorcode=100;
                }

if($isWritten)
{
    echo '<h1>DONE</h1><br><a href="main.php">Go To Home</a>';
}
else
{
    echo '<h1>ERORR <br>referential integrity constrain voilation</h1><br><a href="main.php">Go To Home</a>';
}
}


?>
