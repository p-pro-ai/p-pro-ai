<?php
session_start();
date_default_timezone_set("Europe/Sofia");
require ('dbconn.php');
$email_addr = trim(stripslashes(htmlspecialchars($_POST['username'])));
$password = trim(stripslashes(htmlspecialchars($_POST['password'])));
$return_url = $_SESSION['return_url'];
if(isset($email_addr, $password)){
    $sql = "SELECT email_addr, password_u8, pers_name FROM users_ai WHERE email_addr=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_addr);
    $stmt->execute();
    $result = $stmt->get_result();
    

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $password_db = $row['password_u8'];
        if(password_verify($password, $password_db)) { // Използване на password_verify вместо md5
            $_SESSION['user_password'] = $password_db;
            $_SESSION['user_email'] = $email_addr;
            $_SESSION['login_success'] = true;
            
            echo '<meta http-equiv="refresh" content="0;url='.$return_url.'" />';
        }else{
            $_SESSION['error'] = 'Грешна парола!';
            echo '<meta http-equiv="refresh" content="0;url='.$return_url.'" />';
        }
      }
    }else{
        $_SESSION['error'] = 'Не съществува такъв потребител! Моля създай си акаунт!';
        echo '<meta http-equiv="refresh" content="0;url='.$return_url.'" />';
    }
}else{
    echo 'ERROR 404';
    die();
}