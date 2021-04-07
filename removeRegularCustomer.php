
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>remove regular customer</title>
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
          <h3>remove regular customer</h3>
         <form  action="removeregularcustomer.php" name="searchForm" method="get">
           <input type="text" name="ph_no" value="" placeholder="mobile number" required>
                     <button type="submit">Search</button>
         </form>
         <br><br><br><br> <a href="main.php">Go To Home</a>

         <?php

         require 'dbConnect.php';
         $conn=getConnection();
         $isgot=0;
         $iscustgot=0;
           if(isset($_GET['ph_no']))
          {
            $ph_no=$_GET['ph_no'];
              //echo $fName."<br>".$mName."<br>".$lName."<br>".$email."<br>".$password."<br>".$confirmPasss;
              $sql = "SELECT * FROM customer where contact_no='$ph_no'" ;
         $result = $conn->query($sql);

         if ($result->num_rows > 0) 
         {
             // output data of each row
             $iscustgot=1;
             while($row = $result->fetch_assoc()) 
             {
                 $cust_id=$row['cust_id'];
                 
             }
            }
            else 
            {
                die ("<h1>NO customer</h1>");
            }
               $stmt = $conn->prepare("DELETE FROM regularcust WHERE cust_id='$cust_id'");
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
    echo '<h1>DONE</h1><br>';
}
else
{
    echo '<h1>ERORR </h1><br>';
}
}


?>
