<?php
session_start();
include_once 'db_connect.php';

if (!empty($_POST['add'])) {
    $title = $_POST['title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user']['id'];
    $sql = "INSERT INTO emi (title,start_date,end_date,price,user_id) VALUES ('$title','$start_date','$end_date','$price','$user_id')";
    $result = mysqli_query($conn, $sql);
    header("Location: EMI.php");
}

if (!empty($_POST['btn_del'])) {
    if (isset($_POST['id'])) {
        // Lấy ID từ biểu mẫu
        $itemId = $_POST['id'];
        // Câu lệnh SQL để xóa mục
        $sql = "DELETE FROM emi WHERE id = $itemId";

        // Thực thi câu lệnh SQL
        if ($conn->query($sql) === true) {
            echo "Mục đã được xóa thành công";
        } else {
            echo "Lỗi trong quá trình xóa mục: " . $conn->error;
        }
    }
    header("Location: EMI.php");

}
if (isset($_POST['btn_edit'])) {
    $itemId = $_POST['id']; // ID của mục cần cập nhật
    // Chuyển hướng đến URL mới với ID của mục
    header("Location: edit_EMI.php?id=" . $itemId);
    exit; // Dừng việc thực thi mã sau khi chuyển hướng
}
if (isset($_POST['update'])) {
    $itemId = $_POST['idItem'];
    $title = $_POST['title'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user']['id'];
    $sql = "UPDATE emi SET title = '$title',start_date='$start_date',end_date='$end_date',price='$price', user_id='$user_id'  WHERE id = $itemId";
    // Thực thi câu lệnh SQL
    if ($conn->query($sql) === true) {
        header("Location: EMI.php");
    } else {
        echo "Lỗi trong quá trình cập nhật dữ liệu: " . $conn->error;
    }
}
