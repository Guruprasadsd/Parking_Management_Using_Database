<!DOCTYPE html>
<html>
<head>
<title>Add car</title>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="js/main.js"> </script>
</head>
<body>
<h1> ADD CAR</h1>
<?php
                session_start();
                
                if(isset($_SESSION['username']))
                echo 'Signed In as '.$_SESSION['username'].'<a href="userlog.php?userid='.$_SESSION['userid'].'&type=logout">  Log Out</a>';
              else
              die ("not logged in, please log in!!!!<br> <a href=\"login.php\">login</a>");
          ?>
<form name="addcar" action="newcarparked.php" method="post">
Mobile Phone  <input type="text" name="mobile"  required ><br>
       <button type="submit" name="Submit">Add?</button><br><br><br><br>
       <a href="addcustomer.php">new customer?</a><br>
       
</form>

<?php
require 'dbConnect.php';
  $conn = getConnection();
  if($conn->connect_error)
  {
  die("Database SERVER PROBLEM<br><a href=\"main.php\">Go To home</a>");
  }
  if($_POST)
  {
      echo "in post";
      $mobile_no=$_POST['mobile'];
      $isgot=0;
      $isWritten=false;
      $errorcode=-1;
      $isparkdetailsgot=0;
      $ismaxparkedgot=0;
         if(!empty($mobile_no))
         {
             echo("in 1 if");
                  $sql = "select * from customer where contact_no='$mobile_no';" ;
         $result = $conn->query($sql);
           echo $result->num_rows;
         if ($result->num_rows > 0)
          {
             // output data of each row
             $isgot=1;
             while($row = $result->fetch_assoc()) 
             {
                 
                 $cust_id=$row['cust_id'];
                 $vehicle_no=$row['vehicle_no'];
                 $email=$row['email'];
                 echo $cust_id."     ".$vehicle_no;
             }
            
          } 
           
         while(!$isgot)echo"in isgot while";
         if($isgot==1)
         {
             echo('in isgot');
            $sql1 = "select MAX(block_id),MAX(floor_id) from car_locationn;" ;
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0)
             {
                // output data of each row
                $ismaxparkedgot=1;
                while($row = $result1->fetch_assoc()) 
                {
                   echo $row['MAX(block_id)'].$row['MAX(floor_id)'];
                    $filledblock=$row['MAX(block_id)'];
                    $filledfloor=$row['MAX(floor_id)'];
               
                }
               
             } 
              
             while(!$ismaxparkedgot)echo"in ismaxparkedgot while";
            if($ismaxparkedgot==1)
            {
                echo("in ismaxparkedgot");
               $sql2 = "select min(lot_id),no_of_floors,no_of_blocks from parking_lotss;" ;
               $result2 = $conn->query($sql2);
               if ($result2->num_rows > 0)
                {
                   // output data of each row
                   $isparkdetailsgot=1;
                   while($row = $result2->fetch_assoc()) 
                   {
                      echo $row['min(lot_id)'].$row['no_of_floors'];
                       $lot_id=$row['min(lot_id)'];
                       $no_of_floors=$row['no_of_floors'];
                       $no_of_blocks=$row['no_of_blocks'];
                   }
                  
                } 
                 
                while(!$isparkdetailsgot)echo"in isparkeddetailsgot while";
               if($isparkdetailsgot==1)
               {
                   echo ("in isparkdetailsgot".$filledfloor.$filledblock);
                   if($filledblock>=$no_of_blocks )
                   {
                       if($filledfloor<$no_of_floors)
                           {      $filledfloor=$filledfloor+1;
                            $filledblock=0;
                           }
                    }
                else 
                $filledblock=$filledblock+1;
                
        $stmt = $conn->prepare("INSERT INTO car_locationn (cust_id,lot_id,floor_id,block_id) VALUES (?, ?, ?, ?)");
        
       
        $stmt->bind_param("iiii",$cust_id,$lot_id,$filledfloor,$filledblock);
        if($stmt->execute())
  {
       $isWritten=true;
       $errorcode=100;
  }else {
    $isWritten=false;
    $errorcode=100;

  }
} 
}
}


}
else {
echo "No input";
}
  }
  

?>




   <?php
   
if($_POST)
{
   while(!$isWritten);
   if($isWritten)
    {
        echo "<h2 >Car Parked</h2><br>";
        echo '<a href="send.php?email='.$email.'&lotid='.$lot_id.'&floorid='.$filledfloor.'&blockid='.$filledblock.'">SEND?</a><br><br><br><br><br><a href=\"main.php\">Take me to Home </a><br>';
       
    }
   else if($errorcode>0) {
      echo "<h2 class='error'>Something went wrong please try later</h2>";
     // echo '<!-- <a href="main.php">Take me to Home </a> -->';

    }
    if($errorcode<0)
    {
      echo "<h2 >Adding user.... Please Wait  and refresh</h2>";
     
    }

      }    ?>

    






</body>
</html>
