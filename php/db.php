<?php
$host = "mysqlcnt";
$user = "root";
$pass = "pwd@12345";
$dbname = "user";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("❌ DB Connection Failed: " . $conn->connect_error);
}
?>



