<?php
header('Content-Type: application/json'); // Đặt Content-Type là JSON
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "fail", "message" => "Database connection failed"]);
    exit();
}

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

$conn->close();
?>
