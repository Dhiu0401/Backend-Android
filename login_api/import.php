<?php
$servername = getenv('mysql.railway.internal');      
$username = getenv('root');        
$password = getenv('MYSQjRAXNLLTnyuajDFADdSfgsWBvdPSDgHfLPASSWORD');    // MYSQLPASSWORD được cung cấp bởi Railway
$dbname = getenv('railway');      
$port = getenv('3306');

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
