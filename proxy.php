<?php

$my_domain='http://localhost';

// Get the URL from the query parameter
if($_GET['proxy']=='true'){
    $url=$_GET['url'];
}
else{
    $url='https://election.somoynews.tv'.$_SERVER['REQUEST_URI'];
}


// Initialize a cURL session
$ch = curl_init();
$user_agent = 'Mozilla HotFox 1.0';
// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_NOBODY, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// Execute cURL session and get the content
$content = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    die('Error fetching the content: ' . curl_error($ch));
}

// Close cURL session
curl_close($ch);

// Set the appropriate content type based on the fetched content
if (strpos($url, '.jpg') !== false || strpos($url, '.jpeg') !== false) {
    header('Content-Type: image/jpeg');
} elseif (strpos($url, '.png') !== false) {
    header('Content-Type: image/png');
} elseif (strpos($url, '.js') !== false) {
    header('Content-Type: application/javascript');
    $content=str_replace('https://www.somoynews.tv',$my_domain.'/?proxy=true&url=https://www.somoynews.tv',$content);
    $content=str_replace('https://somoynews.tv',$my_domain.'/?proxy=true&url=https://somoynews.tv',$content);
    $content=str_replace('https://workers.somoynews.tv',$my_domain.'/?proxy=true&url=https://workers.somoynews.tv',$content);
    
} elseif (strpos($url, '.css') !== false) {
    header('Content-Type: text/css');
} else {
    header('Content-Type: text/html');
    $content=str_replace('https://www.somoynews.tv',$my_domain.'/?proxy=true&url=https://www.somoynews.tv',$content);
    $content=str_replace('https://somoynews.tv',$my_domain.'/?proxy=true&url=https://somoynews.tv',$content);
    $content=str_replace('https://workers.somoynews.tv',$my_domain.'/?proxy=true&url=https://workers.somoynews.tv',$content);
}

// Output the fetched content


echo $content;
?>