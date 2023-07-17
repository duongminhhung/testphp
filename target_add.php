<?php 
session_start();
include_once 'db_connect.php';
$title = $_POST['title'];
$money = $_POST['money'];
$month = $_POST['month'];
$user_id =  $_SESSION['user']['id'];
$sql = "insert into goal (title,target,month,user_id) values('$title','$money','$month','$user_id')";
$result = mysqli_query($conn, $sql);
header("Location: target.php");
