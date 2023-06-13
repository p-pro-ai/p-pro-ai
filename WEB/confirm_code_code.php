<?php
session_start();
require ('dbconn.php');
$email_addr = $_SESSION['user_email'];
$pers_name = $_SESSION['pers_name'];
$return_url = $_SESSION['return_url'];
$password_u8 = $_SESSION['user_password'];
$code = trim(stripslashes(htmlspecialchars($_POST['code'])));
$right_code = $_SESSION['random_code'];
if(isset($email_addr, $password_u8, $pers_name)){
    if(md5(md5($code)) == $right_code){
        $_SESSION['random_code'] = null;
        $sql = "INSERT INTO users_ai (email_addr, password_u8, pers_name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email_addr, $password_u8, $pers_name);
        $stmt->execute();
        $_SESSION['user_password'] = $password_u8;
        $_SESSION['user_email'] = $email_addr;
        $_SESSION['login_success'] = true;
        echo '<meta http-equiv="refresh" content="0;url='.$return_url.'" />';
    }else{
        $_SESSION['error'] = 'Предоставеният код е грешен!';
        echo '<meta http-equiv="refresh" content="0;url=confirm_code.php" />';
    }
}else{
    echo 'ERROR 404';
}
?>
