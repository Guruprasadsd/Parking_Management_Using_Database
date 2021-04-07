

<?php
require 'dbConnect.php';
  $conn = getConnection();
  if($conn->connect_error)
  {
  header("Location: signUp.php?status=&failed" );
  }
  if(isset($_GET['cust_id'])&&isset($_GET['baseprice'])&&isset($_GET['penalty']))
{
    $cust_id=$_GET['cust_id'];
    $base_price=$_GET['baseprice'];
    $penalty=$_GET['penalty'];
    //echo $cust_id.$base_price.$penalty;
}
else 
die ("not set");

  //echo $fName."<br>".$mName."<br>".$lName."<br>".$email."<br>".$password."<br>".$confirmPasss;
 $stmt = $conn->prepare("INSERT INTO receipt (cust_id, base_price, penalty, total_price) VALUES (?, ?, ? , ? )");
 $total_price=$base_price+$penalty;
  $stmt->bind_param("iiii", $cust_id, $base_price, $penalty, $total_price);
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

  $stmt = $conn->prepare("DELETE FROM car_locationn WHERE cust_id='$cust_id';");
  $isdelete=false;
  if($stmt->execute())
  {
       $isdelete=true;
       $errorcode=100;
  }else {
    $isdelete=false;
    $errorcode=100;

  }

if($isWritten&&$isdelete)
{
    echo '<h1>DONE</h1><br><a href="main.php">Go To Home</a>';
}
else
{
    echo '<h1>ERORR</h1><br><a href="main.php">Go To Home</a>';
}



?>
