<?php
session_start();
require ('autoexec.php');
require ('check_subscription.php');
date_default_timezone_set("Europe/Sofia");
$datetime = date("d.m.Y, H:i:s");

$period_start_strotime = strtotime($period_start);

// Извличане на съобщенията, изпратени от потребителя с модел 'gpt-4'
$sql = "SELECT datetime_1 FROM chatGPT WHERE user_email='" . $email_addr ."' AND model='gpt-4'";
$result = $conn->query($sql);

$total_messages = 0;
while ($row = $result->fetch_assoc()) {
    $message_time = strtotime($row['datetime_1']);

    // Проверка дали съобщението е изпратено след началото на текущия период
    if ($message_time >= $period_start_strotime) {
        $total_messages++;
    }
}



switch ($plan_status) {
    case 'basic':
        if ($total_messages >= 50) {
            $return = array(
                'message' => 'I am sorry, you have reached your limit for the month. You can upgrade your plan, wait till the '.$next_billing.' or just use the ALLIN GPT 3.5 chat. Thank you! <br> Upgrare your plan here: <a href="pricing.php">https://p-pro.eu/ai/pricing.php/</a>',
                'time' => $datetime
            );
        
            echo json_encode($return);
            die();
        }
        break;
    case 'pro':
        if ($total_messages >= 300) {
            $return = array(
                'message' => 'I am sorry, you have reached your limit for the month. You can upgrade your plan, wait till the '.$next_billing.' or just use the ALLIN GPT 3.5 chat. Thank you! <br> Upgrare your plan here: <a href="pricing.php">https://p-pro.eu/ai/pricing.php/</a>',
                'time' => $datetime
            );
        
            echo json_encode($return);
            die();
        }
        break;
    case 'premium':
        break;
    default:
    if ($total_messages >= 0) {
        $return = array(
            'message' => 'I am sorry, you have reached your limit for the month. You can upgrade your plan, wait till the '.$next_billing.' or just use the ALLIN GPT 3.5 chat. Thank you! <br> Upgrare your plan here: <a href="pricing.php">https://p-pro.eu/ai/pricing.php/</a>',
            'time' => $datetime
        );
    
        echo json_encode($return);
        die();
    }
}


$datetime = date("d.m.Y, H:i:s");
$myip = $_SERVER['HTTP_X_REAL_IP'];


$input = mysqli_real_escape_string($conn, $_POST['input']);
if (isset($input)) {
  $api_key = "*********";
  $url = "https://api.openai.com/v1/chat/completions";

  $random_secure = $_SESSION['random_secure'];

  $sql = "SELECT IP, datetime_1, message_to, answer_res FROM chatGPT WHERE session_id=" . $random_secure;
  $result = $conn->query($sql);

  $messages = array(
    array("role" => "system", "content" => 'You are ALLIN GPT 4 chat, a really powerful and helpful AI assistant, designed by the P-PRO AI company.')
  );
  $messages[] = array("role" => "assistant", "content" => 'Hello! I am ALLIN GPT 4 chat! How may I assist you today?');
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $umsg = $row['message_to'];
      $srsp = $row['answer_res'];

      $messages[] = array("role" => "user", "content" => $umsg);
      $messages[] = array("role" => "assistant", "content" => $srsp);
    }
  }

  // Add the new user input message
  $messages[] = array("role" => "user", "content" => $input);

  $data = array(
    "model" => "gpt-4",
    "messages" => $messages
  );

  $json_data = json_encode($data);

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $api_key
  ));
  curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
  
  // Execute cURL request and process response
  $response = curl_exec($curl);
  
  $data = json_decode($response, true);
  
  $message_to = mysqli_real_escape_string($conn, $data['choices'][0]['message']['content']);
  
  $sql = "INSERT INTO chatGPT (IP, datetime_1, message_to, answer_res, session_id, user_email, model)
  VALUES ('$myip', '$datetime', '$input', '$message_to', '$random_secure', '$email_addr', 'gpt-4')";
  $conn->query($sql);
  
  $return = array(
  'message' => nl2br(stripslashes(htmlspecialchars($data['choices'][0]['message']['content']))),
  'time' => $datetime
  );
  
  echo json_encode($return);
  }
  ?>