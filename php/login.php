<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require 'db.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
    
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
    
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['email'];
                echo "Login successful!";
            } else {
                echo "invalid password"; 
            }
        } else {
            echo " Invalid email or user not found.";
        }
    } else {
        echo " Please submit the form.";
       
    }
    
    



