

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
?>
<h3>customer  details<br></h3>
         <form  action="endregularcustomer.php" name="searchForm" method="get">
           <input type="text" name="ph_no" value="" placeholder="mobile number" required>
                     <button type="submit">Search</button>
         </form>
         <br><br><br><br><a href="main.php">Go To Home?</a>

<?php
$isgot=0;
  if(isset($_GET['ph_no']))
{
  $phone_no=$_GET['ph_no'];
$sql = "SELECT * FROM customer where contact_no='$phone_no'" ;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $isgot=1;
    while($row = $result->fetch_assoc()) 
    {
       $cust_id=$row["cust_id"];
       
    }
   
} else {

    die("customer Not found");
}
}
if($isgot==1)
{
    $sql = "SELECT * FROM regularcust where cust_id='$cust_id'" ;
$result = $conn->query($sql);
$isregulargot=0;
if ($result->num_rows > 0) {
    // output data of each row
    $isregulargot=1;
    while($row = $result->fetch_assoc()) 
    {
       $start_time=$row['start_date'];
       
    }
   
} else {

    die("customer is  Not a regular customer");
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
 
$startseconds=getseconds($start_time);
$parkedtime=$startseconds- (time());
$parkedtime=(int)((($parkedtime/3600)/36000)/24)+1;
//echo $parkedtime;
if($parkedtime<8)
die("<br>not allowed to remove customer<br>i.e regular pass time is less than 7 days ");
$base_price=$parkedtime*50;
 $penalty=0;
if($parkedtime>=7)
         {
          
             echo '<a href="addreceipt.php?cust_id='.$cust_id.'&baseprice='.$base_price.'&penalty='.$penalty.'">PAID?</a>';
           

            }
            

           

         }  
        
       



?>


</body>
</html>


