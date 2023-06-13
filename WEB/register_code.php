<?php
session_start();
require ('dbconn.php');
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$mail = new PHPMailer(true);
$email_addr = trim(stripslashes(htmlspecialchars($_POST['username'])));
$password = trim(stripslashes(htmlspecialchars($_POST['password'])));
$pers_name = trim(stripslashes(htmlspecialchars($_POST['fullname'])));
$return_url = $_SESSION['return_url'];
$password_u8 = password_hash($password, PASSWORD_DEFAULT);
if(isset($email_addr, $password, $pers_name)){
    $sql = "SELECT email_addr FROM users_ai WHERE email_addr=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_addr);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Вече съществува акаунт с този имейл адрес!';
        echo '<meta http-equiv="refresh" content="0;url=register.php?persname='.urlencode($pers_name).'&email_addr='.urlencode($email_addr).'" />';
    }else{
        $code = mt_rand(100000000,999999999);
        $_SESSION['random_code'] = md5(md5($code));
        $_SESSION['user_password'] = $password_u8;
        $_SESSION['user_email'] = $email_addr;
        $_SESSION['pers_name'] = $pers_name;
        $to = $email_addr;
        $subject = 'Код за потвърждение - p-pro.eu';
$txt = '
<!DOCTYPE html>
<html lang="bg">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Код за потвърждение - p-pro.eu</title>
<style>
body {
font-family: Arial, sans-serif;
background-color: #f7f7f7;
margin: 0;
padding: 0;
}
.email-container {
max-width: 600px;
margin: 0 auto;
padding: 20px;
background-color: #ffffff;
border-radius: 5px;
box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}
.email-header {
text-align: center;
padding: 20px 0;
}
.email-content {
text-align: center;
padding: 20px 0;
}
.email-footer {
text-align: center;
padding: 20px 0;
}
h1 {
font-size: 24px;
margin-bottom: 20px;
}
h2 {
font-size: 18px;
color: #ff5e3a;
margin-bottom: 10px;
}
a {
color: #ff5e3a;
text-decoration: none;
}
p {
font-size: 16px;
line-height: 1.5;
color: #333333;
}
</style>
</head>
<body>
<div class="email-container">
<div class="email-header">
<h1>Добре дошли в p-pro.eu!</h1>
</div>
<div class="email-content">
<p>Здравейте, на една стъпка от завършването на регистрацията си в <a href="https://p-pro.eu/">https://p-pro.eu/</a> сте! Кодът за потвърждение на Вашия имейл адрес е:</p>
<h2><b>'.$code.'</b></h2>
</div>
<div class="email-footer">
<p>Благодарим Ви, че се регистрирахте!</p>
</div>
</div>
</body>
</html>
';


//Server settings
$mail->SMTPDebug = 0;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'no-reply@p-pro.eu';                     //SMTP username
$mail->Password   = 'Vladi310398#$';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('no-reply@p-pro.eu', 'P-PRO AI');
$mail->addAddress($to);     //Add a recipient

$mail->addReplyTo('support@p-pro.eu', 'P-PRO AI SUPPORT');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

//Attachments
//$mail->addAttachment('/home/eu_p_pro/p-pro.eu/hoho.pdf');         //Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//Content
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body    = $txt;
// Set the message charset to UTF-8
$mail->CharSet = 'UTF-8';


$mail->send();
        echo '<meta http-equiv="refresh" content="0;url=confirm_code.php" />';
      }
    }else{
        echo 'ERROR 404';
        die();
    }
?>
