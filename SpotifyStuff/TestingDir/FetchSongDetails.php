<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SUSE:wght@100..800&display=swap" rel="stylesheet">

    <title>Artifo</title>

    <style>
        .title h1 {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(to right, rgb(49, 48, 48), rgb(0, 255, 157), rgb(49, 48, 48));
            margin: 0px;
            height: 60px;
            color: black;
            border-radius: 5px;
        }

        body {
            background-color: black;
            color: white;
            font-family: "SUSE", sans-serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
        }

        .flex-container div {
            margin: 0.5%;
        }


        .album_cover img {
            width: 150px;
            border-radius: 10px;
            padding: 5px;
            border: 5px solid rgb(255, 255, 255);
        }

        .song-title img {
            width: 5%;
        }

        .lyrics {
            margin: 0.5%;
        }
    </style>

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

    // Replace the previous code with this section if you're adding to the prwevious script
    $song = $_POST['sname']; // Example song name
    // $song = 'Bye Bye Bye'; // Example song name
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
    // echo "Track Name: " . $track['name'] . "\n";
    // echo "Artist: " . $track['artists'][0]['name'] . "\n";
    // echo "Album: " . $track['album']['name'] . "\n";
    // echo "Release Date: " . $track['album']['release_date'] . "\n";
    // echo "Song URL: " . $track['external_urls']['spotify'] . "\n";
    // echo "Album Link: " . $track['album']['artists'][0]['external_urls']['spotify'] . "\n";
    // echo "Album Cover Photo: " . $track['album']['images'][0]['url'] . "\n";

    ?>
    
</head>

<body>
    <div class="title">
        <h1>
            Artifo
        </h1>
    </div>
    <br>
    <hr>
    <div class="flex-container">
        <div class="song-title">
            <h1>
                <!-- Feels Like we Only Go Backwards -->
                <?php echo "Track Name: " . $track['name'] . "\n"; ?>
            </h1>
            <h4>
                <?php echo "Artist: " . $track['artists'][0]['name'] . "\n"; ?>
            </h4>
            <h4>
                <?php echo "Album: " . $track['album']['name'] . "\n"; ?>
            </h4>
            <h4>
                <?php echo "Release Date: " . $track['album']['release_date'] . "\n"; ?>
            </h4>

            <div style="display: flex;">
                <img src="spotify-brands-solid.svg" alt="Description of the image">
                <a href="<?php echo htmlspecialchars($track['external_urls']['spotify'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration: none;color: white;">
                    &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Listen to Track on Spotify
                </a>
            </div>
        </div>
        <div class="album_cover">
        <img src="<?php echo htmlspecialchars($track['album']['images'][0]['url'], ENT_QUOTES, 'UTF-8'); ?>" alt="Album Image">
        </div>
    </div>
    <hr>
    <div class="lyrics">
        <h2>Lyrics</h2>
        <pre style="line-height: 1.5;">
        Someone said they left together
        I ran out the door to get her
        She was holding hands with Trevor
        Not the greatest feeling ever
        Said, "Pull yourself together
        You should try your luck with Heather"
        Then I heard they slept together
        Oh, the less I know the better
        The less I know the better
        Oh, my love, can't you see yourself by my side?
        No surprise when you're on his shoulder like every night
        Oh, my love, can't you see that you're on my mind?
        Don't suppose you could convince your lover to change his mind?
        So goodbye
        She said, "It's not now or never
        Wait ten years, we'll be together"
        I said, "Better late than never
        Just don't make me wait forever"
        Don't make me wait forever
        Don't make me wait forever
        Oh, my love, can't you see yourself by my side?
        I don't suppose you could convince your lover to change his mind?
        I was doin' fine without you
        'Til I saw your face, now I can't erase
        Givin' in to all his bullshit
        Is this what you want? is this who you are?
        I was doin' fine without you
        'Til I saw your eyes turn away from mine
        Oh, sweet darling, where he wants you
        Said, "Come on Superman, say your stupid line"
        Said, "Come on Superman, say your stupid line"
        Said, "Come on Superman, say your stupid line"
        </pre>
    </div>
</body>

</html>




