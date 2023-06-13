<?php
date_default_timezone_set("Europe/Sofia");
session_start();
require '../vendor/autoload.php';
require ('dbconn.php');
$data = json_decode(file_get_contents('php://input'), true);
$email_addr = $data['email_addr'];

\Stripe\Stripe::setApiKey('******');

$customer_email = $email_addr; // Replace with the customer's email

// Retrieve the customer by email
$customers = \Stripe\Customer::all([
    'email' => $customer_email,
    'limit' => 1,
]);

if (count($customers->data) > 0) {
    $customer = $customers->data[0];

    // Retrieve the subscriptions for the customer
    $subscriptions = \Stripe\Subscription::all([
        'customer' => $customer->id,
    ]);

    $active_or_trialing_subscriptions = array_filter($subscriptions->data, function ($subscription) {
        return $subscription->status === 'active' || $subscription->status === 'trialing';
    });

    if (count($active_or_trialing_subscriptions) > 0) {
        // Iterate over the active or trialing subscriptions
        foreach ($active_or_trialing_subscriptions as $subscription) {
            $period_start = date('d.m.Y', $subscription->current_period_start);
            $next_billing = date('d.m.Y', $subscription->current_period_end);
            switch ($subscription->items->data[0]->price->id) {
                case '****':
                    $plan_status = 'basic';
                    break;
                case '*****':
                    $plan_status = 'pro';
                    break;
                case '****':
                    $plan_status = 'premium';
                    break;
                default:
                    $plan_status = 'free';
            }
        }
    } else {
        $plan_status = 'free';
    }
} else {
    $plan_status = 'free';
}














date_default_timezone_set("Europe/Sofia");
$datetime = date("d.m.Y, H:i:s");

 $period_start_strotime = strtotime($period_start);
 // Извличане на съобщенията, изпратени от потребителя с модел 'gpt-4'
 $sql = "SELECT datetime_1 FROM chatGPT WHERE user_email='" . $email_addr ."' AND model='gpt-3.5-turbo'";
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
                'message' => 'I am sorry, you cannot use this feature with a basic subscription. You can upgrade your plan or just use the ALLIN GPT 3.5 chat. Thank you! 
    
Upgrare your plan here: https://p-pro.eu/ai/pricing.php/',
                'time' => $datetime,
                'needupgrade' => true
            );
        
            echo json_encode($return);
            die();
        }
        break;
    case 'pro':
        if ($total_messages >= 50) {
            $return = array(
                'message' => 'I am sorry, you have reached your limit for the month. You can upgrade your plan or wait till the '.$next_billing.'. Thank you! 
            
Upgrare your plan here: https://p-pro.eu/ai/pricing.php/',
                'time' => $datetime,
                'needupgrade' => true
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
            'message' => 'I am sorry, you cannot use this feature with a free subscription. You can upgrade your plan or just use the ALLIN GPT 3.5 chat. Thank you!

Upgrare your plan here: https://p-pro.eu/ai/pricing.php/',
            'time' => $datetime,
            'needupgrade' => true
        );
    
        echo json_encode($return);
        die();
    }
}


// $datetime = date("d.m.Y, H:i:s");

$myip = $_SERVER['HTTP_X_REAL_IP'];
$data = json_decode(file_get_contents('php://input'), true);

$input = $data['input'];
$type_cont = $data['type'];
$language = $data['language'];
$word_count = $data['word_count'];

if (isset($input)) {
  $api_key = "*********";
  $url = "https://api.openai.com/v1/chat/completions";

  $random_secure = $session_id;

  $messages = array(
    array("role" => "system", "content" => 'You are a the most powerful and helpful AI based human text generator, designed by the P-PRO AI company. The texts, you generate are undetectable by the AI detectors, they seem like a 100% human generated content.')
  );

  // Add the new user input message
  $messages[] = array("role" => "user", "content" => "Напиши ми ".$type_cont. "на " . $language ." език, на тема " . $input . "Приблизително ". $word_count ." думи.");
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
  VALUES ('$myip', '$datetime', '$input', '$message_to', 'human_text_generator', '$email_addr', 'hu-text-gen')";
  $conn->query($sql);
  
  $return = array(
  'message' => $data['choices'][0]['message']['content'],
  'time' => $datetime
  );
  
  echo json_encode($return);
  }
  ?>