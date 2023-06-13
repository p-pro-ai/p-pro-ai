<?php
require_once '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('******');

if (isset($_POST['stripe_token']) && isset($_POST['email'])) {
    $token = $_POST['stripe_token'];
    $email = $_POST['email'];

    try {
        // Create a new customer and subscription as before

        // Redirect to the success page
        header('Location: success.html');
        exit();
    } catch (\Stripe\Exception\ApiErrorException $e) {
        // Display an error message and redirect back to the checkout page
        // You can use sessions to store the error message and display it on the checkout page
        header('Location: checkout.html');
        exit();
    }
} else {
    // Redirect back to the checkout page with an error message
    // You can use sessions to store the error message and display it on the checkout page
    header('Location: checkout.html');
    exit();
}
