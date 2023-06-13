<?php
require '../vendor/autoload.php';  // Require autoload file if you're using Composer
use Firebase\JWT\JWT;  // Use the JWT namespace

header('Content-Type: application/json');  // Define header to set content type as JSON
header('Access-Control-Allow-Origin: *');  // To allow Cross-Origin Resource Sharing (CORS) with your React Native App
header("Access-Control-Allow-Methods: POST");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    date_default_timezone_set("Europe/Sofia");
    require ('dbconn.php');
    $data = json_decode(file_get_contents('php://input'), true);
    $email_addr = trim(stripslashes(htmlspecialchars($data['username'])));
    $password = trim(stripslashes(htmlspecialchars($data['password'])));
    $key = "%dt#39Kg!QgBOJYnLMT!GTo^OrHtwdYrhc1y4Ng97pGQkMaLq";  // Secret key, replace with your actual secret key

    if(isset($email_addr, $password)){
        $sql = "SELECT email_addr, password_u8, pers_name FROM users_ai WHERE email_addr=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email_addr);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $password_db = $row['password_u8'];
                $pers_name = $row['pers_name'];  // Assuming you have a name field in your database
                if(password_verify($password, $password_db)) {
                    $payload = array(
                        "email" => $email_addr,
                        "name" => $pers_name,
                        "password" => $password_db,
                        "iat" => time(),
                        "exp" => time() + 157784630
                    );

                    $jwt = JWT::encode($payload, $key, 'HS256');

                    echo json_encode(['success' => true, 'token' => $jwt]);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Your username or password is incorrect']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Your username or password is incorrect']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ERROR 404']);
    }
}else{
    echo 'You do not have permission to access this page.';
}
?>
