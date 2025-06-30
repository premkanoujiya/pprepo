<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Step 1<br>";


$basePath = '/home/class/php/mailer/src/';
if (!file_exists($basePath . 'PHPMailer.php')) {
    die(" PHPMailer.php not found at $basePath");
}

require_once $basePath . 'PHPMailer.php';
require_once $basePath . 'SMTP.php';
require_once $basePath . 'Exception.php';

echo "Step 2<br>";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

echo "Step 3<br>";

$otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
echo "Generated OTP: $otp<br>";

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2; // or 0 for silent
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'prem351995@gmail.com';
    $mail->Password   = 'zbff rcoz sbxn votq'; // ✅ App Password, not Gmail password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('prem351995@gmail.com', 'Prem Patel');
    $mail->addAddress('yourtestreceiver@gmail.com', 'Test User');
    $mail->isHTML(true);
    $mail->Subject = 'OTP Test';
    $mail->Body    = "Aapka OTP hai: <b>$otp</b>";

    echo "Sending mail...<br>";
    $mail->send();
    echo "✅ Email sent successfully!";
} catch (Exception $e) {
    echo "❌ Error sending mail: " . $mail->ErrorInfo;
}
?>







