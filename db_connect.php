<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "baiphp";
// $gate = '3325';
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
