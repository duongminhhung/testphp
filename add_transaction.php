<?php
session_start();
require_once 'db_connect.php';
$type = $_POST['type'];
$amount = $_POST['amount'];
$time = $_POST['time'];
$description = $_POST['description'];
$id_user = $_SESSION['user']['id'];
$sql = "INSERT INTO transaction (price_transaction,day,description,user_id,category_id) VALUES ('$amount','$time','$description','$id_user','$type')";

$result = mysqli_query($conn, $sql);
header("Location: transaction.php");
