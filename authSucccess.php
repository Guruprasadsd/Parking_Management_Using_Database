<?php
 session_start();
 $_SESSION['userid']=$_GET['userid'];
 $_SESSION['username']=$_GET['user'];
 $_SESSION['useremail']=$_GET['useremail'];

 header("Location: userlog.php?userid=".$_GET['userid']."&type=login");
//echo ' <a href="userlog.php?userid='.$_SESSION['userid'].'"&type=logout>';
//echo '<h3 class=\'links\' > Signed In as '.$_SESSION['username'].'<a href="userlog.php?userid='.$_SESSION['userid'].'&type=logout>  Log Out</a></h3>';

 ?>
