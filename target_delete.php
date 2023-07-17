<?php
include_once 'db_connect.php';
$id = $_GET['id'];
$sql = "Delete from goal where id = '$id'";
$result = mysqli_query($conn, $sql);
header("Location: target.php");

