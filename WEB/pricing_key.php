<?php
require '../vendor/autoload.php';  // Require autoload file if you're using Composer
use Firebase\JWT\JWT;  // Use the JWT namespace
use Firebase\JWT\Key;

    session_start();
    date_default_timezone_set("Europe/Sofia");
    require ('dbconn.php');
    $data = json_decode(file_get_contents('php://input'), true);
    $jwt = trim(stripslashes(htmlspecialchars($_GET['key'])));
    $key = "%dt#39Kg!QgBOJYnLMT!GTo^OrHtwdYrhc1y4Ng97pGQkMaLq";  // Secret key, replace with your actual secret key

    if (isset($jwt)) {
        try {
            $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
            $decoded_array = (array) $decoded;
            $password = $decoded_array['password'];
            $email_addr = $decoded_array['email'];

            $sql = "SELECT email_addr, password_u8, pers_name FROM users_ai WHERE email_addr=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_addr);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $password_db = $row['password_u8'];
                if($password_db === $password) {
                    $_SESSION['user_password'] = $password_db;
                    $_SESSION['user_email'] = $email_addr;
                    $_SESSION['login_success'] = true;
                    $_SESSION['application_user'] = true;
                    header('Location: pricing.php');
                    exit();
                }else{
                    echo json_encode(['success' => false, 'error' => 'Username or password changed.']);
                
                }
            }
        }else{
            echo json_encode(['success' => false, 'error' => 'Username or password changed.']);
    
        }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid request data']);
    }

?>


?>