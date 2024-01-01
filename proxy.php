<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$my_domain='https://map.classicsofttech.xyz';
$v=$_SERVER['REQUEST_URI'];
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}

// Get the URL from the query parameter
if(isset($_GET['proxy']) && isset($_GET['url'])){
    $url=$_GET['url'];
}
else{
    $url='https://election.somoynews.tv'.$v;
}


if($v=='/' || $v==''){
    header("Location: /map");
    exit(); 
}






$content=false;
if(isset($_GET['proxy']) && isset($_GET['url'])){
    $nv=$_GET['url'];
    $nv=str_replace('https://','',$nv);
    $nv=str_replace('http://','',$nv);
    $fileToCheck = 'files/'.$nv;
    // Define the base directory
    $baseDirectory = __DIR__ . '/';
    $local=false;
    // Get the full path to the file
    $fullPath = $baseDirectory . $fileToCheck;
}
else{
    $fileToCheck = 'files'.$v;
    // Define the base directory
    $baseDirectory = __DIR__ . '/';
    $local=false;
    // Get the full path to the file
    $fullPath = $baseDirectory . $fileToCheck;
}

$exist=false;
if (file_exists(str_replace('files/','static_files/',$fullPath))) {
    $fullPath=str_replace('files/','static_files/',$fullPath);
    $exist=true;
}
else if (file_exists($fullPath)) {
    $exist=true;
}




if (!$exist) {
    // Create the necessary directory structure
    $directory = explode('/',$fileToCheck);
    array_pop($directory);

    $new_d=$baseDirectory;
    foreach ($directory as $d){
        $new_d=$new_d.'/'.$d;
        if (!is_dir($new_d)) {
            mkdir($new_d, 0777, true);
        }
    }
    
    file_put_contents($fullPath, '');

    
} else {
    $content= file_get_contents($fullPath);
}


if(!$exist){
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
}
// Set the appropriate content type based on the fetched content

// Output the fetched content
if(!$exist){
    if (strpos($url, '.jpg') !== false || strpos($url, '.jpeg') !== false) {
        header('Content-Type: image/jpeg');
    } elseif (strpos($url, '.png') !== false) {
        header('Content-Type: image/png');
    } elseif (strpos($url, '.js') !== false) {
        header('Content-Type: application/javascript');
        if (str_contains($v, 'assets/app-') && str_contains($v, '.js')){
            $content= $content.file_get_contents('./js.php');
        }
        $content=str_replace('https://www.somoynews.tv',$my_domain.'/?proxy=true&url=https://www.somoynews.tv',$content);
        $content=str_replace('https://somoynews.tv',$my_domain.'/?proxy=true&url=https://somoynews.tv',$content);
        $content=str_replace('https://workers.somoynews.tv',$my_domain.'/?proxy=true&url=https://workers.somoynews.tv',$content);
        
    } elseif (strpos($url, '.css') !== false) {
        if (str_contains($v, 'assets/index-') && str_contains($v, '.css')){
            $content= $content.file_get_contents('./css.php');
        }
        header('Content-Type: text/css');
    } else {
        header('Content-Type: text/html');
        $content=str_replace('https://www.somoynews.tv',$my_domain.'/?proxy=true&url=https://www.somoynews.tv',$content);
        $content=str_replace('https://somoynews.tv',$my_domain.'/?proxy=true&url=https://somoynews.tv',$content);
        $content=str_replace('https://workers.somoynews.tv',$my_domain.'/?proxy=true&url=https://workers.somoynews.tv',$content);
        $html= file_get_contents('./html.php');
        $content=str_replace('</head> ',$html.'</head> ',$content);
        $content=str_replace('</head>',$html.'</head>',$content);
        $content= file_get_contents('./php.php').$content;
        
    }
}
else{
     if (strpos($url, '.jpg') !== false || strpos($url, '.jpeg') !== false) {
        header('Content-Type: image/jpeg');
    } elseif (strpos($url, '.png') !== false) {
        header('Content-Type: image/png');
    } elseif (strpos($url, '.js') !== false) {
        header('Content-Type: application/javascript');
    } elseif (strpos($url, '.css') !== false) {
        header('Content-Type: text/css');
    } else {
        header('Content-Type: text/html');
    }
}

if(!$exist){
    file_put_contents($fullPath, $content);
}


echo $content;



?>
