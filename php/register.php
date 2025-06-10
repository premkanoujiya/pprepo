<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $marital_status = $_POST['marital_status'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT);


    if ($password !== $confirm_password) {
        die("❌ Password and Confirm Password do not match!");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, phone, first_name, last_name, password, marital_status) VALUES (?, ?, ?, ?, ?, ?)";


    // ✅ Prepare statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $email, $phone, $first_name, $last_name, $password_hash, $marital_status);
    



    // ❌ If prepare fails
    if (!$stmt) {
        die("❌ Prepare failed: ". $conn->error);
    }

    // ✅ Bind parameters
    $stmt->bind_param("ssssss", $email, $phone, $first_name, $last_name, $password_hash, $marital_status);

    // ✅ Execute
    if ($stmt->execute()) {
        echo "✅ Registration successful! <a href='../public/login.html'>Login here</a>";
    } else {
        echo "❌ Execution failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "❌ Invalid request";
}
?>


