

<?php
require 'dbConnect.php';
  $conn = getConnection();
  if($conn->connect_error)
  {
  header("Location: signUp.php?status=&failed" );
  }
  session_start();
  if(isset($_SESSION['username']))
  echo 'Signed In as '.$_SESSION['username'].'<a href="userlog.php?userid='.$_SESSION['userid'].'&type=logout">  Log Out</a>';
else
  die ("not logged in, please log in!!!!<br> <a href=\"login.php\">login</a>");


  if(!isset($_POST['car_type']))
  {
  if(isset($_GET['cust_id']))
$_SESSION['cust_id']=$_GET['cust_id'];
//echo $cust_id;
else
echo ("not set");

if(isset($_GET['start_time']))
{
    $_SESSION['start_time']=$_GET['start_time'];
//echo $start_time.'<br>';
} else
die ("not set");
  }

function getseconds($start_time)
{
$mon=((int)$start_time[5])*10+(int)$start_time[6];
$day=((int)$start_time[8])*10+(int)$start_time[9];
$hr=((int)$start_time[11])*10+(int)$start_time[12];
$min=((int)$start_time[14])*10+(int)$start_time[15];
$sec=((int)$start_time[17])*10+(int)$start_time[18];
$seconds=mktime($hr,$min.$sec,$mon,$day,2019);
return($seconds);
}
 
$startseconds=getseconds($_SESSION['start_time']);
$parkedtime=$startseconds- (time());
$parkedtime=(int)(($parkedtime/3600)/36000)+1;
//echo $parkedtime;

 
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
<form  action="bill.php" name="searchForm" method="POST">
           car type id  <input type="number" name="car_type" value="" placeholder="car type id" required>
           penalty<input type="number" name="penalty" value=""  required>
                     <button type="submit">submit</button>
         </form>


<?php
if(isset($_POST['car_type']))
{
    $car_type=$_POST['car_type'];
    $penalty=$_POST['penalty'];
    
    
         
         $sql = "SELECT * FROM price_scheme where vehicle_type_id='$car_type'" ;
         $result = $conn->query($sql);

         if ($result->num_rows > 0)
          {
             // output data of each row
             
             while($row = $result->fetch_assoc()) 
             {
                 $base_price=$row['base_price_perhour'];
                 $totalprice=$base_price+$penalty;
                 echo '<h3>TOTOAL PRICE=  '.$totalprice.'</h3>';
              
             }
              $cust_id=$_SESSION['cust_id'];
             $sql = "SELECT * FROM customer where cust_id='$cust_id'";
         $result = $conn->query($sql);
         $is_got=0;
         if ($result->num_rows > 0)
         {
           $isgot=1;
           while($row = $result->fetch_assoc()) 
           {
             $isregular=$row['is_regular_cust'];
           }


         }
         if($isgot==1)
         {
           if($isregular=='no')
             echo '<a href="addreceipt.php?cust_id='.$_SESSION['cust_id'].'&baseprice='.$base_price.'&penalty='.$penalty.'">PAID?</a>';
           else
           {
            echo '<a href="addreceipt.php?cust_id='.$_SESSION['cust_id'].'&baseprice='.$base_price.'&penalty='.$penalty.'">DONE?</a>';
           }

            }
            else {

                die("car type not found");
            }
            

           

         }  
        }
       



?>


</body>
</html>


