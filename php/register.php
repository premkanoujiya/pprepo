<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db.php'; // your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'] ?? '';
    $last_name  = $_POST['last_name'] ?? '';
    $email      = $_POST['email'] ?? '';
    $phone      = $_POST['phone'] ?? '';

    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
        echo "❌ All fields are required.";
        exit;
    }

    // ✅ Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();
    if ($result->num_rows > 0) {
        echo "❌ This email is already registered.";
        exit;
    }
    $check->close();

    // ✅ Insert new record
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $phone);

    if ($stmt->execute()) {
        echo "✅ Registration successful!";
    } else {
        echo "❌ Database Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
