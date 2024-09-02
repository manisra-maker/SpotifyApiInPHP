<?php

// Replace the previous code with this section if you're adding to the previous script
$song = 'The Less I Know The Better'; // Example song name
$accessToken='BQD1Uye6oUb_cXrI8-wf3RfWOzxMrWFt19OVzlhWimHQ5pnpNhki6Pju-qAePQXmkQpWPMf6sIpnSXYe57EoW7scI1puB-W_gjwWrg60Nju-Wp5rg3w';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.spotify.com/v1/search?q=' . urlencode($song) . '&type=track&limit=1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $accessToken
]);

$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
print_r($data);
$track = $data['tracks']['items'][0];

// Display song details
echo "Track Name: " . $track['name'] . "\n";
echo "Artist: " . $track['artists'][0]['name'] . "\n";
echo "Album: " . $track['album']['name'] . "\n";
echo "Release Date: " . $track['album']['release_date'] . "\n";
echo "Preview URL: " . $track['artists'][0]['href'] . "\n";


