<!DOCTYPE html>
<html>
<head>
<title>add parking lot</title>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="js/main.js"> </script>
</head>
<body>
<h1> ADD PARKING LOT</h1>
<?php
                session_start();
                
                if(isset($_SESSION['username']))
                echo 'Signed In as '.$_SESSION['username'].'<a href="userlog.php?userid='.$_SESSION['userid'].'&type=logout">  Log Out</a>';
              else
              die ("not logged in, please log in!!!!<br> <a href=\"login.php\">login</a>");
          ?>
<form name="addparkinglot" action="addparkinglot.php" method="post">
        operating company name  <input type="text" name="operating_company_name" value="" required><br>
        No Of Floors  <input type="number" name="nofloors"  required ><br>
        No Of blocks  <input type="number" name="noblocks"  required ><br>
       zip code <input type="number" name="zip" value="" placeholder="example-587101" required><br>
       Address<input type="text" name="address" value="" placeholder=""><br>
       valet parking available?<input type="text" name="valet" placeholder="yes/no"><br>
       <button type="submit" name="Submit">Add lot</button><br><br><br><br><br>
       <?php
       echo '<a href="main.php">Go To Home?</a>';
       ?>
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
  $opname=$_POST['operating_company_name'];
  $nofloors=$_POST['nofloors'];
  $noblocks=$_POST['noblocks'];
  $zip=$_POST['zip'];
  $address=$_POST['address'];
  $valet=$_POST['valet'];
  $isWritten=false;
  $errorcode=-1;


  
 echo ($opname).($nofloors).($noblocks).($zip).($address);
if(!empty($opname)&&!empty($nofloors)&&!empty($noblocks)&&!empty($zip)&&!empty($address))
{
    if(empty($valet))
    {
        $stmt = $conn->prepare("INSERT INTO parking_lotss (operating_company_name, no_of_floors, no_of_blocks, zip, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiis",$opname,$nofloors,$noblocks,$zip,$address);
    }
    else
    {
        $stmt = $conn->prepare("INSERT INTO parking_lotss (operating_company_name, no_of_floors, no_of_blocks, zip, address,is_valet_parking_available) VALUES (?, ?, ?, ?, ?,?)");
        $stmt->bind_param("siiiss",$opname,$nofloors,$noblocks,$zip,$address,$valet);
    }
  if($stmt->execute())
  {
       $isWritten=true;
       $errorcode=100;
  }else {
    $isWritten=false;
    $errorcode=100;

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
   if($isWritten)
    {
        echo "<h2 >lot Added</h2><br><a href=\"main.php\">Take me to Home </a>";
       
    }
   else if($errorcode>0) {
      echo "<h2 class='error'>Something went wrong please try later</h2>";
      echo '<a href="main.php">Take me to Home </a>';

    }
    if($errorcode<0)
    {
      echo "<h2 >Adding user.... Please Wait  and refresh</h2>";
     
    }

      }    ?>

    






</body>
</html>
