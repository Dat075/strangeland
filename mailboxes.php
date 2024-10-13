<?php
$url = 'https://www.1secmail.com/api/v1/?action=genRandomMailbox&count=10';
$response = file_get_contents($url);
echo $response;
?>
