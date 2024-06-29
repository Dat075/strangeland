<?php
if (isset($_GET['login']) && isset($_GET['domain']) && isset($_GET['id'])) {
    $login = $_GET['login'];
    $domain = $_GET['domain'];
    $id = $_GET['id'];
    $url = "https://www.1secmail.com/api/v1/?action=readMessage&login=$login&domain=$domain&id=$id";
    $response = file_get_contents($url);
    echo $response;
} else {
    echo json_encode([]);
}
?>
