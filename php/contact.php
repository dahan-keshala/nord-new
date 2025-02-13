<?php
$errors = array();

// Check if name has been entered
if (empty($_POST['name'])) {
    $errors['name'] = 'Please enter your name';
}

// Check if email has been entered and is valid
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address';
}

// Check if message has been entered
if (empty($_POST['message'])) {
    $errors['message'] = 'Please enter your message';
}

// If there are errors, return them
if (!empty($errors)) {
    echo '<div class="alert alert-danger alert-dismissible" role="alert">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error) . '</li>';
    }
    echo '</ul></div>';
    die();
}

// Sanitize input data
$name = htmlspecialchars($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars($_POST['message']);

$to = 'dahankeshala@gmail.com';  // Change this to your email
$subject = 'Contact Form: Nord Shipping';
$body = "From: $name\nE-Mail: $email\nMessage:\n$message";

// Set headers
$headers = "From: dahankeshala@gmail.com\r\n"; // Change domain
$headers .= "Reply-To: $email\r\n"; // Allows replying to sender
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if (mail($to, $subject, $body, $headers)) {
    echo '<div class="alert alert-success alert-dismissible" role="alert">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo 'Thank You! I will be in touch.';
    echo '</div>';
} else {
    echo '<div class="alert alert-danger alert-dismissible" role="alert">';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    echo 'Something went wrong. Please try again later.';
    echo '</div>';
}
?>
