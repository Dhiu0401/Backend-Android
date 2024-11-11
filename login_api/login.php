<?php
header('Content-Type: application/json');

// Sử dụng các biến môi trường từ Railway để kết nối đến MySQL
$servername = getenv('MYSQLHOST');       // Hoặc 'mysql.railway.internal' nếu bạn muốn ghi trực tiếp
$username = getenv('MYSQLUSER');         // root
$password = getenv('MYSQLPASSWORD');     // jRAXNLLTnyuajDFADdSfgsWBvdPSdghF
$dbname = getenv('MYSQLDATABASE');       // railway
$port = getenv('MYSQLPORT');             // 3306

// Kết nối đến cơ sở dữ liệu MySQL
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    echo json_encode(["status" => "fail", "message" => "Database connection failed: " . $conn->connect_error]);
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
