<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>customer details</title>
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
          <h3>customer  details</h3>
         <form  action="custdetails.php" name="searchForm" method="get">
           <input type="text" name="ph_no" value="" placeholder="mobile number" required>
                     <button type="submit">Search</button>
         </form>
         <br><h1>OR</h1><br>
         <form  action="custdetails2.php" name="searchForm" method="get">
           <input type="text" name="vehicle_no" value="" placeholder="example=ka295104" required>
                     <button type="submit">Search</button>
         </form>

         <?php

         require 'dbConnect.php';
         $conn=getConnection();
         $isgot=0;
           if(isset($_GET['vehicle_no']))
         {
           $vehicle_no=$_GET['vehicle_no'];
         $sql = "SELECT * FROM customer where vehicle_no='$vehicle_no'" ;
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
             // output data of each row
             $isgot=1;
             while($row = $result->fetch_assoc()) 
             {
                 echo 'customer I.D=' .$row["cust_id"].'<br>Name='.$row['name'].'<br>Vehicle No=' .$row["vehicle_no"].'<br> Contact no='. $row['contact_no'] .'<br>E-Mail='.$row['email'].'<br>is regular customer?='.$row['is_regular_cust'].'<br> Registration Date'. $row["registration_date"].'<br>';
                 
             }
            
         } else {

             echo 'customer Not found';
         }
       }
             
if($isgot==1)
{
 echo '<a href="custdetails.php">search for another customer?</a><br><a href="main.php">Go to Home</a>';
}
else
{
  echo '<h2>No customers<h2><br><a href="main.php">Go to Home</a>';
}
?>

      

  </body>
</html>
