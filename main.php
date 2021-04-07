<!DOCTYPE html>
<html>
    <head>
        <title>
           home page
        </title>
    </head>
    <body>
            <?php
                session_start();
               // echo("hello  ".$_SESSION['username']);
                if(isset($_SESSION['username']))
                echo 'Signed In as '.$_SESSION['username'].'<a href="userlog.php?userid='.$_SESSION['userid'].'&type=logout">  Log Out</a>';
              else
              die ("not logged in, please log in!!!!<br> <a href=\"login.php\">login</a>");
          ?>
          <h1>parking management system</h1>
        <table>
        <h3><tr><a href="addcustomer.php">add customer</a></tr><br>
        <tr><a href="addregularcustomer.php">add regular customer</a></tr><br>
        <tr><a href="addparkinglot.php">add parking lot</a></tr><br>
        <tr><a href="custdetails.php">customer details</a></tr><br>
        <tr><a href="parkinglotdetails.php">parking lot details</a></tr><br>
        <tr><a href="newcarparked.php">new car parked?</a></tr><br>
        <tr><a href="createreceipt.php">car location</a></tr><br>
        <tr><a href="removecustomer.php">remove customer </a></tr><br>
        <tr><a href="removeregularcustomer.php">remove regular customer </a></tr><br>
        <tr><a href="createreceipt.php">create receipt?</a></tr><br>
        <tr><a href="endregularcustomer.php">end regular customer</a></tr><br>
        </h3>
        <br><br><br><br><br>
        <?php
        //
        if($_SESSION['username']=='Gururaj'|| $_SESSION['username']=='guruprasad' ||$_SESSION['username']=='geeta')
        {
            echo '<p class="links"> <a  href="signUp.php">Add a New User ? Click Here To Add</a>  </p> <br> ';

        }
        ?>
    </body>
</html>
