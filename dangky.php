<?php

// require_once "config.php";
  // $sql = "SELECT * FROM quanlytaichinh";
  // $result = mysqli_query($conn, $sql);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến MySQL thất bại: " . $conn->connect_error);
}

// Xử lý đăng ký
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Kiểm tra mật khẩu trùng khớp
    if ($password != $confirm_password) {
        echo "Mật khẩu không trùng khớp.";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Thêm thông tin người dùng vào cơ sở dữ liệu
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === true) {
            echo "Đăng ký thành công.";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
