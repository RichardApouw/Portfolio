<?php
// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'richardapouw@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        // Sanitize input data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // Create email headers
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: $name <$email>" . "\r\n";

        // Compose email message
        $email_message = "<strong>Name:</strong> $name<br>";
        $email_message .= "<strong>Email:</strong> $email<br>";
        $email_message .= "<strong>Subject:</strong> $subject<br>";
        $email_message .= "<strong>Message:</strong> $message<br>";

        // Send email
        $sent = mail($receiving_email_address, $subject, $email_message, $headers);

        // Check if mail was sent successfully
        if ($sent) {
            echo 'OK';
        } else {
            echo 'Error';
        }
    } else {
        // Required fields are missing
        echo 'Error: Required fields are missing.';
    }
} else {
    // If the request method is not POST, show error
    echo 'Error: Only POST requests are allowed.';
}

?>
