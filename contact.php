<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and clean form values
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation (server-side)
    if ($name === '' || $email === '' || $phone === '' || $message === '') {
        http_response_code(400);
        echo "Missing required fields.";
        exit;
    }

    // Send to Rantharu Tools Addresses
    $to = "info@rantharutools.lk";

    $subject = "New contact form message from $name";

    $body  = "You have received a new message from the contact form on rantharutools.lk.\n\n";
    $body .= "Name:  $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n\n";
    $body .= "Message:\n$message\n";

    // Email headers
    $headers  = "From: Rantharu Tools Website <info@rantharutools.lk>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    if (mail($to, $subject, $body, $headers)) {
        // Simple success page (for normal form submit)
        echo "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Thank You - Rantharu Machines and Tools</title>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<link rel='stylesheet' href='assets/css/style.css'></head><body style='text-align:center; padding: 100px 20px;'>";
        echo "<h2 style='color: #1E3A5F; font-size: 2.5rem; margin-bottom: 20px;'>Thank you for your message!</h2>";
        echo "<p style='font-size: 1.1rem; margin-bottom: 30px;'>We have received your enquiry and will get back to you soon.</p>";
        echo "<p><a href='/' class='btn btn-primary'>Back to Home Page</a></p>";
        echo "</body></html>";
    } else {
        http_response_code(500);
        echo "Sorry, we could not send your message. Please try again later.";
    }
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
