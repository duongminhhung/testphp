<?php
include_once 'db_connect.php';
$id = $_GET['id'];
$title = $_GET['title'];
$money = $_GET['money'];
$month = $_GET['month'];
$sql = "UPDATE goal
SET title = '$title', target = '$money', month = '$month'
where id = '$id'";
$result = mysqli_query($conn, $sql);
header("Location: target.php");
