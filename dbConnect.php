<?php

// Create connection
function getConnection() {
  $servername = "127.0.0.1:3308";
  $username = "root";
  $password = "";
  $database="parking_management";

  

    $conn = new mysqli($servername, $username, $password,$database);

    if ($conn->connect_error) {
      //die("Connection failed: ");
      return 0;
    }
    else
    {
     // echo "Connected successfully";
     return $conn;
    }

}



?>
