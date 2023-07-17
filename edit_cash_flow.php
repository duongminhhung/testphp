<?php
$id = $_GET['id'];
include_once 'db_connect.php';
$sql = "select * from transaction where id = $id";
$result = mysqli_query($conn, $sql);
$response = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $response[] = $row;
    }
} else {
    $response['error'] = 'Không tìm thấy dữ liệu';
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($response);
