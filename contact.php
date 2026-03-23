<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and clean form values
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Basic validation (server-side)
    if ($name === '' || $email === '' || $message === '') {
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
        echo json_encode(['success' => true, 'message' => 'Thank you for your message! We will get back to you soon.']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Sorry, we could not send your message. Please try again later.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
}
