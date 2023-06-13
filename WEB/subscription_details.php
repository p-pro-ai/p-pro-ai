<?php
switch ($plan_status) {
    case 'basic':
        $plan_name = 'Basic';
        $plan_price = '2.90 EUR/month';
        break;
    case 'pro':
        $plan_name = 'Pro';
        $plan_price = '7.90 EUR/month';
        break;
    case 'premium':
        $plan_name = 'Premium';
        $plan_price = '17.90 EUR/month';
        break;
    default:
        $plan_name = 'Free';
        $plan_price = 'free';
        $next_billing = 'Infinite';
}
?>
<div class="subscription-details">
    <h2>Current Subscription</h2>
    <p>Plan: <?php echo $plan_name; ?></p>
    <p>Price: <?php echo $plan_price; ?></p>
    <p>Next Billing Date: <?php echo $next_billing; ?></p>
    <?php if($plan_name == 'Free'){}else{ ?>
<button class="cancel-button" id="cancelButton">Cancel Subscription imidiatly (to buy a new one for example)</button>
<button class="cancel-at-period-end-button" id="cancelAtPeriodEndButton">Cancel (but have the current features till the end of the current period)</button>
<?php } ?>

</div>
