<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TDS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .data-container {
            margin-top: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>TDS CHECKER</h1>
        <div class="form-group">
            <label for="token">Nhập Token:</label>
            <input type="text" id="token" name="token" required>
            <button onclick="fetchUserData()">Xem Thông Tin</button>
        </div>
        <div class="data-container" id="data-container">
            <!-- Dữ liệu từ API sẽ được hiển thị ở đây -->
        </div>
    </div>

    <script>
        function fetchUserData() {
            const token = document.getElementById('token').value;
            const dataContainer = document.getElementById('data-container');

            // Kiểm tra nếu không có token thì không gửi yêu cầu
            if (!token) {
                dataContainer.innerHTML = '<p>Vui lòng nhập token để xem thông tin.</p>';
                return;
            }

            // Gửi yêu cầu API sử dụng token
            fetch(`fetch_userdata.php?token=${encodeURIComponent(token)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success === 200 && data.data) {
                        const userData = data.data;
                        dataContainer.innerHTML = `
                            <p><strong>User:</strong> ${userData.user}</p>
                            <p><strong>Xu:</strong> ${userData.xu}</p>
                        `;
                    } else {
                        dataContainer.innerHTML = '<p>Không thể lấy thông tin người dùng.</p>';
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    dataContainer.innerHTML = '<p>Có lỗi xảy ra trong quá trình lấy dữ liệu.</p>';
                });
        }
    </script>
</body>
</html>
