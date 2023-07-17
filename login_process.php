<?php
session_start();

require_once 'db_connect.php';

$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

$result = $conn->query($sql);
// die($result->num_rows > 0);
if ($result->num_rows > 0) {
    $row = $result->fetch_array(MYSQLI_NUM);
    $user = [
        'username' => $username,
        'email' => $row['2'],
        'id' => $row['4'],
    ];
    $_SESSION['user'] = $user;
    // $_SESSION['user'] = $user;

    // die($_SESSION['user']['username']);
    header("Location: index.php");
    // exit();
} else {
    // Đăng nhập thất bại, hiển thị thông báo lỗi
    echo "Đăng nhập không thành công. Vui lòng kiểm tra tên đăng nhập và mật khẩu.";
}
