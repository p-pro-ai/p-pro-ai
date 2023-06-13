<?php
session_start();
require ('autoexec.php');
require ('check_subscription.php');
date_default_timezone_set("Europe/Sofia");
$datetime = date("d.m.Y, H:i:s");

$period_start_strotime = strtotime($period_start);

// Извличане на съобщенията, изпратени от потребителя с модел 'gpt-4'
$sql = "SELECT datetime_1 FROM chatGPT WHERE user_email='" . $email_addr ."' AND model='translator'";
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
        if ($total_messages >= 0) {
            $return = array(
                'message' => 'I am sorry, you have reached your limit for the month. You can upgrade your plan, wait till the '.$next_billing.' or just use the ALLIN GPT 3.5 chat. Thank you! <br> Upgrare your plan here: <a href="pricing.php">https://p-pro.eu/ai/pricing.php/</a>',
                'time' => $datetime
            );
        
            echo json_encode($return);
            die();
        }
        break;
    case 'pro':
        if ($total_messages >= 50) {
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
$translate_to = mysqli_real_escape_string($conn, $_POST['translate_to']);


if (isset($input) && isset($translate_to)) {
  $api_key = "*********";
  $url = "https://api.openai.com/v1/chat/completions";


  $messages = array(
    array("role" => "system", "content" => 'You are a the most powerful and helpful AI based translator, designed by the P-PRO AI company. The texts, you generate are without any grammar mistakes at all.')
  );

  // Add the new user input message
  $messages[] = array("role" => "user", "content" => $input." 
  
  Преведи на ". $translate_to." език");

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
  VALUES ('$myip', '$datetime', '$input', '$message_to', 'translator', '$email_addr', 'translator')";
  $conn->query($sql);
  
  $return = array(
  'message' => $data['choices'][0]['message']['content'],
  'time' => $datetime
  );
  
  echo json_encode($return);
  }
  ?>