<?php

require ('autoexec.php');
require ('check_subscription.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="pricing.css">
  <title>Pricing</title>
  <script src="https://js.stripe.com/v3/"></script>
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

    body {
  font-family: Arial, sans-serif;
  background-color: #1a1a1a;
  color: #FFFFFF;
  margin: 0;
  padding: 0;
}

header {
  background-color: #333333;
  padding: 20px 0;
  text-align: center;
  width: 100%;
}

h1 {
  font-size: 2.5em;
  color: #9c27b0;
  margin-bottom: 30px;
}

.pricing-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin: 0 auto;
  max-width: 1200px;
  padding: 20px;
}

.pricing-card {
  background-color: #333333;
  border-radius: 5px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  margin: 20px;
  padding: 20px;
  text-align: center;
  width: 300px;
}

.pricing-card h2 {
  font-size: 1.75em;
  margin-bottom: 10px;
}

.pricing-card h3 {
  font-size: 1.5em;
  margin-bottom: 20px;
}

.pricing-card ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.pricing-card li {
  margin-bottom: 10px;
}

button {
  background-color: #9c27b0;
  border: none;
  border-radius: 5px;
  color: #FFFFFF;
  cursor: pointer;
font-size: 1em;
padding: 10px 20px;
text-transform: uppercase;
transition: background-color 0.3s;
}

button:hover {
background-color: #7b1fa2;
}

@media (max-width: 768px) {
.pricing-container {
flex-direction: column;
}

.pricing-card {
margin: 20px auto;
}
}
  </style>
    <script src="https://kit.fontawesome.com/4874d26c0b.js" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <div class="container">
      <h1>Pricing plans</h1>
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
  <main>
    <div class="pricing-container">
      
      <div class="pricing-card">
        <h2>Basic</h2>
        <?php
        if($email_addr == 'a.game.studios3@gmail.com' || $email_addr == 'petrovsvetoslav82@gmail.com' || $email_addr == 'Georgi.pasev@abax.bg' || $email_addr == 'mariqnedkova@abv.bg' || $email_addr == 'cvetelinagenova007@gmail.com' || $email_addr == 'yesnolikemy@gmail.com' || $email_addr == 'hazza3100@yahoo.com' || $email_addr == 'oscar1979@outlook.com' || $email_addr == 'ptopalova03@gmail.com' || $email_addr == 'aleksandarpetrov2008@abv.bg') {
        ?>
        <h3>7 days free</h3>
        <p style="margin-top: -10px">Then 2.90 EUR/month</p>
        <br>
        <?php }else{?>
          <h3>2.90 EUR/month</h3>
          <?php } ?>
        <ul>
        <li>Everything in the Free plan</li>
          <li>300 messages per month for GPT 3.5</li>
          <li>50 messages per month for GPT 4</li>
          <li>Email support</li>
        </ul>
        <?php
