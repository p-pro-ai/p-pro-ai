<?php
session_start();
require ('dbconn.php');
$email_addr = $_SESSION['user_email'];
$user_password = $_SESSION['user_password'];
if($_SESSION['login_success'] || $_SERVER['REQUEST_URI'] == "/ai/register.php"){
    $sql = "SELECT email_addr, password_u8, pers_name, isPayed FROM users_ai WHERE email_addr=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_addr);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0 || $_SERVER['REQUEST_URI'] == "/ai/register.php") {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $password_db = $row['password_u8'];
        $isPayed = $row['isPayed'];
        if($password_db == $user_password || $_SERVER['REQUEST_URI'] == "/ai/register.php") {
            $pers_name = $row['pers_name'];
            if($_SERVER['REQUEST_URI'] == "/ai/register.php"){
                echo '<meta http-equiv="refresh" content="0;url=dashboard.php" />';
                die();
            }
        }else{
            $_SESSION['return_url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    ?>
    
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - P-PRO AI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        html, body {
            background-image: url(matrix-code_23.gif);
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            image-rendering: crisp-edges;
            image-rendering: auto;
        }
        .card{
            background-color: transparent;
        }
        .form-control{
            background-color: black;
            color: white;
        }
        label{
            color: white;
        }
        .form-control:focus{
background-color: black;
color: white;
        }
        .haveanaccount{
            text-shadow: 1px 1px 1px black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <img src="logo.png" alt="P-PRO AI" class="img-fluid mb-4">
                        <p style="color: red;"><?php if($_SESSION['error'] == ''){}else{echo $_SESSION['error']; $_SESSION['error'] = '';} ?></p>
                        <form id="login-form" method="post" action="login_code.php">
                            <div class="form-group">
                                <label for="username">Email:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <a href="forgotten.php" class="d-block mt-3 text-center">Forgot password?</a>
                            <a href="register.php" class="d-block mt-3 text-center">Don't have an account? Register.</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
<?php
die();
        }
      }
    }else{
        $_SESSION['return_url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    ?>
    
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - P-PRO AI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        html, body {
            background-image: url(matrix-code_23.gif);
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            image-rendering: crisp-edges;
            image-rendering: auto;
        }
        .card{
            background-color: transparent;
        }
        .form-control{
            background-color: black;
            color: white;
        }
        label{
            color: white;
        }
        .form-control:focus{
background-color: black;
color: white;
        }
        .haveanaccount{
            text-shadow: 1px 1px 1px black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <img src="logo.png" alt="P-PRO AI" class="img-fluid mb-4">
                        <p style="color: red;"><?php if($_SESSION['error'] == ''){}else{echo $_SESSION['error']; $_SESSION['error'] = '';} ?></p>
                        <form id="login-form" method="post" action="login_code.php">
                            <div class="form-group">
                                <label for="username">Email:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <a href="forgotten.php" class="d-block mt-3 text-center">Forgot password?</a>
                            <a href="register.php" class="d-block mt-3 text-center">Don't have an account? Register.</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
<?php
die();
    }
}else{
    $_SESSION['return_url'] = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    ?>
    
    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - P-PRO AI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        html, body {
            background-image: url(matrix-code_23.gif);
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            image-rendering: crisp-edges;
            image-rendering: auto;
        }
        .card{
            background-color: transparent;
        }
        .form-control{
            background-color: black;
            color: white;
        }
        label{
            color: white;
        }
        .form-control:focus{
background-color: black;
color: white;
        }
        .haveanaccount{
            text-shadow: 1px 1px 1px black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <img src="logo.png" alt="P-PRO AI" class="img-fluid mb-4">
                        <p style="color: red;"><?php if($_SESSION['error'] == ''){}else{echo $_SESSION['error']; $_SESSION['error'] = '';} ?></p>
                        <form id="login-form" method="post" action="login_code.php">
                            <div class="form-group">
                                <label for="username">Email:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <a href="forgotten.php" class="d-block mt-3 text-center">Forgot password?</a>
                            <a href="register.php" class="d-block mt-3 text-center">Don't have an account? Register.</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
<?php
die();
}