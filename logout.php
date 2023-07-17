<?php
session_start();

// Xóa thông tin đăng nhập từ session
session_unset();
session_destroy();

// Điều hướng đến trang đăng nhập
header('Location: login.php');
exit;
?>