<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = mysqli_connect($emil,$phone,$firstname, $lastname, $password, $confirmpassword,$mared);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

