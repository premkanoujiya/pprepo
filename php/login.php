

<?php
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
            echo "Incorrect password. Please try again.";  // yahan sahi error message
        }
    } else {
        echo " Invalid email or user not found.";  // yahan bhi sahi error message
    }
} else {
    echo " Please submit the form.";

    
}



