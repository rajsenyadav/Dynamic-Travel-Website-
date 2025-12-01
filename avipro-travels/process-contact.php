<?php
// File: process-contact.php
require_once 'config/config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit();
}

$response = ['success' => false, 'message' => ''];

// Sanitize inputs
$name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
$subject = isset($_POST['subject']) ? sanitize_input($_POST['subject']) : '';
$message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';

// Validation
$errors = [];

if (empty($name) || strlen($name) < 3) {
    $errors[] = 'Valid name is required';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}

if (empty($subject) || strlen($subject) < 5) {
    $errors[] = 'Subject must be at least 5 characters';
}

if (empty($message) || strlen($message) < 10) {
    $errors[] = 'Message must be at least 10 characters';
}

if (!empty($errors)) {
    $response['message'] = implode(', ', $errors);
    echo json_encode($response);
    exit();
}

// Insert into database
$sql = "INSERT INTO contact_messages (name, email, subject, message, status) 
        VALUES ('$name', '$email', '$subject', '$message', 'unread')";

if ($conn->query($sql)) {
    $response['success'] = true;
    $response['message'] = 'Thank you for contacting us! We will get back to you soon.';
} else {
    $response['message'] = 'An error occurred. Please try again or contact us directly.';
}

echo json_encode($response);
$conn->close();
?>