switch ($plan_status) {
  case 'basic':
      ?>
      <br>
      <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
      <?php
      break;
  case 'pro':
    ?>
    <br>
    <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
    <?php
      break;
  case 'premium':
    ?>
    <br>
    <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
    <?php
      break;
  default:
  ?>
  <button id="basic_checkout_button">Get Started</button>
  <?php
}
        ?>
        
        <script>
        const publicKey = 'pk_live_51N4KymKy2Ki2xcvjfsANuH6axZwW7Z6rezNpcYMGA35ptwrHC88WomjnOqZzQEXQ4OwBN3kxePeLiMnU17b5wLql00Mt2lSPuj'; // Replace with your publishable key
        const stripe = Stripe(publicKey);

        document.getElementById('basic_checkout_button').addEventListener('click', () => {
            fetch('basic_checkout.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
      </div>
      <div class="pricing-card">
        <h2>Pro</h2>
        <?php
        if($email_addr == 'a.game.studios3@gmail.com' || $email_addr == 'petrovsvetoslav82@gmail.com' || $email_addr == 'Georgi.pasev@abax.bg' || $email_addr == 'mariqnedkova@abv.bg' || $email_addr == 'cvetelinagenova007@gmail.com' || $email_addr == 'yesnolikemy@gmail.com' || $email_addr == 'hazza3100@yahoo.com' || $email_addr == 'oscar1979@outlook.com' || $email_addr == 'ptopalova03@gmail.com' || $email_addr == 'aleksandarpetrov2008@abv.bg') {
        ?>
        <h3>7 days free</h3>
        <p style="margin-top: -10px">Then 7.90 EUR/month</p>
        <br>
        <?php }else{?>
          <h3>7.90 EUR/month</h3>
          <?php } ?>
        <ul>
        <li>Everything in the Basic plan</li>
        <li>Unlimited messages for GPT 3.5</li>
        <li>300 messages per month for GPT 4</li>
        <li>Human text generator - 50 generated texts per month</li>
        <li>ALLIN math solver - 50 solved problems per month (comming soon)</li>
        <li>ALLIN translator - 100 translations per month (comming soon)</li>
        <li>Phone support</li>
        </ul>
        <?php
switch ($plan_status) {
  case 'basic':
      ?>
      <br>
      <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
      <?php
      break;
  case 'pro':
    ?>
    <br>
    <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
    <?php
      break;
  case 'premium':
    ?>
    <br>
    <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
    <?php
      break;
  default:
  ?>
  <button id="pro_checkout_button">Get Started</button>
  <?php
}
        ?>
       
        <script>
        document.getElementById('pro_checkout_button').addEventListener('click', () => {
            fetch('pro_checkout.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
      </div>
      <div class="pricing-card">
        <h2>Premium</h2>
        <?php
        if($email_addr == 'a.game.studios3@gmail.com' || $email_addr == 'petrovsvetoslav82@gmail.com' || $email_addr == 'Georgi.pasev@abax.bg' || $email_addr == 'mariqnedkova@abv.bg' || $email_addr == 'cvetelinagenova007@gmail.com' || $email_addr == 'yesnolikemy@gmail.com' || $email_addr == 'hazza3100@yahoo.com' || $email_addr == 'oscar1979@outlook.com' || $email_addr == 'ptopalova03@gmail.com' || $email_addr == 'aleksandarpetrov2008@abv.bg') {
        ?>
        <h3>7 days free</h3>
        <p style="margin-top: -10px">Then 17.90 EUR/month</p>
        <br>
        <?php }else{?>
          <h3>17.90 EUR/month</h3>
          <?php } ?>
        <ul>
        <li>Everything in the Pro plan</li>
        <li>Unlimited messages for GPT 4</li>
        <li>Human text generator - unlimited generated texts per month</li>
        <li>ALLIN math solver - unlimited solved problems per month (comming soon)</li>
        <li>ALLIN translator - unlimited translations per month (comming soon)</li>
        <li>Urgent phone support</li>
        </ul>

        <?php
switch ($plan_status) {
  case 'basic':
      ?>
      <br>
<a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
      <?php
      break;
  case 'pro':
    ?>
    <br>
    <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
    <?php
      break;
  case 'premium':
    ?>
    <br>
    <a href="user_payments.php" style="text-decoration: none;"><button style="background-color: grey; cursor: unset;">Please cancel your current plan to start a new one!</button></a>
    <?php
      break;
  default:
  ?>
 <button id="premium_checkout_button">Get Started</button>
  <?php
}
        ?>
       
        
        <script>
        document.getElementById('premium_checkout_button').addEventListener('click', () => {
            fetch('premium_checkout.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
      </div>

      <div class="pricing-card">
        <h2>Free (GPT 3.5)</h2>
        <h3>0 EUR</h3>
        <ul>
        <li>Just GPT 3.5 avivable</li>
          <li>50 messages per month for GPT 3.5</li>
          <li>No high demand. Always the fastest response.</li>
          <li>No technical support</li>
        </ul>
        
      </div>
    </div>
  </main>
  
  <script>
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');

    userIcon.addEventListener('click', () => {
      userDropdown.classList.toggle('show-dropdown');
    });
  </script>
</body>
</html>
