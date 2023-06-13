<?php
session_start();
require('auth.php');
if($_SESSION['return_url'] == ''){
    $_SESSION['return_url'] = 'https://'.$_SERVER['HTTP_HOST'].'/ai/dashboard.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - P-PRO AI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        html, body {
            background-image: url(matrix-code_23.gif);
            background-size: 100%;
            background-attachment: fixed;
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
                        <form id="login-form" method="post" action="register_code.php">
                        <div class="form-group">
                                <label for="fullname">Full name:</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" minlength='2' required value="<?php  echo trim(stripslashes(htmlspecialchars($_GET['persname'])));?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Email:</label>
                                <input type="email" class="form-control" id="username" name="username" required value="<?php  echo trim(stripslashes(htmlspecialchars($_GET['email_addr'])));?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" minlength='8' required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" style="background-color: #22b4b7;">Next</button>
                            <a href="login.php" class="d-block mt-3 text-center haveanaccount">Already have an account? Sign in.</a>
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