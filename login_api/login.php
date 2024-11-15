<?php
header('Content-Type: application/json'); // Đặt Content-Type là JSON

$servername = getenv('MYSQL_HOST');
$username = getenv('MYSQL_USER');
$password = getenv('MYSQL_PASSWORD');
$dbname = getenv('MYSQL_DATABASE');


// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối cơ sở dữ liệu
if ($conn->connect_error) {
    echo json_encode(["status" => "fail", "message" => "Database connection failed"]);
    exit();
}

// Lấy dữ liệu JSON từ yêu cầu
$data = json_decode(file_get_contents("php://input"), true);

// Kiểm tra dữ liệu đầu vào
if (empty($data['email']) || empty($data['password'])) {
    echo json_encode(["status" => "fail", "message" => "Email and password are required"]);
    exit();
}

// Lấy email và password từ dữ liệu JSON
$email = $data['email'];
$password = $data['password'];

// Truy vấn kiểm tra thông tin đăng nhập bằng prepared statement để tránh SQL Injection
$sql = "SELECT * FROM users WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["status" => "success", "message" => "Login successful"]);
} else {
    echo json_encode(["status" => "fail", "message" => "Invalid email or password"]);
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
