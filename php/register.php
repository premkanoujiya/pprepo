
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("❌ Password and Confirm Password do not match!");
    }

    // ✅ Password hash once only
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // ✅ SQL query
    $sql = "INSERT INTO users (email, phone, first_name, last_name, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("❌ Prepare failed: " . $conn->error);
    }

    // ✅ Corrected bind_param
    $stmt->bind_param("sssss", $email, $phone, $first_name, $last_name, $password_hash);

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




