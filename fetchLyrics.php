<?php
$lyricsUrl = 'https://genius.com/Queen-bohemian-rhapsody-lyrics';  // Replace with the actual URL
$html = file_get_contents($lyricsUrl);



// Save the HTML content to lyrics.txt
// file_put_contents('lyrics.txt', $html);

$dom = new DOMDocument;
@$dom->loadHTML($html);  // Suppress warnings from invalid HTML
$xpath = new DOMXPath($dom);

// Find the lyrics container by class name (class may vary depending on the page)
$lyrics = $xpath->query("//div[contains(@class, 'Lyrics__Container')]");

if ($lyrics->length > 0) {
    print_r($lyrics->item(0));
    // echo $lyrics->item(0)->nodeValue;
} else {
    echo "Could not retrieve lyrics.";
}

