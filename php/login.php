
<?php

  $host = "localhost";
  $user ="root";
  $pass = "";
  $dbname ="auto_system";
  
  $conn = new mysqli($host , $user, $pass, $dbname);


  if ($conn-> connect_error){
    die("database connection failed:". $conn->connect_error);
  }
?>

<?php
include '../database/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (email, phone, first_name, last_name, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $email, $phone, $first_name, $last_name, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful. You can now <a href='../public/login.html'>login</a>.";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
}

?>




