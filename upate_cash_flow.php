<?php
$id = $_GET['id'];
$type = $_GET['type'];
$amount = $_GET['amount'];
$description = $_GET['description'];
$time = $_GET['time'];
include_once 'header.php';
$sql = "UPDATE revenue_expenditure
SET type = $type, amount = '$amount', description = '$description', time = '$time' where id = $id";
$result = mysqli_query($conn, $sql);
header("Location: cash-flow.php");
