<?php
session_start();

$user_otp = $_POST['otp'];
$session_otp = $_SESSION['otp'] ?? null;

if ($user_otp == $session_otp) {
    echo "OTP verified! Login successful.";
    // Set user session here if needed
    unset($_SESSION['otp']); // clear OTP after success
} else {
    echo "Invalid OTP!";
}





