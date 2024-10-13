<?php
$url = 'https://www.1secmail.com/api/v1/?action=getDomainList';
$response = file_get_contents($url);
echo $response;
?>
