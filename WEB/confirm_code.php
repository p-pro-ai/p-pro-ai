<?php
session_start();
$email_addr = $_SESSION['user_email'];
$pers_name = $_SESSION['pers_name'];
$password_u8 = $_SESSION['user_password'];
if(!isset($email_addr, $password_u8, $pers_name)){
    echo "ERROR 404";
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm email - P-PRO AI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <img src="logo.png" alt="P-PRO AI" class="img-fluid mb-4">
                        <center><p><b>We need to confirm you email to proceed.</b> Please check your inbox or spam folder.</p></center>
                        <p style="color: red;"><?php if($_SESSION['error'] == ''){}else{echo $_SESSION['error']; $_SESSION['error'] = '';} ?></p>
                        <form id="login-form" method="post" action="confirm_code_code.php">
                        <div class="form-group">
                                <label for="code">Code from email:</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Confirm your email adress</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>