<?php

$clientId = '15aa35c513194502a1530017ce59cf65';
$clientSecret = '4ebfd4ffb8454404add5dee6bbdbe3d9';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'grant_type' => 'client_credentials'
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Basic ' . base64_encode($clientId . ':' . $clientSecret),
    'Content-Type: application/x-www-form-urlencoded'
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

curl_close($ch);

$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo 'JSON decode error: ' . json_last_error_msg();
}

if (isset($data['access_token'])) {
    echo "Access Token: " . $data['access_token'] . "\n";
} else {
    echo "Failed to retrieve access token.\n";
}


