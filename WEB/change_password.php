<?php
require ('autoexec.php');
// TODO: Implement your database connection and user authentication logic here.

// Get the data from the POST request
$new_password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Check if the new password and confirm password match
if ($new_password === $confirm_password) {
    $new_password_u8 = password_hash($new_password, PASSWORD_DEFAULT);
    $sql = "UPDATE users_ai SET password_u8 = ? WHERE email_addr = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $new_password_u8, $email_addr);
$stmt->execute();

    // Send a response indicating success
    echo json_encode(['success' => true]);
} else {
    // Send a response indicating failure
    echo json_encode(['success' => false]);
}
