<?php
session_start();
require ('autoexec.php');
date_default_timezone_set("Europe/Sofia");
if($_GET==null){
    header("Location: chat_3.5.php?session_id=".mt_rand(1000000000000, 9999999999999));
    exit();
}
$random_secure = $_GET['session_id'];
$_SESSION['random_secure'] = $random_secure;
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>P-PRO AI | ALLIN GPT 3.5</title>
	
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}
		
		body {
			font-family: Arial, sans-serif;
			background-color: #000;
		}
		
		.container {
			width: 80%;
			margin: 50px auto;
			padding: 20px;
			background-color: #8d21a3;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			border-radius: 10px;
			display: flex;
			flex-direction: column;
			height: 500px;
			overflow-y: scroll;
			scroll-behavior: smooth;
		}
		
		.chat {
			margin-bottom: 20px;
			display: flex;
			flex-direction: row;
			align-items: center;
		}
		
		.avatar {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			background-color: #ddd;
			margin-right: 10px;
		}
		
		.message {
			padding: 10px;
			border-radius: 0 10px 10px 10px;
			background-color: #f7e39e;
			color: #000;
			max-width: 70%;
			word-wrap: break-word;
		}
		
		.time {
			margin-left: 10px;
			font-size: 12px;
			color: #f7e39e;
		}
		
		.input-container {
			display: flex;
			flex-direction: row;
			margin-top: -30px;
			width: 80%;
			transform: translate(-50%);
			margin-left: 50vw;
		}
		
		.input {
			flex: 1;
			padding: 10px;
			border-radius: 5px;
			border: none;
			font-size: 16px;
			background-color: #eee;
			resize: none;
			width: 650px;
		}
		
		.button {
			padding: 10px;
			border-radius: 5px;
			border: none;
			background-color: #f7e39e;
			color: #000;
			font-size: 16px;
			margin-left: 10px;
			cursor: pointer;
		}
		
		.button:hover {
			background-color: #a32121;
			color: #fff;
		}
		
		::-webkit-scrollbar {
			width: 5px;
		}
		 
		::-webkit-scrollbar-thumb {
			background-color: #8d21a3;
			border-radius: 5px;
		}
		
		::-webkit-scrollbar-track {
			background-color: #ddd;
			border-radius: 5px;
		}
		.usermsg{
			justify-content: flex-end;
		}
		.usermsg .message{
			background-color: #cfb143;
			border-radius: 10px 0 10px 10px;
		}
		.dot {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: #8d21a3;
    margin: 0 2px;
    animation: fadeInOut 1.2s infinite;
}

.dot:nth-child(2) {
    animation-delay: 0.2s;
}

.dot:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes fadeInOut {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}
.time.exp{
    text-align: right;
    color: #444444;
    margin-top: 10px;
}
.button-new-chat {
  background-color: #8d21a3;
  color: #fff;
  font-size: 16px;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.2s ease;
  transform: translate(-50%);
  margin-left: 50vw;
  margin-top: 20px;
}

.button-new-chat:hover {
  background-color: #a32121;
}

.button-new-chat svg {
  width: 20px;
  height: 20px;
  fill: #fff;
  margin-right: 5px;
}
.back-to-dashboard {
    display: inline-flex;
    align-items: center;
    background-color: #a32121;
    color: #ffffff;
    text-decoration: none;
    padding: 12px 20px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.arrow {
    margin-right: 8px;
}

.back-to-dashboard:hover {
    background-color:#a32121bf;
}

	</style>
</head>
<body>
<a href="dashboard.php" class="back-to-dashboard">
        <span class="arrow">&#8592;</span> Back to Dashboard
    </a>
<div class="container" id="chat-container">
<div class="chat">
<div class="message"><div class="msg_itself">Hello! I am ALLIN GPT 3.5 chat! How may I assist you today?</div><div class="time exp"><?php echo date('d.m.Y, H:i:s');?></div></div></div>
<?php

$sql = "SELECT IP, datetime_1, message_to, answer_res FROM chatGPT WHERE session_id=" . $random_secure;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
<div class="chat usermsg"><div class="message"><div class="msg_itself"><?php echo $row['message_to']; ?></div><div class="time exp"><?php echo $row['datetime_1']; ?></div></div></div>
<div class="chat"><div class="message"><div class="msg_itself"><?php echo $row['answer_res']; ?></div><div class="time exp"><?php echo $row['datetime_1']; ?></div></div></div>

<?php
    }
}

