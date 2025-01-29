<?php
// Autoload PHPMailer classes using Composer
require 'vendor/autoload.php';

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Sanitize inputs
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$website = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

if (!empty($email) && !empty($message)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server (e.g., smtp.gmail.com for Gmail)
            $mail->SMTPAuth = true;
            $mail->Username = 'oluwaseyielujoba15@gmail.com'; // Your email address
            $mail->Password = 'qinzuvoqofotegst';   // App-specific password (not your email password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption (TLS/SSL)
            $mail->Port = 587; // SMTP port (587 for TLS, 465 for SSL)

            // Recipients
            $mail->setFrom('oluwaseyielujoba15@gmail.com', 'Ebenezer'); // Sender email
            $mail->addAddress('oluwaseyielujoba15@gmail.com', 'Recipient Name'); // Receiver email

            // Content
            $mail->Subject = "From: $name <$email>";
            $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage:\n$message\n\nRegards,\n$name";

            // Send the email
            $mail->send();
            echo "Your message has been sent successfully.";
        } catch (Exception $e) {
            echo "Sorry, failed to send your message. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Enter a valid email address!";
    }
} else {
    echo "Email and message fields are required!";
}
?>
