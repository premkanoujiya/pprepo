<?php

  $host = "mysqlcnt";
  $user ="users";
  $pass = "pwd@12345";
  $dbname ="user_html";
  
  $conn = new mysqli($host , $user, $pass, $dbname);


  if ($conn-> connect_error){
    die("database connection failed:". $conn->connect_error);
  }
?>
