<?php
// Đặt header JSON
header('Content-Type: application/json');

// Lấy thông tin kết nối từ biến môi trường
$servername = getenv('mysql.railway.internal');      // MYSQLHOST được cung cấp bởi Railway
$username = getenv('root');        // MYSQLUSER được cung cấp bởi Railway
$password = getenv('MYSQjRAXNLLTnyuajDFADdSfgsWBvdPSDgHfLPASSWORD');    // MYSQLPASSWORD được cung cấp bởi Railway
$dbname = getenv('railway');      // MYSQLDATABASE được cung cấp bởi Railway
$port = getenv('3306');            // MYSQLPORT được cung cấp bởi Railway

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    echo json_encode(["status" => "fail", "message" => "Database connection failed"]);
    exit();
}

// Nhận email và password từ yêu cầu POST
$email = $_POST['email'];
$password = $_POST['password'];

// Truy vấn kiểm tra thông tin đăng nhập
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Login successful"]);
} else {
    echo json_encode(["status" => "fail", "message" => "Invalid email or password"]);
}

// Đóng kết nối
$conn->close();
?>
