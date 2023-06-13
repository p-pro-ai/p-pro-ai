<?php
session_start();
require ('autoexec.php');
require ('check_subscription.php');

if($_GET['twitterhasantoor_success']=='true'){
  $sql = "SELECT email_adds, subscription, topay FROM twitter_hassan_toor WHERE email_adds= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_addr);
        $stmt->execute();
        $result = $stmt->get_result();
            if($result->num_rows > 0) {
                
            }else{
              switch ($plan_status) {
                case 'basic':
                  $topay = '0.20';
                  $sql = "INSERT INTO twitter_hassan_toor (email_adds, subscription, topay) VALUES (?, ?, ?)";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("sss", $email_addr, $plan_status, $topay);
                  $stmt->execute();
                  break;

                  case 'pro':
                    $topay = '0.55';
                    $sql = "INSERT INTO twitter_hassan_toor (email_adds, subscription, topay) VALUES (?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $email_addr, $plan_status, $topay);
                    $stmt->execute();
                    break;

                    case 'pemium':
                      $topay = '1.25';
                      $sql = "INSERT INTO twitter_hassan_toor (email_adds, subscription, topay) VALUES (?, ?, ?)";
                      $stmt = $conn->prepare($sql);
                      $stmt->bind_param("sss", $email_addr, $plan_status, $topay);
                      $stmt->execute();
                      break;
                
                default:
                  # code...
                  break;
              }
             
            }
}
?>
<?php
function isAndroid() {
  $userAgent = $_SERVER['HTTP_USER_AGENT'];
  return strpos($userAgent, 'Android') !== false;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9172953106196372"
    crossorigin="anonymous"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <script src="https://kit.fontawesome.com/4874d26c0b.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

  </style>
</head>
<body>
  <?php
// Example usage
if (isAndroid()) {
?>
 <div class="alert alert-info alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1000; width: 300px">
    <strong>Recommendation:</strong> For the best user experience, we recommend you to install our application for Android! It is available in the Google Play Store!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <div class="mt-2">
      <a href="https://play.google.com/store/apps/details?id=eu.ppro" target="_blank" class="btn btn-sm"><img src="getgpl3.png" alt="Download from Google Play" style="border: 2px solid gray; border-radius: 5px; width: 200px;"></a>
    </div>
  </div>
<?php
}

?>
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
  <main>
    <div class="container">
      <div class="dashboard">
        <a href="chat_3.5.php" style="text-decoration: none;">
      <div class="card" id="chat_35">
        <i class="fas fa-comment"></i>
        <h3>ALLIN GPT 3.5 <?php if($isPayed=='false'){ ?>(FREE)<?php }?></h3>
        <p>Interact with the GPT-3.5 language model, a highly advanced language model that is capable of performing a wide range of tasks.</p>
      </div>
</a>

<a href="<?php if ($plan_status == 'free') { 
              echo 'pricing.php'; 
           } else { 
              echo 'chat_4.php'; 
           } ?>" style="text-decoration: none;">

      <div class="card" id="chat">
        <i class="fas fa-cogs"></i>
        <h3>ALLIN GPT 4</h3>
        <p>Interact with the powerful GPT-4 language model</p>
      </div>
        </a>
        <a href="<?php if ($plan_status == 'free' || $plan_status == 'basic') { 
              echo 'pricing.php'; 
           } else { 
              echo 'human_generator.php'; 
           } ?>" style="text-decoration: none;">
      <div class="card" id="text-gen">
        <i class="fas fa-code"></i>
        <h3>HUMAN TEXT GENERATOR</h3>
        <p>Generate human-like text that AI detectors can't recognize</p>
      </div>
        </a>
        <a href="<?php if ($plan_status == 'free') { 
              echo 'pricing.php'; 
           } else { 
              echo 'translator.php'; 
           } ?>" style="text-decoration: none;">
      <div class="card" id="translator">
        <i class="fas fa-lock"></i>
        <h3>ALLIN TRANSLATOR</h3>
        <p>Translate text and speech with AI-powered accuracy</p>
      </div>
          </a>
          <a href="<?php if ($plan_status == 'free') { 
              echo 'pricing.php'; 
           } else { 
              echo 'math.php'; 
           } ?>" style="text-decoration: none;">
       <div class="card" id="math-solver">
        <i class="fas fa-music"></i>
        <h3>MATH SOLVER</h3>
        <p>Solve math problems with step-by-step instructions</p>
      </div> 
      </а>
      </div>
    </div>
  </main>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

