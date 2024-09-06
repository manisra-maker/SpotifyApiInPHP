<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SUSE:wght@100..800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <title>Artifo</title>

    <style>
        body {
            background-color: black;
            color: white;
            font-family: "SUSE", sans-serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
        }

        .title h1 {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(to right, rgb(49, 48, 48), rgb(0, 255, 157), rgb(49, 48, 48));
            margin: 0px;
            height: 60px;
            color: rgb(0, 0, 0);
            border-radius: 5px;
            font-family: "Pacifico", cursive;
            font-weight: 500;
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

        .song-title h1{
            margin: 0px;
        }

        .song-title img {
            width: 5%;
        }

        .spotify-links img{
            width: 6%;
            vertical-align: middle;
        }

        .link-container{
            display: inline-block;
            vertical-align: middle;
        }

        .link-container div{
            width: 100%;
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
    $accessToken = $data['access_token'];
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


   
    // Define the command with arguments
    $artistName = $track['artists'][0]['name'];
    $trackName = $track['name'];
    $escapedTrackName = escapeshellarg("$artistName - $trackName");
    // $command = 'FORMAT=text FILENAME="$track['artists'][0]['name'] - $track['name']" php /home/manish/LyricsCore/index.php';
    $command = "FORMAT=text FILENAME=$escapedTrackName php LyricscoreApi.php";

    // Execute the command and capture the output
    $outputForGenius = shell_exec($command);

    if(is_null($outputForGenius))
    {
        // Your Genius API token
        $api_token = 'NUACSnti7pwIluPqK2NwqKLorIAkmrvmEsx0jb8g9hr5ijoeLlk76ehLkYgXWXmw';


        // Encode the song name to use in the query
        $query = urlencode($trackName);

        // API URL with the search query
        $url = "https://api.genius.com/search?q=$query";

        // Set up the HTTP context with your API token
        $options = [
            "http" => [
                "header" => "Authorization: Bearer $api_token\r\n"
            ]
        ];

        $context = stream_context_create($options);

        // Make the API request
        $response = file_get_contents($url, false, $context);

        // Decode the JSON response
        $data = json_decode($response, true);

        // Check if there are any hits
        if (!empty($data['response']['hits'])) {
            // Get the first song's URL
            $song_url = $data['response']['hits'][0]['result']['url'];
            // echo '<pre><a href="' . $song_url . '" style="color: white; font-size: 18px;">Click Here to See Lyrics From Genius</a></pre>';
        } else {
            $song_url = "Lyrics Not Found !";
        }
    }
    else{
        // Display the output within a <pre> tag
        // echo "<pre>" . htmlspecialchars($output) . "</pre>";
        $song_url=$outputForGenius;
    }
    
    

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


            <div class="spotify-links" style="display: block;">
                <img src="spotify-brands-solid.svg" alt="Description of the image" style="vertical-align: middle;">
                <div class="link-container">
                    <div>
                        <a href="<?php echo htmlspecialchars($track['external_urls']['spotify'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration: none;color: white;" target="_blank">
                            &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Listen to Track on Spotify
                        </a>
                    </div>

                    <div>
                        <a href="<?php echo htmlspecialchars($track['album']['artists'][0]['external_urls']['spotify'], ENT_QUOTES, 'UTF-8'); ?>" style="text-decoration: none;color: white;" target="_blank">
                                &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;Listen to Album on Spotify
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="album_cover">
            <img src="<?php echo htmlspecialchars($track['album']['images'][0]['url'], ENT_QUOTES, 'UTF-8'); ?>" alt="Album Image">
        </div>
    </div>
    <hr>
    <div class="lyrics">
        <h2>Lyrics</h2>
       <pre style="line-height: 1.5em;"><?php echo $song_url ?></pre>
    </div>
</body>

</html>