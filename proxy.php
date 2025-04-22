<?php
// Ensure the URL parameter is set
if (isset($_GET['url'])) {
    $url = urldecode($_GET['url']);

    // Allow some basic validation of the URL format
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "Invalid URL.";
        exit;
    }

    // Set headers to prevent CORS errors
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: text/plain; charset=UTF-8');

    // Use cURL to fetch the content of the given URL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  // Allow redirection
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
    $response = curl_exec($ch);

    // Handle errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo $response;
    }

    // Close the cURL session
    curl_close($ch);
} else {
    echo "No URL provided.";
}
?>
