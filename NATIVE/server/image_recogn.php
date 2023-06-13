<?php

require ('../vendor/autoload.php');
use Google\Auth\ApplicationDefaultCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

// specify the path to your service account json file
putenv('*****');

// Load the credentials
$client = ApplicationDefaultCredentials::getCredentials();

// Now you can use $client to get the access token
$accessToken = '********';
//print_r ($client);

// Get the base64Image from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$base64Image = $data['image'] ?? '';
// Prepare the JSON request body
$requestBody = [
  'requests' => [
    [
      'image' => [
        'content' => $base64Image
      ],
      'features' => [
        [
          'type' => 'DOCUMENT_TEXT_DETECTION'
        ]
      ]
    ]
  ]
];

// Save the request body in a temporary file
$tempFile = tempnam(sys_get_temp_dir(), 'vision');
file_put_contents($tempFile, json_encode($requestBody));

// Get the access token and project ID
//$accessToken = 'ya29.a0AWY7Ckmt-PRmEGtJgHTvnhHbgdsFxJgD1O1PcAfoBxxJQUVpPLRUmUM0p4Ccq21srqtmd1phvan-y1ocQtCAoLH7HIUWZBHmzxwPsF0r9EtCrwDCOQpF3ZjpUhNzwPnbxRzcfTdM_Zr0FSVEs7GsaLNfakpQV7sC1wPAaCgYKASwSARISFQG1tDrpc2D-YKrrgvuV8E04Z59bMQ0171';
$projectId = '*****'; // Replace with your Google Cloud Project ID

// Prepare the cURL command
$cmd = "curl -X POST "
     . "-H 'Authorization: Bearer $accessToken' "
     . "-H 'x-goog-user-project: $projectId' "
     . "-H 'Content-Type: application/json; charset=utf-8' "
     . "-d @$tempFile "
     . "'https://vision.googleapis.com/v1/images:annotate?key=*******'";

// Execute the cURL command
$response = shell_exec($cmd);

// Delete the temporary file
unlink($tempFile);

// Parse the response
$data = json_decode($response, true);
$text = $data['responses'][0]['fullTextAnnotation']['text'] ?? '';

// Return the text in a JSON response
echo json_encode(['text' => $response]);
?>