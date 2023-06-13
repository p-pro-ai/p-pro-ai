<?php

require ('autoexec.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings</title>
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

    .settings {
      background-color: #333333;
      border-radius: 5px;
      padding: 20px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      margin-bottom: 20px;
    }

    .settings h2 {
      font-size: 2em;
      color: #9c27b0;
      margin-bottom: 15px;
    }

    .settings form {
      width: 100%;
    }

    .settings form label {
      font-size: 1.2em;
      display: block;
      margin-bottom: 5px;
    }

    .settings form input {
      width: 100%;
      padding: 8px;
      font-size: 1em;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 15px;
    }

    .settings form button {
      background-color: #9c27b0;
      color: #FFFFFF;
      padding: 10px 20px;
      font-size: 1.2em;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-right: 10px;
    }

    .settings form button:hover {
      background-color: #8527a8;
    }

    .sign-out {
      background-color: #e91e63;
      color: #FFFFFF;
      padding: 10px 20px;
      font-size: 1.2em;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .sign-out:hover {
      background-color: #d41752;
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
    <div class="settings">
      <h2>Account Settings</h2>
      <form>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $pers_name; ?>" readonly>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $email_addr; ?>" readonly>

        <label for="password">New Password</label>
        <input type="password" id="password" name="password" placeholder="Enter new password">

        <label for="confirm-password">Confirm New Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm new password">

        <button type="submit">Save Changes</button>
        <button type="button" class="sign-out">Sign Out</button>
      </form>
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
    const userIcon = document.getElementById('userIcon');
    const userDropdown = document.getElementById('userDropdown');

    userIcon.addEventListener('click', () => {
      userDropdown.classList.toggle('show-dropdown');
    });
  </script>

<script>
    const form = document.querySelector('form');
    const successMessage = document.createElement('div');
    successMessage.style.display = 'none';
    successMessage.style.backgroundColor = '#4CAF50';
    successMessage.style.color = '#FFFFFF';
    successMessage.style.padding = '10px';
    successMessage.style.borderRadius = '5px';
    successMessage.style.marginTop = '15px';
    successMessage.textContent = 'Password changed successfully';
  
    form.appendChild(successMessage);
  
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
  
      const formData = new FormData(form);
      const response = await fetch('change_password.php', {
        method: 'POST',
        body: formData
      });
  
      const result = await response.json();
  
      if (result.success) {
        successMessage.style.display = 'block';
        setTimeout(() => {
          successMessage.style.display = 'none';
        }, 5000);
      } else {
        // TODO: Handle the error case, such as showing an error message.
      }
    });
  </script>
</body>
</html>