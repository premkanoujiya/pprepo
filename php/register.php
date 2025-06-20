<?php
ob_start(); // Start output buffering (prevents header errors)
require_once "db.php";


$email = $_POST['email'];
$phone = $_POST['phone'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];


if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match'); window.history.back();</script>";
    exit();
}


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Email already registered'); window.history.back();</script>";
    exit();
}


$sql = "INSERT INTO users (email, phone, first_name, last_name, password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $email, $phone, $firstName, $lastName, $hashedPassword);

if ($stmt->execute()) {
    
    header("Location: " . dirname($_SERVER['REQUEST_URI']) . "/../public/login.html");
    exit();
} else {
    echo "<script>alert('Registration failed'); window.history.back();</script>";
}
ob_end_flush(); 
?>










