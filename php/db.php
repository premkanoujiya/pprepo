<?php

  $host = 'mysqlcnt';
  $user ='root';
  $pass = 'pwd@12345';
  $dbname ='user';
  
  $conn = new mysqli($host , $user, $pass, $dbname);
  

  if ($conn-> connect_error){
    die("database connection failed:". $conn->connect_error);
  }
 
?>
