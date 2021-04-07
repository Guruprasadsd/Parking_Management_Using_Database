<?php
                session_start();
               // echo("hello  ".$_SESSION['username']);
                if(isset($_SESSION['username']));
              //echo "<h3 class='links' > Signed In as ".$_SESSION['username'].'<a href="login.php?logout=1">Log Out</a></h3>';
              else
              die ("not logged in, please log in!!!!<br> <a href=\"login.php\">login</a>");
              if(isset($_GET['userid'])&& isset($_GET['type']))
              {
                require 'dbConnect.php';
                $conn = getConnection();
                if($conn->connect_error)
                {
                header("Location: signUp.php?status=&failed" );
                }
                
                
                $stmt = $conn->prepare("INSERT INTO userlog (user_id,type) VALUES (?, ?)");
                $stmt->bind_param("is", $_GET['userid'],$_GET['type']);
                $isWritten=false;//echo $Name.$ph_no.$vehicle_no.$isregular;
                if($stmt->execute())
                {
                     $isWritten=true;
                     $errorcode=100;
                }else {
                  $isWritten=false;
                  $errorcode=100;
              
                }
              
              
              }
              if(!$isWritten)
              {
                  die ("ERROR writing log");
              } 
              else
              {
                  if($_GET['type']=="login")
                header("Location: main.php");
                else if($_GET['type']=="logout")
                header("Location: login.php?logout=1");
              }   
          ?>
