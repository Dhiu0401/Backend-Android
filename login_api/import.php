<?php
$servername = getenv('MYSQLHOST');
$username = getenv('MYSQLUSER');
$password = getenv('MYSQLPASSWORD');
$dbname = getenv('MYSQLDATABASE');
$port = getenv('MYSQLPORT');

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Đọc nội dung file SQL
$sql = file_get_contents('logindemo.sql');

// Thực thi file SQL
if ($conn->multi_query($sql)) {
    echo "Database imported successfully!";
} else {
    echo "Error importing database: " . $conn->error;
}

$conn->close();
?>
