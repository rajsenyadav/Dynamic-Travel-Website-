<?php
// File: process-booking.php
require_once 'config/config.php';

header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Initialize response
$response = ['success' => false, 'message' => '', 'errors' => []];

// Sanitize and validate inputs
$name = isset($_POST['name']) ? sanitize_input($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitize_input($_POST['email']) : '';
$phone = isset($_POST['phone']) ? sanitize_input($_POST['phone']) : '';
$destination = isset($_POST['destination']) ? sanitize_input($_POST['destination']) : '';
$travel_date = isset($_POST['travel_date']) ? sanitize_input($_POST['travel_date']) : '';
$num_persons = isset($_POST['num_persons']) ? intval($_POST['num_persons']) : 0;
$message = isset($_POST['message']) ? sanitize_input($_POST['message']) : '';

// Validation
$errors = [];

// Name validation
if (empty($name)) {
    $errors['name'] = 'Name is required';
} elseif (strlen($name) < 3) {
    $errors['name'] = 'Name must be at least 3 characters';
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
    $errors['name'] = 'Name can only contain letters and spaces';
}

// Email validation
if (empty($email)) {
    $errors['email'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Invalid email format';
}

// Phone validation
if (empty($phone)) {
    $errors['phone'] = 'Phone number is required';
} elseif (!preg_match("/^[0-9+\-\s()]{10,15}$/", $phone)) {
    $errors['phone'] = 'Invalid phone number format';
}

// Destination validation
if (empty($destination)) {
    $errors['destination'] = 'Please select a destination';
}

// Travel date validation
if (empty($travel_date)) {
    $errors['travel_date'] = 'Travel date is required';
} else {
    $date = strtotime($travel_date);
    $today = strtotime(date('Y-m-d'));
    if ($date < $today) {
        $errors['travel_date'] = 'Travel date must be in the future';
    }
}

// Number of persons validation
if ($num_persons < 1) {
    $errors['num_persons'] = 'Number of persons must be at least 1';
} elseif ($num_persons > 50) {
    $errors['num_persons'] = 'Number of persons cannot exceed 50';
}

// If there are validation errors
if (!empty($errors)) {
    $response['errors'] = $errors;
    $response['message'] = 'Please correct the errors in the form';
    echo json_encode($response);
    exit();
}

// Get package ID if exists
$package_id = null;
$package_check = "SELECT id FROM packages WHERE package_name = '$destination' LIMIT 1";
$package_result = $conn->query($package_check);
if ($package_result && $package_result->num_rows > 0) {
    $package_data = $package_result->fetch_assoc();
    $package_id = $package_data['id'];
}

// Insert booking into database
$sql = "INSERT INTO bookings (name, email, phone, destination, travel_date, num_persons, message, package_id, status) 
        VALUES ('$name', '$email', '$phone', '$destination', '$travel_date', $num_persons, '$message', " . 
        ($package_id ? $package_id : "NULL") . ", 'pending')";

if ($conn->query($sql)) {
    $booking_id = $conn->insert_id;
    
    // Send email notification (optional - configure your mail settings)
    $to = get_setting('contact_email');
    $subject = "New Booking Request - Avipro Travels";
    $email_message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .booking-details { background: #f4f4f4; padding: 20px; border-radius: 5px; }
            .detail-row { margin: 10px 0; }
            .label { font-weight: bold; color: #333; }
        </style>
    </head>
    <body>
        <h2>New Booking Request Received</h2>
        <div class='booking-details'>
            <div class='detail-row'><span class='label'>Booking ID:</span> #$booking_id</div>
            <div class='detail-row'><span class='label'>Name:</span> $name</div>
            <div class='detail-row'><span class='label'>Email:</span> $email</div>
            <div class='detail-row'><span class='label'>Phone:</span> $phone</div>
            <div class='detail-row'><span class='label'>Destination:</span> $destination</div>
            <div class='detail-row'><span class='label'>Travel Date:</span> $travel_date</div>
            <div class='detail-row'><span class='label'>Number of Persons:</span> $num_persons</div>
            <div class='detail-row'><span class='label'>Message:</span> $message</div>
        </div>
        <p>Please log in to the admin panel to view and process this booking.</p>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Avipro Travels <noreply@avipro.com>" . "\r\n";
    
    // Uncomment to enable email sending
    // mail($to, $subject, $email_message, $headers);
    
    // Send confirmation email to customer
    $customer_subject = "Booking Request Received - Avipro Travels";
    $customer_message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .header { background: #007bff; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .footer { background: #f4f4f4; padding: 15px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>Thank You for Choosing Avipro Travels!</h1>
        </div>
        <div class='content'>
            <p>Dear $name,</p>
            <p>We have received your booking request. Here are the details:</p>
            <ul>
                <li><strong>Booking ID:</strong> #$booking_id</li>
                <li><strong>Destination:</strong> $destination</li>
                <li><strong>Travel Date:</strong> $travel_date</li>
                <li><strong>Number of Persons:</strong> $num_persons</li>
            </ul>
            <p>Our travel expert will contact you shortly with a detailed quote and further information.</p>
            <p>If you have any questions, feel free to contact us at " . get_setting('contact_phone') . "</p>
            <p>Best regards,<br>Avipro Travels Team</p>
        </div>
        <div class='footer'>
            <p>&copy; " . date('Y') . " Avipro Travels. All rights reserved.</p>
        </div>
    </body>
    </html>
    ";
    
    // Uncomment to enable customer email
    // mail($email, $customer_subject, $customer_message, $headers);
    
    $response['success'] = true;
    $response['message'] = 'Your booking request has been submitted successfully! We will contact you shortly.';
    $response['booking_id'] = $booking_id;
} else {
    $response['message'] = 'Sorry, there was an error processing your booking. Please try again or contact us directly.';
    $response['error'] = $conn->error;
}

echo json_encode($response);
$conn->close();
?>