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

function cancelCustomerSubscriptions($customerId) {
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

function deleteCustomer($customerId) {
    $customer = \Stripe\Customer::retrieve($customerId);
    $customer->delete();
}

$email = $email_addr;

$customer = findCustomerByEmail($email);

if ($customer) {
    cancelCustomerSubscriptions($customer->id);
    deleteCustomer($customer->id);
    echo "Customer's subscriptions have been canceled, and their account has been deleted.";
} else {
    echo "No customer found with the provided email address.";
}
?>
