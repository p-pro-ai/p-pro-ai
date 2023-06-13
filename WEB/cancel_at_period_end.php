<?php
require ('autoexec.php');
require_once('../vendor/autoload.php');
\Stripe\Stripe::setApiKey('******');

function findCustomerByEmail($email) {
    $customers = \Stripe\Customer::all([
        'email' => $email,
        'limit' => 1
    ]);

    if (count($customers->data) > 0) {
        return $customers->data[0];
    }

    return null;
}

function cancelCustomerSubscriptionsAtPeriodEnd($customerId) {
    $subscriptions = \Stripe\Subscription::all([
        'customer' => $customerId,
        'status' => 'active'
    ]);

    foreach ($subscriptions->data as $subscription) {
        \Stripe\Subscription::update($subscription->id, [
            'cancel_at_period_end' => true
        ]);
    }
}

$email = $email_addr;

$customer = findCustomerByEmail($email);

if ($customer) {
    cancelCustomerSubscriptionsAtPeriodEnd($customer->id);
    echo "Customer's subscriptions will be canceled at the end of the current billing period.";
} else {
    echo "No customer found with the provided email address.";
}
?>
