<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];

    // Khởi tạo cURL session
    $curl = curl_init();

    // Thiết lập các tùy chọn cho cURL
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://traodoisub.com/api/?fields=profile&access_token=' . urlencode($token),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    // Gửi yêu cầu và nhận phản hồi từ server
    $response = curl_exec($curl);

    // Đóng session cURL
    curl_close($curl);

    // Kiểm tra và hiển thị phản hồi từ server
    if ($response) {
        echo $response;
    } else {
        echo json_encode(array(
            'success' => 500,
            'message' => 'Failed to fetch user data.'
        ));
    }
} else {
    echo json_encode(array(
        'success' => 400,
        'message' => 'Invalid request.'
    ));
}
?>
