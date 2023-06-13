<?php
require ("dbconn.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents('php://input'), true);

$user_email = $data['email_addr'];

$sql = "SELECT DISTINCT session_id, title FROM chatGPT WHERE user_email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

$chats = [];
while($row = $result->fetch_assoc()) {
    $chats[] = $row;
}

echo json_encode($chats);