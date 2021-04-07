<!DOCTYPE html>
<html>
<head>
<title>add customer</title>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="js/main.js"> </script>
</head>
<body>
<h1> ADD REGULAR CUSTOMER</h1>
<?php
                session_start();
                
                if(isset($_SESSION['username']))
                echo 'Signed In as '.$_SESSION['username'].'<a href="userlog.php?userid='.$_SESSION['userid'].'&type=logout">  Log Out</a>';
              else
              die ("not logged in, please log in!!!!<br> <a href=\"login.php\">login</a>");
          ?>
<form name="addcust" action="addregularcustomer.php" method="post">


        Mobile Phone  <input type="text" name="mobile"  required ><br>
       <!--duration  <input type="number" name="duration" value="" placeholder="in days" required><br>
       -->
       <button type="submit" name="Submit">Add regular customer</button><br><br><br><br>
       <?php
       echo '<a href="main.php">Go To Home?</a>';
       ?>

       
</form>

<?php
require 'dbConnect.php';
  $conn = getConnection();
  if($conn->connect_error)
  {
  header("Location: signUp.php?status=&failed" );
  }
  if(isset($_POST['mobile']))
  {
  //$duration=$_POST['duration'];
  $ph_no=$_POST['mobile'];
  $isWritten=false;
  $errorcode=-1;
  $iscustgot=0;
  $sql = "SELECT * FROM customer where contact_no='$ph_no'" ;
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
             // output data of each row
             $iscustgot=1;
             while($row = $result->fetch_assoc()) 
             {
                $cust_id=$row["cust_id"];
             }
            
         } else {

             die("customer Not found<br><a href=\"addcustomer.php\">Add customer?</a>");
         }

  //echo $fName."<br>".$mName."<br>".$lName."<br>".$email."<br>".$password."<br>".$confirmPasss;

  $stmt = $conn->prepare("INSERT INTO regularcust (cust_id) VALUES (?)");
  $stmt->bind_param("i", $cust_id);
  //echo $Name.$ph_no.$vehicle_no.$isregular;
  if($stmt->execute())
  {
       $isWritten=true;
       $errorcode=100;
  }else {
    $isWritten=false;
    $errorcode=100;

  }


}

  


if($_POST)
{
   if($isWritten)
    {
        $stmt = $conn->prepare("UPDATE customer SET is_regular_cust='yes' WHERE contact_no='$ph_no'");
       if( $stmt->execute())
       {
           echo 'DONE';

       }
       else
       {
           echo 'customer is not updated';
       }

        echo "<h2 >Regular Customer ADDED </h2>";
       
    }else {
      echo "<h2 class='error'>Something went wrong please try later</h2>";
     // echo '<a href="main.php">Take me to Home </a>';

    }
    if($errorcode<0)
    {
      echo "<h2 >Adding user.... Please Wait </h2>";
     
    }

      }    ?>

    






</body>
</html>