?>
<script>
	function displayFakeMessage() {
    // Create the fake message element with loading dots
    var chatContainer = document.getElementById("chat-container");
    var fakeMessageElement = document.createElement("div");
    fakeMessageElement.classList.add("chat");
    fakeMessageElement.innerHTML = '<div class="message"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>';
    fakeMessageElement.id = "fake-message";
    chatContainer.appendChild(fakeMessageElement);
    chatContainer.scrollTop = chatContainer.scrollHeight;
}


   function sendMessage() {

	const currentDate = new Date();

const day = currentDate.getDate().toString().padStart(2, '0');
const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
const year = currentDate.getFullYear().toString();

const hours = currentDate.getHours().toString().padStart(2, '0');
const minutes = currentDate.getMinutes().toString().padStart(2, '0');
const seconds = currentDate.getSeconds().toString().padStart(2, '0');

const formattedDate = `${day}.${month}.${year}, ${hours}:${minutes}:${seconds}`;


    // Get the input message from the textarea
    var inputMessage = document.getElementById("input-message").value;

    // Create and display the sent message element
    var chatContainer = document.getElementById("chat-container");
    var sentMessageElement = document.createElement("div");
    sentMessageElement.classList.add("chat");
	sentMessageElement.classList.add("usermsg");
    sentMessageElement.innerHTML = '<div class="message"><div class="msg_itself">' + inputMessage + '</div><div class="time exp">' + formattedDate + '</div></div>';
    chatContainer.appendChild(sentMessageElement);
    chatContainer.scrollTop = chatContainer.scrollHeight;

    // Clear the input textarea
    document.getElementById("input-message").value = "";

    // Create a new XMLHttpRequest object
    var xhttp = new XMLHttpRequest();

    // Define the function to handle the response from the server
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
			var fakeMessage = document.getElementById("fake-message");
        fakeMessage.parentNode.removeChild(fakeMessage);
            // Parse the response as JSON
            var response = JSON.parse(this.responseText);

            // Create a new chat element with the response message
            var chatElement = document.createElement("div");
            chatElement.classList.add("chat");
            chatElement.innerHTML = '<div class="message"><div class="msg_itself">' + response.message + '</div><div class="time exp">' + response.time + '</div></div>';

            // Append the new chat element to the chat container and scroll to the bottom
            chatContainer.appendChild(chatElement);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    };

    // Set the AJAX request parameters and send the request
    xhttp.open("POST", "gpt_be.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("input=" + inputMessage);
	displayFakeMessage();
}

</script>
</div>
<div class="input-container">
    <textarea class="input" placeholder="Type your message here..." id="input-message"></textarea>
    <button class="button" onclick="sendMessage()">Send</button>
    <br>
</div>
<button class="button-new-chat" onclick="location.replace('chat_3.5.php');">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
        <path d="M290.7 57.4L57.4 290.7c-25 25-25 65.5 0 90.5l80 80c12 12 28.3 18.7 45.3 18.7H288h9.4H512c17.7 0 32-14.3 32-32s-14.3-32-32-32H387.9L518.6 285.3c25-25 25-65.5 0-90.5L381.3 57.4c-25-25-65.5-25-90.5 0zM297.4 416H288l-105.4 0-80-80L227.3 211.3 364.7 348.7 297.4 416z"/>
    </svg>
 Clear conversion
</button>


    
</body>
</html>