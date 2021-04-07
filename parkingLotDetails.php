<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>parking lot details</title>
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
          <h3>parking lot details</h3>
         <form  action="parkinglotdetails.php" name="searchForm" method="get">
           <input type="number" name="lot_id" value="" placeholder="lot id" required>
                     <button type="submit">Search</button>
         </form>

         <?php

         require 'dbConnect.php';
         $conn=getConnection();
         $isgot=0;
           if(isset($_GET['lot_id']))
         {
           $lot_id=$_GET['lot_id'];
         $sql = "SELECT * FROM parking_lotss where lot_id='$lot_id'" ;
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
             // output data of each row
             $isgot=1;
             while($row = $result->fetch_assoc()) 
             {
                 echo 'Lot I.D=' .$row["lot_id"].'<br>no of floors='.$row['no_of_floors'].'<br>no of blocks=' .$row["no_of_blocks"].'<br> Address no='. $row['address'] .'<br>ZIP='.$row['zip'].'<br>';
                 
             }
            
         } else {

             echo 'lot Not found';
         }
       }
             
if($isgot==1)
{
 echo '<a href="parkinglotdetails.php">search for another lot?</a><br><a href="main.php">Go to Home</a>';
}
else
{
  echo '<h2>No lots<h2><br><a href="main.php">Go to Home</a>';
}
?>

      

  </body>
</html>
