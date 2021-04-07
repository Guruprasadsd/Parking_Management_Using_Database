<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>receipt</title>
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
          <h3>create receipt</h3>
         <form  action="createreceipt.php" name="searchForm" method="get">
           <input type="text" name="ph_no" value="" placeholder="mobile number" required>
                     <button type="submit">create?</button>
         </form>
         <?php
       echo '<br><br><br><a href="main.php">Go To Home?</a>';
       ?>

         <?php

         require 'dbConnect.php';
         $conn=getConnection();
         $isgot=0;
         $iscargot=0;
           if(isset($_GET['ph_no']))
         {
           $phone_no=$_GET['ph_no'];
         $sql = "SELECT * FROM customer where contact_no='$phone_no'" ;
         $result = $conn->query($sql);

         if ($result->num_rows > 0) 
         {
             // output data of each row
             $isgot=1;
             while($row = $result->fetch_assoc()) 
             {
                // echo 'customer I.D=' .$row["cust_id"].'<br>Name='.$row['name'].'<br>Vehicle No=' .$row["vehicle_no"].'<br> Contact no='. $phone_no .'<br> Registration Date'. $row["registration_date"].'<br>';
                 $cust_id=$row["cust_id"];
                 $name=$row['name'];
                 $vehicle_no=$row["vehicle_no"];
             }
            }
             if($isgot==1)
             {
               //echo $cust_id;
                 $sql1 = "SELECT * FROM car_locationn where cust_id='$cust_id'" ;
                $result1 = $conn->query($sql1);
       
                if ($result1->num_rows > 0) {
                    // output data of each row
                    $iscargot=1;
                    while($row = $result1->fetch_assoc()) 
                    {
                       // echo 'customer I.D=' .$row["cust_id"].'<br>Name='.$row['name'].'<br>Vehicle No=' .$row["vehicle_no"].'<br> Contact no='. $phone_no .'<br> Registration Date'. $row["registration_date"].'<br>';
                        $lot_id=$row['lot_id'];
                        $floor_id=$row['floor_id'];
                        $block_id=$row['block_id'];
                        $parked_time=$row['parked_time'];
                       // echo ' blahhh parking LOT='.$lot_id.'<br>floor='.$floor_id.'<br>block='.$block_id.'<br>parked time',$parked_time;
                    }
                }
             }
             else
              {
                die ("<h2>No customer</h2><br><br><a href=\"createreceipt.php\">another customer?</a>");
              }
             if($iscargot==1)
             {
                 echo '<h3><br><br>Name='.$name.'<br>vehicle No='.$vehicle_no.'<br><br>LOCATION<br>parking LOT='.$lot_id.'<br>floor='.$floor_id.'<br>block='.$block_id.'<br>parked time',$parked_time;
                 echo '<a href="bill.php?cust_id='.$cust_id.'&start_time='.$parked_time.'"><br>click to bill</a><br><br><br><br><br>';
             }
             else{
               die ("<h2>No car parked with customer id='.$cust_id.'</h2><br><br><a href=\"createreceipt.php\">another customer?</a>");
             }
         
        }
             
if($isgot==1)
{
 echo '<a href="createreceipt.php">another customer?</a>';
}

?>

      

  </body>
</html>
