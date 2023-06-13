<?php
session_start();
require ('autoexec.php');
require ('check_subscription.php');

switch ($plan_status) {
  case 'basic':
     die();
      break;
  case 'pro':
    die();
      break;
  case 'premium':
    die();
      break;
  default:
  
}
require '../vendor/autoload.php';

\Stripe\Stripe::setApiKey('******'); // Replace with your secret key

header('Content-Type: application/json');

try {
    if($email_addr == 'a.game.studios3@gmail.com' || $email_addr == 'petrovsvetoslav82@gmail.com' || $email_addr == 'mariqnedkova@abv.bg' || $email_addr == 'cvetelinagenova007@gmail.com' || $email_addr == 'yesnolikemy@gmail.com' || $email_addr == 'hazza3100@yahoo.com' || $email_addr == 'oscar1979@outlook.com' || $email_addr == 'ptopalova03@gmail.com' || $email_addr == 'aleksandarpetrov2008@abv.bg') {
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => '****', // Replace with your monthly subscription Price ID
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=true', // Replace with your success page URL
            'cancel_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=error', // Replace with your cancel page URL
            'customer_email' => $email_addr,
             'subscription_data' => [
                 'trial_period_days' => 7, // Add 7-day free trial
             ],
        ]);
    }else{
        if($_SESSION['twitterhasantoor'] == true){
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price' => '****', // Replace with your monthly subscription Price ID
            'quantity' => 1,
        ]],
        'mode' => 'subscription',
        'success_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=true&twitterhasantoor_success=true', // Replace with your success page URL
        'cancel_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=error', // Replace with your cancel page URL
        'customer_email' => $email_addr,
        // 'subscription_data' => [
        //     'trial_period_days' => 30, // Add 30-day free trial
        // ],
    ]);
}else{
    if($_SESSION['application_user'] == true){
        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price' => '****', // Replace with your monthly subscription Price ID
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => 'https://p-pro.eu/ai/success.php', // Replace with your success page URL
            'cancel_url' => 'https://p-pro.eu/ai/error.php', // Replace with your cancel page URL
            'customer_email' => $email_addr,
            // 'subscription_data' => [
            //     'trial_period_days' => 30, // Add 30-day free trial
            // ],
        ]);
    }else{
    $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price' => '****', // Replace with your monthly subscription Price ID
            'quantity' => 1,
        ]],
        'mode' => 'subscription',
        'success_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=true', // Replace with your success page URL
        'cancel_url' => 'https://p-pro.eu/ai/dashboard.php?newplan_success=error', // Replace with your cancel page URL
        'customer_email' => $email_addr,
        // 'subscription_data' => [
        //     'trial_period_days' => 30, // Add 30-day free trial
        // ],
    ]);
}
}
}
    echo json_encode(['id' => $checkout_session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
