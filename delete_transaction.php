<?php
$id = $_GET['id'];
include_once 'db_connect.php';
$sql = "DELETE FROM transaction WHERE id = $id";
$result = mysqli_query($conn, $sql);

header("Location: transaction.php");
