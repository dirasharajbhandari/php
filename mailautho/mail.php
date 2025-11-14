<?php
$to = "anish.official051@gmail.com";
$subject = "Test from PHP on macOS";
$message = "This email was sent using PHP mail() via msmtp and Gmail!";
$headers = "From: dirasharajbhandari@gmail.com";

if (mail($to, $subject, $message, $headers)) {
    echo "✅ Email sent successfully!";
} else {
    echo "❌ Failed to send email.";
}
?>