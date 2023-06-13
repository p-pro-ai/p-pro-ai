<?php
date_default_timezone_set("Europe/Sofia");
session_start();
require ('autoexec.php');
require '../vendor/autoload.php';


\Stripe\Stripe::setApiKey('******');

$customer_email = $email_addr; // Replace with the customer's email

// Retrieve the customer by email
$customers = \Stripe\Customer::all([
    'email' => $customer_email,
    'limit' => 1,
]);

if (count($customers->data) > 0) {
    $customer = $customers->data[0];

    // Retrieve the subscriptions for the customer
    $subscriptions = \Stripe\Subscription::all([
        'customer' => $customer->id,
    ]);

    $active_or_trialing_subscriptions = array_filter($subscriptions->data, function ($subscription) {
        return $subscription->status === 'active' || $subscription->status === 'trialing';
    });

    if (count($active_or_trialing_subscriptions) > 0) {
        // Iterate over the active or trialing subscriptions
        foreach ($active_or_trialing_subscriptions as $subscription) {
            $period_start = date('d.m.Y', $subscription->current_period_start);
            $next_billing = date('d.m.Y', $subscription->current_period_end);
            switch ($subscription->items->data[0]->price->id) {
                case '****':
                    $plan_status = 'basic';
                    break;
                case '*****':
                    $plan_status = 'pro';
                    break;
                case '****':
                    $plan_status = 'premium';
                    break;
                default:
                    $plan_status = 'free';
            }
        }
    } else {
        $plan_status = 'free';
    }
} else {
    $plan_status = 'free';
}
