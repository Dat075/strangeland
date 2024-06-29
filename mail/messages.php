<?php
if (isset($_GET['login']) && isset($_GET['domain'])) {
    $login = $_GET['login'];
    $domain = $_GET['domain'];
    $url = "https://www.1secmail.com/api/v1/?action=getMessages&login=$login&domain=$domain";
    $response = file_get_contents($url);
    echo $response;
} else {
    echo json_encode([]);
}
?>
