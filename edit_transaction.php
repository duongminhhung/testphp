<?php
$id = $_POST['id'];
$type = $_POST['type'];
$amount = $_POST['amount'];
$time = $_POST['time'];
$description = $_POST['description'];

$timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
if ($time == null) {
    $currentDateTime = new DateTime('now', $timezone);
    $time = $currentDateTime->format('Y-m-d');
}
include_once 'db_connect.php';
$sql = "UPDATE transaction
SET category_id  = $type, price_transaction = '$amount', description = '$description', day = '$time' where id = $id";
$result = mysqli_query($conn, $sql);
header("Location: transaction.php");
