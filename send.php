<?php
if(isset($_GET))
{
$message='lot id='.$_GET['lotid'].'
floor number='.$_GET['floorid'].'
block number='.$_GET['blockid'];
$header="gururajotagerimail2@gmail.com";
$subject="parking location";
$to=$_GET['email'];

echo(mail($to,$subject,$message,$header));
header("Location: main.php");

}

?>
