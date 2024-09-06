<!DOCTYPE html>
<html lang="en">
<head>
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

        body, html {
            height: 100%;
            display: flex;
            flex-direction: column;
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
        .search-bar {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border-radius: 6px;
            display: flex;
            border: 5px solid grey;
            padding: 8px;
            align-items: center;
            justify-content: center;
            gap: 15px;
            background-color: white;
            width: 15%;
        }

        .card form{
            display: flex;
        }


        .text-box {
            font-size: 18px;
            border: none;
            width: 100%;
            border-radius: 5px;
            height: 30px;
            vertical-align: middle;
            font-family: "SUSE", sans-serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
        }

        .search-bar img{
            width: 10%;
        }

        textarea:focus, input:focus{
            outline: none;
        }
    </style>
</head>
<body>
    <div class="title">
        <h1>Artifo</h1>
    </div>
    <div class="search-bar">
        <div class="card">
            <form method="POST" action="FetchSongDetails.php">
                <input type="text" class="text-box" placeholder="Search Artist Info" name="sname">
                <input type="image" src="../magnifying-glass-solid.svg" alt="Search" style="width:10%">
             </form>
          </div>
    </div>
</body>
</html>

