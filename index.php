<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$url = "https://election.somoynews.tv/map";
$user_agent = 'Mozilla HotFox 1.0';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_NOBODY, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$res = curl_exec($ch);
curl_close($ch);
$res=str_replace('src="/assets','src="https://election.somoynews.tv/assets',$res);
$res=str_replace('href="/assets','href="https://election.somoynews.tv/assets',$res);
echo $res;


?>