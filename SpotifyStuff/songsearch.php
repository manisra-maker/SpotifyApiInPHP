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
    //echo 'Curl error: ' . curl_error($ch);
}

curl_close($ch);

$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    //echo 'JSON decode error: ' . json_last_error_msg();
}

if (isset($data['access_token'])) {
    //echo "Access Token: " . $data['access_token'] . "\n";
} else {
    //echo "Failed to retrieve access token.\n";
}

// Replace the previous code with this section if you're adding to the previous script
//$song = $_POST['sname']; // Example song name
$song = 'Bye Bye Bye'; // Example song name
$accessToken=$data['access_token'];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q=' . urlencode($song) . '&type=track&limit=1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $accessToken
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

// $filedata = print_r($data, true);
// file_put_contents('file1.txt',$filedata, FILE_APPEND);

$track = $data['tracks']['items'][0];

// Display song details
echo "Track Name: " . $track['name'] . "\n";
echo "Artist: " . $track['artists'][0]['name'] . "\n";
echo "Album: " . $track['album']['name'] . "\n";
echo "Release Date: " . $track['album']['release_date'] . "\n";
echo "Song URL: " . $track['external_urls']['spotify'] . "\n";
echo "Album Link: " . $track['album']['artists'][0]['external_urls']['spotify'] . "\n";
echo "Album Cover Photo: " . $track['album']['images'][0]['url'] . "\n";


