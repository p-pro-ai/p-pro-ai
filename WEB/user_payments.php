<?php

require ('autoexec.php');
require ('check_subscription.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payments Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
   body {
  font-family: Arial, sans-serif;
  background-color: #1a1a1a;
  background-image: url('matrix-rain.gif');
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  color: #FFFFFF;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

header {
  background-color: #333333;
  width: 100%;
}

h1 {
  text-align: center;
  font-size: 2.5em;
  color: #9c27b0;
  margin-bottom: 30px;
  display: inline-block;
}

nav {
  width: 100%;
  display: flex;
  justify-content: center;
}

.user-menu {
  position: relative;
}

.user-menu i {
  font-size: 2em;
  cursor: pointer;
  color: #FFFFFF;
}

.user-menu i:hover {
  color: #9c27b0;
}

.user-dropdown {
  display: none;
  position: absolute;
  top: 100%;
  left: 50%;
  transform: translateX(-50%);
  background-color: #333333;
  padding: 10px;
  border-radius: 5px;
  width: 200px;
  z-index: 100;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.user-dropdown a {
  display: block;
  color: #FFFFFF;
  text-decoration: none;
  padding: 5px 0;
}

.user-dropdown a:hover {
  color: #9c27b0;
}

.show-dropdown {
  display: block;
}

@media (min-width: 992px) {
  .container {
    flex-direction: row;
    justify-content: space-between;
  }

  nav {
    justify-content: flex-end;
  }

  .user-dropdown {
    left: auto;
    right: 0;
    transform: none;
  }
}

.dashboard {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  grid-gap: 20px;
  width: 100%;
}

.card {
  background-color: #333333;
  padding: 20px;
  border-radius: 5px;
  text-align: center;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;
}

.card:hover {
  transform: translateY(-5px);
}

.card i {
  font-size: 3em;
  margin-bottom: 10px;
}

.card h3 {
  font-size: 1.5em;
  margin-bottom: 10px;
}

#chat {
  color: #9c27b0;
}
#chat_35{
    color: #b02792;
}

#text-gen {
  color: #3f51b5;
}

#math-solver {
  color: #e91e63;
}

#translator {
  color: #2196f3;
}

footer {
    position: relative;
  background-color: #333333;
  padding: 20px 0 0;
text-align: center;
width: 100%;
}

footer a {
color: #FFFFFF;
text-decoration: none;
margin: 20px 10px;
}

footer a:hover {
color: #9c27b0;
}

    .subscription-details {
      background-color: #333333;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      margin-bottom: 20px;
    }

    .subscription-details h2 {
      font-size: 2em;
      color: #9c27b0;
      margin-bottom: 15px;
    }

    .subscription-details p {
      font-size: 1.2em;
      margin-bottom: 20px;
    }

    .cancel-button {
      background-color: #e91e63;
      color: #FFFFFF;
      padding: 10px 20px;
      font-size: 1.2em;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .cancel-button:hover {
      background-color: #d41752;
    }
    .success-message {
        display: none;
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        margin: 10px 0;
        border-radius: 4px;
    }
    .loading-message {
        display: none;
        background-color: #f1f1f1;
        color: #555;
        padding: 12px 20px;
        margin: 10px 0;
        border-radius: 4px;
    }
  </style>
</head>
<body>
<header>
    <div class="container">
      <h1>User Dashboard</h1>
      <nav>
        <div class="user-menu" id="userMenu">
          <i class="fas fa-user-circle" id="userIcon"></i>
          <div class="user-dropdown" id="userDropdown">
          <a href="dashboard.php">Dashboard</a>
            <a href="account_settings.php">Account Settings</a>
            <a href="user_payments.php">Payment</a>
            <a href="signout.php">Sign Out</a>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="container">
    <div class="subscription-details">
      <h2>Current Subscription</h2>
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
      <p>Plan: <?php echo $plan_name; ?></p>
      <p>Price: <?php echo $plan_price; ?></p>
      <p>Next Billing Date: <?php echo $next_billing; ?></p>
      <?php if($plan_name == 'Free'){}else{ ?>
        <button class="cancel-button" id="cancelButton">Cancel Subscription imidiatly (to buy a new one for example)</button>
<br><br><br>
        <button class="cancel-button" id="cancelAtPeriodEndButton">Cancel (but have the current features till the end of the current period)</button>

        <div id="loadingMessage" class="loading-message">Loading...</div>
      <div id="successMessage" class="success-message"></div>
      <?php } ?>
    </div>
  </div>

  <footer>
    <div class="container">
      <a href="pricing.php">Pricing</a>
      <a href="contacts.html">Contact Us</a>
      <a href="terms.html">Terms of Service</a>
    </div>
  </footer>  

  <script>
    const cancelButton = document.getElementById('cancelButton');
    const cancelAtPeriodEndButton = document.getElementById('cancelAtPeriodEndButton');
    const successMessage = document.getElementById('successMessage');
    const loadingMessage = document.getElementById('loadingMessage');
    const subscriptionDetails = document.querySelector('.subscription-details');

    function getSubscriptionDetails() {
        // Replace this URL with the URL of the PHP script that generates the subscription details HTML
        fetch('subscription_details.php')
            .then(response => response.text())
            .then(result => {
                subscriptionDetails.innerHTML = result;
            })
            .catch(error => {
                console.error('Error fetching subscription_details.php:', error);
            });
    }

    cancelButton.addEventListener('click', () => {
        loadingMessage.style.display = 'block';

        fetch('cancel_subscription.php')
            .then(response => response.text())
            .then(result => {
                loadingMessage.style.display = 'none';

                if (result.includes("Customer's subscriptions have been canceled, and their account has been deleted.")) {
                    successMessage.innerHTML = 'You have successfully canceled your subscription!';
                    successMessage.style.display = 'block';
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);

                    // Refresh subscription details
                    getSubscriptionDetails();
                } else {
                    console.error('Error canceling subscription:', result);
                }
            })
            .catch(error => {
                loadingMessage.style.display = 'none';
                console.error('Error fetching cancel_subscription.php:', error);
            });
    });

    cancelAtPeriodEndButton.addEventListener('click', () => {
        loadingMessage.style.display = 'block';

        fetch('cancel_at_period_end.php')
            .then(response => response.text())
            .then(result => {
                loadingMessage.style.display = 'none';

                if (result.includes("Customer's subscriptions will be canceled at the end of the current billing period.")) {
                    successMessage.innerHTML = 'Your subscription will be canceled at the end of the current billing period.';
                    successMessage.style.display = 'block';
                    setTimeout(() => {
                        successMessage.style.display = 'none';
                    }, 5000);
                } else {
                    console.error('Error canceling subscription at period end:', result);
                }
            })
            .catch(error => {
                loadingMessage.style.display = 'none';
                console.error('Error fetching cancel_at_period_end.php:', error);
            });
    });
</script>



<script>
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');

    userIcon.addEventListener('click', () => {
      userDropdown.classList.toggle('show-dropdown');
    });
  </script>

</body>
</html>
